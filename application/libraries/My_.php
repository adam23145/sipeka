<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    class My extends MX_Controller
    {

    public function menu($produk,$menu,$level)
	{
		$hasil = '';
		$query_load_project = "SELECT * 
			FROM `m_menu` 
			WHERE `product` = '$produk' 
			AND `level` = '$level'
			AND `status` = '1'
			AND sub_menu = '$menu' ORDER BY id ASC";
		$query = $this->db->query($query_load_project);
		$w = $query->num_rows();

		foreach($query->result() as $h)
		{
			// $class = '';
			// $nextmenu = $this->menu($produk,$h->menu,$level);
			// if($this->uri->segment(1) == $h->link_function){$class = "active";}
			// if($nextmenu != null){$class = "active";}
			
			$class = '';
			$explode1_tampil='';
			$explode2_tampil='';
			$nextmenu = $this->menu($produk,$h->menu,$level);
			if($this->uri->segment(1) == $h->link_function){$class = "active";}
			if($nextmenu != null){
				$explode1_tampil = explode(site_url(),$nextmenu);
				foreach($explode1_tampil as $dt_explode){
					$explode2_tampil = explode($this->uri->segment(1),$dt_explode);
					if($explode2_tampil[0] == ''){$class = "active";}
				}
			}
			
			
			if($h->menu_level == '2'){
				$hasil .= "<li class='$class'>
				<a href='".site_url().trim($h->link_function)."'>
				<i class='". $h->icon. "'></i><span>". $h->menu ."</span>
				<span class='pull-right-container'></span></a>";
				$hasil .= $nextmenu;
				$hasil .= "</li>";
			}else{
				$hasil .= "<li class='$class treeview'>
				<a href='#'>
				<i class='". $h->icon. "'></i><span>". $h->menu ."</span><span class='pull-right-container'>
				<i class='fa fa-angle-left pull-right'></i></span></a><ul class='treeview-menu'>";
				$hasil .= $nextmenu;
				$hasil .= "</ul></li>";
			}
		}
		return $hasil;
	}
	
}
