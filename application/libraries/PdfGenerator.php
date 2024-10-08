<?php

define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");

class PdfGenerator
{
	
	public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
	{
		$dompdf = new DOMPDF();
		$dompdf->set_option('enable_html5_parser', TRUE);
		$dompdf->load_html($html);
		$dompdf->set_paper($paper, $orientation);
		$dompdf->render();
		ob_end_clean();
		if ($stream) {
			$dompdf->stream($filename.".pdf", array("Attachment" => 0));
		} else {
			return $dompdf->output();
		}
	}
	
	
	
	public function generate1($html,$filename)
	{
		
	
	  
    define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");
	
    $dompdf = new DOMPDF();
	$dompdf->set_option('enable_html5_parser', TRUE);
    $dompdf->load_html($html);
    $dompdf->render();
	ob_end_clean();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}