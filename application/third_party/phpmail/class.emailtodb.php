<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ini_set('display_errors', '1');

/**
 * Author:   Ernest Wojciuk
 * Web Site: www.imap.pl
 * Email:    ernest@moldo.pl
 * Comments: EMAIL TO DB
 */

 #ini_set('max_execution_time', 3000);
 #ini_set('default_socket_timeout', 3000);
 #ini_set('memory_limit','512M');
date_default_timezone_set("Asia/Jakarta");

class EMAIL_TO_DB {


 var $IMAP_host; #pop3 server
 
 var $IMAP_port; #pop3 server port
 
 var $IMAP_login;
 
 var $IMAP_pass;

 var $link;
 
 var $error = array();
 
 var $status;
 
 var $max_headers = 10;  #How much headers you want to retrive 'max' = all headers (
 
 var $filestore; 

 var $file_path; #Where to write file attachments to // [full/path/to/attachment/store/(chmod777)]
 
 var $partsarray = array();
 
 var $msgid =1; 
 
 var $newid;
 
 var $logid;
 
 var $spam_folder = 3; #Folder where moving spam (ID from DB)
  
 var $file = array(); #File in multimart message
 
 function connect($host, $port, $login, $pass){

  $this->IMAP_host = $host;
  $this->IMAP_login = $login;
  
  $this->link = imap_open("{". $host . $port."}INBOX", $login, $pass);
  if($this->link) {
    echo $this->status = 'Connected';
  } else {
   echo  $this->error[] = imap_last_error();
    $this->status = 'Not connected';
  }
 }
  
  function set_path($tenant){

      //$this->file_path = APPPATH."files/email/"; #Where to write file attachments to //
      //return $this->file_path;
      $tanggal    = date('Y-m-d');

      $path   = str_replace('\\','/', APPPATH)."";
      $path   = str_replace('application','assets/attachment',$path);
      $kode_tenant_id = $tenant.'/';
      $kode_upd     = 'email/incoming/'.$tanggal;
      
      !is_dir($path.$kode_tenant_id.$kode_upd)?mkdir($path.$kode_tenant_id.$kode_upd,0777,TRUE):'';

      $this->file_path = $path.$kode_tenant_id.$kode_upd;
      
      return $this->file_path;
  }
 
 
  function set_filestore($tenant){
    $dir = $this->dir_name($tenant);
    $path = $this->set_path($tenant);
    $this->filestore = $dir;
 
  }
 
   /**
  * Get mailbox info
  */
  function mailboxmsginfo(){
   
    //$mailbox = imap_mailboxmsginfo($this->link); #It's wery slow
     $mailbox = imap_check($this->link);
  
    if ($mailbox) {
       $mbox["Date"]    = $mailbox->Date;
       $mbox["Driver"]  = $mailbox->Driver;
       $mbox["Mailbox"] = $mailbox->Mailbox;
       $mbox["Messages"]= $this->num_message();
       $mbox["Recent"]  = $this->num_recent();
       $mbox["Unread"]  = $mailbox->Unread;
       $mbox["Deleted"] = $mailbox->Deleted;
       $mbox["Size"]    = $mailbox->Size;
    } else {
       $this->error[] = imap_last_error();
    }
    
    return $mbox;
  }
 
 /**
  * Number of Total Emails
  */
 function num_message(){
    return imap_num_msg($this->link);
 }
 
 /**
  * Number of Recent Emails
  */
  function num_recent(){
    return imap_num_recent($this->link);
  }
  
  /**
   * Type and subtype message
   */
  function msg_type_subtype($_type){
    
    if($_type > 0){
       switch($_type){
         case '0': $type = "text"; break;
         case '1': $type = "multipart"; break;
         case '2': $type = "message"; break;
         case '3': $type = "application"; break;
         case '4': $type = "audio"; break;
         case '5': $type = "image"; break;
         case '6': $type = "video"; break;
         case '7': $type = "other"; break;
       }
    }
    
    return $type;
  }
  /**
   * Flag message
   */
  function email_flag(){
    
         switch ($char) {
            case 'S':
                if (strtolower($flag) == '\\seen') {
                    $msg->is_seen = true;
                }
            break;
            case 'A':
                if (strtolower($flag) == '\\answered') {
                    $msg->is_answered = true;
                }
            break;
            case 'D':
               if (strtolower($flag) == '\\deleted') {
                    $msg->is_deleted = true;
                }
            break;
            case 'F':
                if (strtolower($flag) == '\\flagged') {
                    $msg->is_flagged = true;
                }
            break;
            case 'M':
                if (strtolower($flag) == '$mdnsent') {
                    $msg->is_mdnsent = true;
                }
            break;
                default:
            break;
            }
  }
  
  /**
  * Parse e-mail structure
  */
  function parsepart($p,$msgid,$i){

   $part=imap_fetchbody($this->link,$msgid,$i);
   #Multipart
   if ($p->type!=0){
       #if base64
       if ($p->encoding==3)$part=base64_decode($part);
       #if quoted printable
       if ($p->encoding==4)$part=quoted_printable_decode($part);
       #If binary or 8bit -we no need to decode
     
       #body type (to do)
       switch($p->type) {
         case '5': # image
          $this->partsarray[$i]['image'] = array('filename'=>'imag1','string'=>$part, 'part_no'=>$i);
        break;
       }
       
       #Get attachment
       $filename='';
       if (isset($p->dparameters)){
           foreach ($p->dparameters as $dparam){
               if ((strtoupper($dparam->attribute)=='NAME') ||(strtoupper($dparam->attribute)=='FILENAME')) $filename=$dparam->value;
               }
           }
       #If no filename
       if ($filename==''){
           if (isset($p->parameters)){
               foreach ($p->parameters as $param){
                   if ((strtoupper($param->attribute)=='NAME') ||(strtoupper($param->attribute)=='FILENAME')) $filename=$param->value;
                   }
               }
           }
       if ($filename!='' ){
           $this->partsarray[$i]['attachment'] = array('filename'=>$filename,'string'=>$part, 'encoding'=>$p->encoding, 'part_no'=>$i,'type'=>$p->type,'subtype'=>$p->subtype);
      
           }
   #end if type!=0       
   }
  
   #Text email
   else if($p->type==0){
       #decode text
       #if QUOTED-PRINTABLE
       if ($p->encoding==4) $part=quoted_printable_decode($part);
       #if base_64
       if ($p->encoding==3) $part=base64_decode($part);
      
       #if plain text
       if(strtoupper($p->subtype)=='PLAIN')1;
       #if HTML
       else if (strtoupper($p->subtype)=='HTML')1;

       $this->partsarray[$i]['text'] = array('type'=>$p->subtype,'string'=>$part);
   }
  
   #if subparts
   if (isset($p->parts)){
       foreach ($p->parts as $pno=>$parr){
           $this->parsepart($parr,$this->msgid,($i.'.'.($pno+1)));           
           }
       }
   return;
  }
  
  /**
   * All email headers
   */
  function email_headers(){
    
     #$headers=imap_headers($this->link);
     if($this->max_headers == 'max'){
       $headers = imap_fetch_overview($this->link, "1:".$this->num_message(), 0);
     } else {
       $headers = imap_fetch_overview($this->link, "1:$this->max_headers", 0);
     }
     if($this->max_headers == 'max') {
         $num_headers = count($headers);
     } else {
        $count =  count($headers);
          if($this->max_headers >= $count){
              $num_headers = $count;
          } else {
              $num_headers = $this->max_headers;
          }
     }

  $size=sizeof($headers);
  for($i=1; $i<=$size; $i++){
    
  $val=$headers[$i]; 
  //while (list($key, $val) = each($headers)){
   
   $subject_s = (empty($val->subject)) ? '[No subject]' : $val->subject;
   $lp = $lp +1;
   imap_setflag_full($this->link,imap_uid($this->link,$i),'\\SEEN',SE_UID);
   $header=imap_headerinfo($this->link, $i, 80,80);
   
   if($val->seen == "0"  && $val->recent == "0") {echo  '<b>'.$val->msgno . '-' . $subject_s . '-' . $val->from .'-'. $val->date."</b><br><hr>" ;}
   else {echo  $val->msgno . '-' . $subject_s . '-' . $val->from .'-'. $val->date."<br><hr>" ;}
   }
  }

   /**
   * Get email
   */
  function email_get($tenant){
    $email = array();
    $this->set_filestore($tenant);
    
    $header=imap_headerinfo($this->link, $this->msgid, 80,80);

    $from='';
    $cc='';
    $udate='';
    $to='';
    $size='';

    isset($header->from)?$from=$header->from:'';
    isset($header->ccaddress)?$cc=$header->ccaddress:'';
    isset($header->udate)?$udate=$header->udate:'';
    isset($header->to)?$to=$header->to:'';
    isset($header->Size)?$size=$header->Size:'';
    
    if ($header->Unseen == "U" || $header->Recent == "N") {
        
    #Check is it multipart messsage
    $s = imap_fetchstructure($this->link,$this->msgid);
      if (count($s->parts)>0){
         foreach ($s->parts as $partno=>$partarr){
         #parse parts of email
         $this->parsepart($partarr,$this->msgid,$partno+1);
         }
      }else{ 
        #for not multipart messages
        #get body of message
        $text=imap_body($this->link,$this->msgid);
        #decode if quoted-printable
        if ($s->encoding==4) $text=quoted_printable_decode($text);
        if (strtoupper($s->subtype)=='PLAIN') $text=$text;
        if (strtoupper($s->subtype)=='HTML') $text=$text;
        $this->partsarray['not multipart'][text]=array('type'=>$s->subtype,'string'=>$text);
      }
    
    if(is_array($from)){
     foreach ($from as $id => $object) {
       $fromname = $object->personal;
       $fromaddress = $object->mailbox . "@" . $object->host;
     }
    }
    
    if(is_array($to)){
     foreach ($from as $id => $object) {
       $toaddress = $object->mailbox . "@" . $object->host;
     }
    }
	
	
  	function multiexplode ($delimiters,$string) { 
      $ready = str_replace($delimiters, $delimiters[0], $string);
      $launch = explode($delimiters[0], $ready);
      return  $launch;
  	}
    
      if(is_array($cc)){
        //parse karakter <>
        $exploded = multiexplode(array("<",">"),$cc);
        //replace karakter " "
        $cc       = str_replace('"','',$exploded[1]);
      }
    	
      //$email['CHARSET']    = $charset;
      $email['SUBJECT']    = $this->mimie_text_decode($header->Subject);
      $email['FROM_NAME']  = $this->mimie_text_decode($fromname);
      $email['FROM_EMAIL'] = $fromaddress;
      $email['TO_EMAIL']   = $toaddress;
  	  $email['CC']         = $cc; //nambah ini
      $email['DATE']       = date("Y-m-d H:i:s",strtotime($header->date));
      $email['SIZE']       = $size;
      #SECTION - FLAGS
      $email['FLAG_RECENT']  = $header->Recent;
      $email['FLAG_UNSEEN']  = $header->Unseen;
      $email['FLAG_ANSWERED']= $header->Answered;
      $email['FLAG_DELETED'] = $header->Deleted;
      $email['FLAG_DRAFT']   = $header->Draft;
      $email['FLAG_FLAGGED'] = $header->Flagged;
    
    }
      
      return $email;
  }
  
  function mimie_text_decode($string){
    $txt    = '';
    $string = htmlspecialchars(chop($string));

    $elements = imap_mime_header_decode($string);
    if(is_array($elements)){
     for ($i=0; $i<count($elements); $i++) {
      $charset = $elements[$i]->charset;
      $txt .= $elements[$i]->text;
     }
    } else {
      $txt = $string;
    }
    if($txt == ''){
      $txt = 'No_name';
    }
    if($charset == 'us-ascii'){
     //$txt = $this->charset_decode_us_ascii ($txt);
    }
    return $txt;
   }

   /**
   * Save messages on local disc
   */ 
  function save_files($filename, $part){

    $fp=fopen($this->filestore.$filename,"w+");
    fwrite($fp,$part);
    fclose($fp);
    //chown($this->filestore.$filename, 'apache');

  }
  

   /**
   * Set flags
   */ 
  function email_setflag(){
    
    imap_setflag_full($this->link, "2,5","\\Seen \\Flagged"); 
  
  }
   /**
   * Mark a message for deletion 
   */ 
  function email_delete(){
    
    imap_delete($this->link, $this->msgid); 

  }
  
   /**
   * Delete marked messages 
   */ 
  function email_expunge(){
    
    imap_expunge($this->link);
  
  }
  
  
   /**
   * Close IMAP connection
   */ 
  function close(){
    imap_close($this->link);   
  }
 
 
  function listmailbox(){
  $list = imap_list($this->link, "{".$this->IMAP_host."}", "*");
  if (is_array($list)) {
     return $list;
   } else {
     $this->error =  "imap_list failed: " . imap_last_error() . "\n";
   }
   return array();
  }
  
/*******************************************************************************
 *                                 SPAM  DETECTION                               
 ******************************************************************************/

  function spam_detect(){
    
    //if (!isset($db)) $db = new DB_WL;
    
    $email = array();
    
    $id = $this->newid; #ID email in DB
    
   $db->query("SELECT ID, IDEmail, EmailFrom, EmailFromP, EmailTo, Subject, Message, Message_html FROM emailtodb_email WHERE ID='".$id."'");
   $db->next_record();
    $ID = $db->f('ID');
    $email['Email']       = $db->f('EmailFrom');
    $email['Subject']     = $db->f('Subject');
    $email['Text']        = $db->f('Message');
    $email['Text_HTML']   = $db->f('Message_html');
    if($this->check_blacklist($email['Email'])){
      $this->update_folder($id, $this->spam_folder);  
    }
    if($this->check_words($email['Subject'])){
      $this->update_folder($id, $this->spam_folder);  
    }
    if($this->check_words($email['Text'])){
      $this->update_folder($id, $this->spam_folder);  
    }
    if($this->check_words($email['Text_HTML'])){
      $this->update_folder($id, $this->spam_folder);  
    }
  }
  
  
  function check_blacklist($email){
    
  //  if (!isset($db)) $db = new DB_WL;
    
   $db->query("SELECT Email FROM emailtodb_list WHERE Email='".addslashes($email)."' AND Type='B'");
   $db->next_record();
   $e_mail = $db->f('Email');
   if($e_mail == $email){
    return 1;
   } else {
    return 0;
   }

  }
  
    function check_words($string){
    
   // if (!isset($db)) $db = new DB_WL;
    
    $string = strtolower($string);
    
    $db->query("SELECT Word FROM emailtodb_words ");
    while($db->next_record()){
    
    $word = strtolower($db->f('Word'));
    
        if (eregi($word, $string)) {
          return 1;
        }
    }
  }
/*******************************************************************************
 *                                 DB FUNCTIONS                                 
 ******************************************************************************/

/**
* Add email to DB
*/
  function db_add_message($email,$tenant){
         $CI =& get_instance();
         $CI->load->database(); 

    $message_id ='';
      $data = array(
        'IDEmail'     => $message_id,
        'EmailFrom'   => $email['FROM_EMAIL'],
        'EmailFromP'  => addslashes(strip_tags($email['FROM_NAME'])),  
        'EmailTo'     => addslashes(strip_tags($email['TO_EMAIL'])),
        'DateE'       => $email['DATE'],
        'DateDb'      => date("Y-m-d H:i:s"),
        'Subject'     => addslashes($email['SUBJECT']),
        'EmailCC'     => addslashes($email['CC']),
        'MsgSize'     => $email["SIZE"],
        'tenant_id'   => $tenant
      );

      $query     = $CI->db->insert('emailtodb_email', $data); 
      $sql = "SELECT ID FROM emailtodb_email ORDER BY DateE Desc limit 1";
      $query = $CI->db->query($sql);
      $result= $query->result_array();
     
      $this->newid = $result[0]['ID'];
  
  }
 /**
 * Add attachments to DB
 **/

function db_add_attach($file_orig, $filename, $filepath, $tenant){

         $CI =& get_instance();
         $CI->load->database(); 

  $data = array(
        'IDEmail'     => $this->newid,
        'FileNameOrg' => addslashes($file_orig),
        'Filename'    => addslashes($filename),
        'FilePath'    => $filepath,
        'tenant_id'   => $tenant
      );

      $query = $CI->db->insert('emailtodb_attach', $data);  
}

/**
* Add email to DB
*/
  function db_update_message($msg, $type= 'PLAIN'){
    $CI =& get_instance();
    $CI->load->database(); 

    if($type == 'PLAIN'){
       $data_update = array( 'Message'  => addslashes($msg) );
       $CI->db->where('ID', $this->newid);
       $query = $CI->db->update('emailtodb_email', $data_update);
       
    }
   
    if($type == 'HTML'){
       $data_update = array( 'Message_html'  => addslashes($msg) );
       $CI->db->where('ID', $this->newid);
       $query = $CI->db->update('emailtodb_email', $data_update);
       
    }
  
  }
  
/**
 * Insert progress log
 */
  function add_db_log($email, $info, $tenant){
    
    $CI =& get_instance();
    $CI->load->database(); 

    $data = array(
        'IDEmail'   => $this->newid,
        'Email'     => $email['FROM_EMAIL'],
        'Info'      => addslashes(strip_tags($info)),  
        'FSize'     => $email["SIZE"],
        'Date_start'=> date("Y-m-d H:i:s"),
        'Status'    => '2',
        'tenant_id' => $tenant
    );

    $query = $CI->db->insert('emailtodb_log', $data); 
    $insert_id = $CI->db->insert_id();
    $this->logid = $insert_id;
   
    return  $this->logid;  
  }
  
 /**
 * Set folder
 */
  function update_folder($id, $folder){
         
         $CI =& get_instance();
         $CI->load->database(); 

       $data_update = array( 'Message'  => addslashes($folder) );
       $CI->db->where('ID', $id);
       $query = $CI->db->update('emailtodb_email', $data_update);        
  }
  
 /**
 * Update progress log
 */
  function update_db_log($info, $id){

    $CI =& get_instance();
    $CI->load->database();
    
    $data_update = array(
        'Status'      => '1',
        'Info'        => addslashes(strip_tags($info)),
        'Date_finish' => date("Y-m-d H:i:s")
    );

       $CI->db->where('ID', $id);
       $query = $CI->db->update('emailtodb_log', $data_update);
  }
  
  
 /**
 * Read log from DB
 */
  function db_read_log(){

  $email = array();
  
   $execute = mysql_query("SELECT IDlog, IDemail, Email, Info, FSize, Date_start, Date_finish, Status FROM emailtodb_log ORDER BY Date_finish DESC LIMIT 100");
   while($row = mysql_fetch_array($execute)){
    $ID = $row['IDlog'];
    $email[$ID]['IDemail']     = $row['IDemail'];
    $email[$ID]['Email']       = $row['Email'];
    $email[$ID]['Info']        = $row['Info'];
    $email[$ID]['Size']        = $row['FSize'];
    $email[$ID]['Date_start']  = $row['Date_start'];
    $email[$ID]['Date_finish'] = $row['Date_finish'];
   }
   return $email;
  } 
  
  
 /**
 * Read emails from DB
 */
  function db_read_emails(){
  //if (!isset($db)) $db = new DB_WL;
  $email = array();
  
  
   $execute = mysql_query("SELECT ID, IDEmail, EmailFrom, EmailFromP, EmailTo, DateE, DateDb, Subject, Message, Message_html, MsgSize FROM emailtodb_email ORDER BY ID DESC LIMIT 25");
   while($row = mysql_fetch_array($execute)){
    $ID = $row['ID'];
    $email[$ID]['Email']     = $row['EmailFrom'];
    $email[$ID]['EmailName'] = $row['EmailFrom'];
    $email[$ID]['Subject']   = $row['Subject'];
    $email[$ID]['Date']      = $row['DateE'];
    $email[$ID]['Size']      = $row['MsgSize'];
    
   }
   return $email;
  }
  
/*function dir_name() {
    
  $year  = date('Y');
  $month = date('m');

  $dir_n = $year . "_" . $month;

  if (is_dir($this->set_path() . $dir_n)) {
    return $dir_n . '/';
  } else {
    mkdir($this->set_path() . $dir_n, 0777);
    return $dir_n . '/';
  }
 }
*/
//rizq
function dir_name($tenant) {

  $year  = date('Y');
  $month = date('m');
  
  //$dir_n = $year . "_" . $month;

  if (is_dir($this->set_path($tenant))) {
	return $this->set_path($tenant) . '/';
  } else {
	mkdir($this->set_path($tenant), 0777);
	return $this->set_path($tenant) . '/';
  }
 }

 
  function do_action($tenant){
  
  if($this->num_message() >= 1) {
   
   /* if($this->msgid <= 0) {
        $this->msgid = 1;
    }else {
        $this->msgid = $_GET[msgid] + 1;
    }*/
    $CI =& get_instance();
    $CI->load->database(); 
   
    #Get first message
    $email = $this->email_get($tenant);
   
    #Get store dir
    $dir = $this->dir_name($tenant);
    
    #Insert message to db
    $ismsgdb = $this->db_add_message($email,$tenant);
    
    $id_log = $this->add_db_log($email, 'Copy e-mail - start ', $tenant);
    if(is_array($this->partsarray)){

    foreach($this->partsarray as $part){

     if($part['text']['type'] == 'HTML'){
       #$message_HTML = $part[text][string];
       if(isset($part['text']['string'])){
          $this->db_update_message($part['text']['string'], $type= 'HTML');
       }
     }elseif($part['text']['type'] == 'PLAIN'){
       #$message_PLAIN = $part['text']['string'];
       if(isset($part['text']['string'])){
          $this->db_update_message($part['text']['string'], $type= 'PLAIN');
       }
     }elseif($part['attachment']){
        #Save files(attachments) on local disc
       // $message_ATTACH[] = $part[attachment];
        foreach(array($part['attachment']) as $attach){
            $attach['filename'] = $this->mimie_text_decode($attach['filename']);
            $attach['filename'] = preg_replace('/[^a-z0-9_\-\.]/i', '_', $attach['filename']);
            $this->add_db_log($email, 'Start coping file:"'.strip_tags($attach['filename']).'"', $tenant);

			$randfile = myrandom($attach['filename']);
			$this->save_files($randfile.$attach['filename'], $attach['string']);
			$filepath = $dir;
      $filename = $randfile.$attach['filename'];
  
            $this->db_add_attach($attach['filename'], $filename, $filepath, $tenant);
            $this->update_db_log('<b>'.$filename.'</b>Finish coping: "'.strip_tags($attach['filename']).'"', $this->logid);
        }
      //
     
     }elseif($part['image']){
        #Save files(attachments) on local disc
 
        $message_IMAGE[] = $part['image'];
        
        foreach($message_IMAGE as $image){
            $image['filename'] = $this->mimie_text_decode($image['filename']);
            $image['filename'] = preg_replace('/[^a-z0-9_\-\.]/i', '_', $image['filename']);
            $this->add_db_log($email, 'Start coping file: "'.strip_tags($image['filename']).'"', $tenant);
            
            
            $this->save_files($this->newid.$image['filename'], $image[string]);
            $filepath = $dir;
            $filename = $this->newid.$image['filename'];

            $this->db_add_attach($image['filename'], $filename, $filepath, $tenant);
            $this->update_db_log('<b>'.$filename.'</b>Finish coping:"'.strip_tags($image['filename']).'"', $this->logid);
        }

     }
    }
    }
    //$this->spam_detect();
    $this->email_setflag(); 
    $this->email_delete();
    $this->email_expunge();
    
    $this->update_db_log('Finish coping', $id_log);
    
    if($email <> ''){
       unset($this->partsarray);
       # echo "<meta http-equiv=\"refresh\" content=\"2; url=email.monitor.mail.php?msgid=".$this->msgid."\">";
       # http version - uncheck if You want used in browser
         // echo "<meta http-equiv=\"refresh\" content=\"2; url=email.monitor.mail.php?msgid=0\">";
        
    }
   } else {
    # No messages
    # http version
       //echo "<meta http-equiv=\"refresh\" content=\"10; url=email.monitor.mail.php?msgid=0\">";
   }
  }
      
}#end class

  function myrandom(){
	$length = 5;
	$char = '0123456789abcdefghijklmnopqrstuvwxyz';
	$string = '';
	for ($z=0; $z < $length; $z++){
		$string .= $char[mt_rand(0,strlen($char))];
	}
	return $string;
  }