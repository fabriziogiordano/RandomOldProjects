<?php
class Web extends Controller {

	function __construct()
	{
		parent::Controller();
		
		$this->load->model('Newsm', 'News');
		$news = $this->News->get();
		if(is_array($news)) $this->template['news'] =& $news[key($news)];

		$anteprime = $this->Films->anteprime();
		if(is_array($anteprime)) $this->template['anteprime'] =& $anteprime;
		
		$this->output->cache(60);
	}
	
	function index($id_film=NULL)
	{	
		$this->template['metatitle'] = 'per iPhone';
		$this->template['metadescription'] = 'disponibile anche per iPhone';
		
		$this->template['content_view'] = 'iphone_web';
		$this->load->view('template',$this->template);
	}
}