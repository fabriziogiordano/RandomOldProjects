<?php
class Film extends Controller {

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
		$this->template['films'] = $this->Films->lista();

		$this->template['content_view'] = 'pannello/film';
		$this->load->view('pannello/template',$this->template);
	}

	function gestione($id='', $action='Crea', $errori=NULL)
	{
		$this->template['action'] = $action;
		$this->template['id'] = $id;

		if(!empty($id)) $this->template['action'] = 'Modifica';

		if(!empty($id) && empty($errori))
		{
			$film = $this->Films->get($id);
			$this->template['titolo'] = $film['titolo'];
			$this->template['url'] = $film['url'];
			$this->template['trailer'] = $film['trailer'];
			$this->template['testo'] = $film['testo'];
			$this->template['locandina'] = $film['locandina'];
			$this->template['anteprima'] = $film['anteprima'];
			$this->template['tred'] = $film['tred'];
		}
		elseif(!empty($errori))
		{
			$this->template['titolo'] = $this->input->post('titolo');
			$this->template['url'] = $this->input->post('url');
			$this->template['trailer'] = $this->input->post('trailer');
			$this->template['testo'] = $this->input->post('testo');
			$this->template['locandina'] = $this->input->post('locandina');
			$this->template['anteprima'] = $this->input->post('anteprima');
			$this->template['tred'] = $this->input->post('tred');
		}
		else
		{
			$this->template['titolo'] = '';
			$this->template['url'] = '';
			$this->template['trailer'] = '';
			$this->template['testo'] = '';
			$this->template['locandina'] = '';
			$this->template['anteprima'] = FALSE;
			$this->template['tred'] = FALSE;
		}

		$this->template['errori'] = $errori;

		$this->template['content_view'] = 'pannello/filmgestione';
		$this->load->view('pannello/template',$this->template);
	}

	function submit()
	{
		$errori = array();
		$errori = $this->Films->check();

		$trailer = $this->input->post('trailer');

		if(!empty($trailer)) {
			$this->_trailer3gp($trailer);
		}

		if(count($errori) > 0)
		{
			$this->gestione($this->input->post('id'), $this->input->post('action'), $errori);
			return;
		}

		$errori = $this->Films->crea($this->input->post('id'));

		if(is_array($errori) && count($errori) > 0)
		{
			$this->gestione($this->input->post('id'), $this->input->post('action'), $errori);
			return;
		}

		$this->session->set_flashdata('flash', 'Operazione <strong><i>'.$this->input->post('action').'</i></strong> film avvenuta correttamente.');
		redirect('pannello/film/');
	}

	function anteprima()
	{
		$anteprima = $this->Films->anteprima_update($this->input->post('id'));
		if($anteprima) echo 'si';
		else echo 'no';
	}

	function reorder()
	{
		$this->Programmazioni->reorder($this->input->post('id_programmazione'), $this->input->post('film'));
		return;
	}


	function _trailer3gp($youtube)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://162.243.15.75/cinecittasavigliano/?" . $youtube);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		return;
	}
}