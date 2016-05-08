<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigator extends CI_Controller {
  public function index(){
    $template['controlls'] = false;
    $this->load->view('navigator', $template);
  }
}