<?php
class News extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->session->userdata('logged'))
		{
			redirect('/pannello/login/', 'refresh');
		}
		/*Estrae programmazioni*/
		$this->template['sidebar'] = $this->Programmazioni->get_all();
		
		$this->load->model('Newsm', 'News');
	}
	
	function index()
	{
		$this->template['news'] = $this->News->get_all();
		
		$this->template['content_view'] = 'pannello/news';
		$this->load->view('pannello/template',$this->template);
	}
	
	function crea($id='', $action='Crea', $errori=NULL)
	{
		$this->template['action'] = $action;
		$this->template['id'] = $id;
		if(!empty($id) && empty($errori))
		{
			$news = $this->News->get($id);
			
			$this->template['id'] = $id;
			$this->template['action'] = $action;
			$this->template['data_news'] = $news[$id]['data_news'];
			$this->template['titolo'] = $news[$id]['titolo'];
			$this->template['testo'] = $news[$id]['testo'];
		}
		elseif(!empty($errori))
		{
			$this->template['id'] = $id;
			$this->template['action'] = $action;
			$this->template['data_news'] = $this->input->post('data_news');
			$this->template['titolo'] = $this->input->post('titolo');
			$this->template['testo'] = $this->input->post('testo');
		}
		else
		{
			$this->template['id'] = '';
			$this->template['action'] = $action;
			$this->template['data_news'] = date('d').'/'.date('m').'/'.date('Y');
			$this->template['titolo'] = '';
			$this->template['testo'] = '';
		}
		
		$this->template['errori'] = $errori;
		
		$this->template['content_view'] = 'pannello/news_gestione';
		$this->load->view('pannello/template',$this->template);
	}
	
	function copia($id='')
	{
		$this->crea($id, 'Copia', '');
	}
	
	function modifica($id='')
	{
		$this->crea($id, 'Modifica', '');
	}
	
	function cancella($id='')
	{
		$this->News->cancella($id);
		$this->session->set_flashdata('flash', 'News <strong>cancellata</strong>.');
		redirect('pannello/news');
	}
	
	function submit()
	{
		$errori = array();
		$errori = $this->News->check();
		
		if(count($errori) > 0)
		{
			$this->crea($this->input->post('id'), $this->input->post('action'), $errori);
			return;
		}
		
		if($this->input->post('action') == 'Crea') $errori = $this->News->crea();
		if($this->input->post('action') == 'Modifica') $errori = $this->News->modifica();
		if($this->input->post('action') == 'Copia') $errori = $this->Programmazioni->copia();
		
		if(is_array($errori) && count($errori) > 0)
		{
			$this->crea($this->input->post('id'), $this->input->post('action'), $errori);
			return;
		}
		else
		{
			$id =& $errori;
		}
		
		$this->session->set_flashdata('flash', 'Operazione <strong><i>'.$this->input->post('action').'</i></strong> News avvenuta correttamente.');
		redirect('pannello/news/');
	}
}