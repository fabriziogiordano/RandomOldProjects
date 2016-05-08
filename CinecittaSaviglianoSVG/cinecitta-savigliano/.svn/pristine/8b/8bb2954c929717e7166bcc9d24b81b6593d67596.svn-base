<?php
class Compleanno extends Controller {

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
		$this->template['metatitle'] = 'E\' il tuo compleanno? Entri gratis al cinema.';
		$this->template['metadescription'] = 'Entra gratis al cinema multisala Cinecittà il giorno del tuo compleanno.';
		
		$this->template['content_view'] = 'compleanno';
		$this->load->view('template',$this->template);
	}
}