<?php
class Xpand3d extends Controller {

	function __construct()
	{
		parent::Controller();
		
		$this->load->model('Newsm', 'News');
		$news = $this->News->get();
		if(is_array($news)) $this->template['news'] = $news[key($news)];
		
		$this->output->cache(60);
	}
	
	function index()
	{
		$this->template['metatitle'] = '3D - Sistema Xpand3D';
		
		$this->template['content_view'] = 'xpand3d';
		$this->load->view('template',$this->template);
	}
}