<?php
class Welcome extends Controller {

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
		
		if($this->template['films'])
			$this->template['metatitle'] = 'Programmazione '.titoloprogrammazione::titolo(
																			$this->template['programmazione']['inizio']['giorno'],
																			$this->template['programmazione']['inizio']['mese'],
																			$this->template['programmazione']['fine']['giorno'],
																			$this->template['programmazione']['fine']['mese'],
																			false
																			);
			$this->template['metatitle'] = 'Programmazione';
		
		$this->template['content_view'] = 'mobile/welcome';
		$this->load->view('mobile/template',$this->template);
	}
}