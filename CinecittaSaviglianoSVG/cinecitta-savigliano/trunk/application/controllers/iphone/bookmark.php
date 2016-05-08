<?php
class Film extends Controller {

	function __construct()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->load->view('iphone/film');
	}
	
	function show($id='', $title='')
	{
		echo $id;
		echo '<br>';
		echo $title;
		
		//$this->load->view('iphone/film');
	}
}