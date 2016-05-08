<?php
class Rss extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->output->cache(60);
	}
	
	function index()
	{
		/*Estrae programmazione*/
		$this->template['programmazione'] = $this->Programmazioni->get();
		
		/*Estrae dettagli*/
		$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;
		
		$this->output->set_header("Content-Type: text/xml");
		if(!empty($this->template['programmazione']['data_caricamento']))
		{
			list($anno, $mese, $giorno) = explode('-', $this->template['programmazione']['data_caricamento']);
			$data = date('r', mktime(0, 0, 0, ltrim($mese), ltrim($giorno), $anno) );
			$this->output->set_header('Last-Modified: '.$data);
		}
		else
		{
			$this->output->set_header('Last-Modified: '.date('r'));
		}
		
		$this->load->view('rss',$this->template);
	}
}