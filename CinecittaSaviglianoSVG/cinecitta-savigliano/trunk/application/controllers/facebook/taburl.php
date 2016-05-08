<?php
class Taburl extends Controller {

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
	
	function index($i= NULL)
	{
		/*Estrae programmazione*/
		$this->template['programmazione'] = $this->Programmazioni->get($i);
		
		/*Estrae dettagli*/
		$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;

		if($this->template['films'])
			$this->template['metatitle'] = 'Programmazione '.titoloprogrammazione::titolo(
																			$this->template['programmazione']['inizio']['giorno'],
																			$this->template['programmazione']['inizio']['mese'],
																			$this->template['programmazione']['fine']['giorno'],
																			$this->template['programmazione']['fine']['mese'],
																			false
																			);
		else
			$this->template['metatitle'] = 'Programmazione';
		
		$this->load->view('facebook/taburl',$this->template);
	}
}