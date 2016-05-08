<?php
class Socials extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->session->userdata('logged'))
		{
			redirect('/pannello/login/', 'refresh');
		}
		/*Estrae programmazioni*/
		$this->template['sidebar'] = $this->Programmazioni->get_all();
		$this->load->model('Facebookmd');
	}
	
	function index()
	{
		$this->template['statuses'] = $this->Facebookmd->get_status();
		
		$programmazioni = $this->Programmazioni->get_all();
		foreach($programmazioni as $programmazione)
		{
			$data = titoloprogrammazione::titolo($programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false);
			if($programmazione['incorso']){
				$this->template['filmtitles']['current'] = 'Ecco la programmazione '. $data . ': '. $this->Programmazioni->get_film_titles($programmazione['id']);
				break;
			}
			
			$this->template['filmtitles']['next'] = 'Ecco la programmazione '. $data . ': '. $this->Programmazioni->get_film_titles($programmazione['id']);
		}
		
		$this->template['content_view'] = 'pannello/socials';
		$this->load->view('pannello/template',$this->template);
	}
	
	function submit()
	{
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		
		if( $this->Facebookmd->send_status($this->input->post('status')) )
			$this->session->set_flashdata('flash', 'Status aggiornato');
		else
			$this->session->set_flashdata('flash', '<strong>Errore:</strong> Status <strong>NON</strong> aggiornato');
		redirect('pannello/socials');
	}
	
	private function _submit_validate()
	{
		
		$this->form_validation->set_rules('status', 'Status', 
			'trim|required|min_length[3]|max_length[400]');
	
		return $this->form_validation->run();
	}
	
}