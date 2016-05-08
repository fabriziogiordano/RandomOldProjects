<?php
class Welcome extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->session->userdata('logged'))
		{
			redirect('/pannello/login/', 'refresh');
		}
		/*Estrae programmazioni*/
		$this->template['sidebar'] = $this->Programmazioni->get_all();
	}
	
	function index()
	{
		/*Estrae programmazione*/
		$this->template['programmazione'] = $this->Programmazioni->get();
		
		/*Estrae dettagli*/
		$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;
		
		$this->template['content_view'] = 'pannello/welcome';
		$this->load->view('pannello/template',$this->template);
	}
}