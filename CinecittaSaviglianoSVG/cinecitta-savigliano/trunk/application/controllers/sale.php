<?php
class Sale extends Controller {

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
	
	function index()
	{
		$this->template['metatitle'] = 'Sale';
		
		$this->template['content_view'] = 'sale';
		$this->load->view('template',$this->template);
	}
}