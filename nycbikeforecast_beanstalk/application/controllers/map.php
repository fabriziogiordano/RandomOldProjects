<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {
  public function index(){
    $template['controlls'] = false;
    $this->load->view('map', $template);
  }

  public function full(){
    $this->load->helper('form');
    $timestamp = (!empty($this->input->get('time', true)))? $this->input->get('time', true) : '';
    $template['timestamp'] = $timestamp;
    $template['controlls'] = true;
    $this->load->view('map', $template);
  }

}