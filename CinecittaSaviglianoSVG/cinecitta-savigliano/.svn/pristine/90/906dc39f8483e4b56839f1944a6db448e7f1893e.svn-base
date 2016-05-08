<?php
class Welcome extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->output->cache(60);
	}
	
	function index()
	{
		
		if(!empty($_SERVER['HTTP_USER_AGENT']) && stristr($_SERVER['HTTP_USER_AGENT'], 'safari') === FALSE)
			$this->template['webapp'] = false;
		else
			$this->template['webapp'] = true;
		
		/*Estrae programmazione*/
		$this->template['programmazione'] = $this->Programmazioni->get();
		
		/*Estrae dettagli*/
		$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;
		
		$this->template['content_view'] = 'iphone/welcome';
		$this->load->view('iphone/template',$this->template);
	}
}