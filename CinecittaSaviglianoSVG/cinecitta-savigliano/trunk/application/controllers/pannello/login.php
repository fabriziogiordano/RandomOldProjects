<?php
class Login extends Controller {

	function __construct()
	{
		parent::Controller();
	}
	
	function index()
	{
		$this->template['content_view'] = 'pannello/login';
		$this->template['logged'] = FALSE;
		$this->load->view('pannello/template',$this->template);
	}
	
	function submit()
	{
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		redirect('pannello/');
	}
	
	function logout()
	{
		$newdata = array(
			'logged' => FALSE,
			'utente' => ''
		);
		$this->session->set_userdata($newdata);
		redirect('pannello/');
	}
	
	private function _submit_validate()
	{
		
		$this->form_validation->set_rules('utente', 'Utente', 
			'trim|required|callback__authenticate');		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required');
	
		$this->form_validation->set_message('_authenticate','Login non corretto. Riprova.');
	
		return $this->form_validation->run();
	}
	
	public function _authenticate()
	{
		$user = array(
			'luca'=>'s',
			'fabrizio'=>'sempreio',
			'test'=>'test',
			'admin'=>'cinecittasavigliano'
			);
			
		if($user[$this->input->post('utente')] == $this->input->post('password'))
		{
			$newdata = array(
				'logged' => TRUE,
				'utente' => $this->input->post('utente'),
			);
			$this->session->set_userdata($newdata);
		return TRUE;
		}
	return FALSE;
	}
}