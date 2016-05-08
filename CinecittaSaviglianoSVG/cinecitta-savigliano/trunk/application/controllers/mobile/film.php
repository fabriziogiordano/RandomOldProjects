<?php
class Film extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->output->cache(60);
	}
	
	function index($id_film=NULL)
	{	
		
		$this->template['film'] = $this->Films->get($id_film);
		
		$this->template['metatitle'] = 'Film: '. $this->template['film']['titolo'];
		
		$this->template['content_view'] = 'mobile/film';
		$this->load->view('mobile/template',$this->template);
	}
	
	function show($i='')
	{
		$this->index($i);
	}
}