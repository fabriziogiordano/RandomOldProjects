<?php
class Prossimamente extends Controller {

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
	
	function index($id=NULL)
	{	
		
		$this->template['metatitle'] = 'Prossimamente al cinema';
		
		$this->template['content_view'] = 'prossimamente';
		$this->load->view('template',$this->template);
	}
	
	function show($i='')
	{
		$this->index($i);
	}
}