<?php
class News extends Controller {

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
		
		$news = $this->News->get($id);
		$this->template['fullnews'] = $news[key($news)];
		
		$this->template['metatitle'] = 'News: '. $this->template['fullnews']['titolo'];
		
		$this->template['content_view'] = 'news';
		$this->load->view('template',$this->template);
	}
	
	function show($i='')
	{
		$this->index($i);
	}
}