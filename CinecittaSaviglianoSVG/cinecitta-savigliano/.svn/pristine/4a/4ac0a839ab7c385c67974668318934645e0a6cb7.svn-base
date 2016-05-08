<?php
class Newsletter extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->model('Contatti');
		
		$this->load->model('Newsletters', 'Newsletter');
	}
	
	function index()
	{
		redirect('/');
	}
	
	function optout($email='',$id='')
	{
		if(empty($email) || empty($id))
		{
			$this->template['result'] = FALSE;
			$this->_ridirezione();
		return FALSE;
		}
		
		$this->template['result'] = $this->Newsletter->remove_user($email, $id);
		$this->_ridirezione();
	}
	
	function _ridirezione()
	{
		$this->template['metatitle'] = 'Newsletter';
		$this->template['content_view'] = 'newsletter_optout';
		$this->load->view('template',$this->template);
	}
}