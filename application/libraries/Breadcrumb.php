<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumb {

    protected $data = array();

    function __construct() {

    }

    public function add($title, $uri='') {
        $this->data[] = array('title'=>$title, 'uri'=>$uri);
        return $this;
    }

    public function fetch() {
        return $this->data;
    }
    
    public function reset() {
        $this->data = array();
    }

    public function show($home_site ="Home", $id = "crumbs") {
        $ci = &get_instance();
        $site = $home_site;
        $breadcrumbs = $this->data;
        $out  = '<ol class="breadcrumb float-sm-right" id="'.$id.'">
        ';
        if ($breadcrumbs && count($breadcrumbs) > 0) {
            $out .= '<li class="breadcrumb-item"><a style="color:#1475DC" >Home<i class="ft-home"></i></a></li>';
            $i=1;
            foreach ($breadcrumbs as $crumb): 

                if ($i != count($breadcrumbs)) {
                    $out .=  '<li class="breadcrumb-item"><a href="' .site_url($crumb['uri']). '">'. $crumb['title'] .'</a></li>';
                } else {
                    $out .=  '<li class="breadcrumb-item active"><a href="#">'. $crumb['title'] .'</a></li>';
                }
                $i++;
            endforeach;
        } else {
            $out .= '<li class="selected">' . $site . '</li>';
        }
        $out .= '</ol>';
        return $out; 
    }

}