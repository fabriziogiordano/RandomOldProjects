<?php
class Film extends Controller {

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
		
		$this->template['film'] = $this->Films->get($id_film);
		
		$this->template['metatitle'] = 'Film: '. $this->template['film']['titolo'];
		$this->template['metadescription'] = substr($this->template['film']['testo'],0,100);
		
		$this->template['fb_og']['title'] = $this->template['film']['titolo'];
		$this->template['fb_og']['url'] = substr($this->config->item('base_url'),0,-1).$this->uri->uri_string();
		$this->template['fb_og']['image'] = 'http://www.cinecittasavigliano.it/locandine/'.$this->template['film']['locandina'];
		
		
		$this->template['content_view'] = 'film';
		$this->load->view('template',$this->template);
	}
	
	function show($i='')
	{
		$this->index($i);
	}
}