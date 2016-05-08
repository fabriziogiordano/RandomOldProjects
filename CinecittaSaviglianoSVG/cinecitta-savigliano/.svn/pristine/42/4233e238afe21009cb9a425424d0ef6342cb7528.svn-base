<?php
class Programmazione extends Controller {

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
		$this->template['content_view'] = 'pannello/welcome';
		$this->load->view('pannello/template',$this->template);
	}
	
	function visualizza($id='')
	{
		/*Estrae programmazione*/
		$this->template['programmazione'] = $this->Programmazioni->get($id);
		
		/*Estrae dettagli*/
		$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;
		
		$this->template['content_view'] = 'pannello/welcome';
		$this->load->view('pannello/template',$this->template);
	}
	
	function crea($id='', $action='Crea', $errori=NULL)
	{
		$this->template['action'] = $action;
		$this->template['id_programmazione'] = $id;
		if(!empty($id) && empty($errori))
		{
			$programmazione = $this->Programmazioni->get($id);
			$this->template['periodo']['inizio'] = $programmazione['inizio']['giorno'].'/'.$programmazione['inizio']['m'].'/'.$programmazione['inizio']['anno'];
			$this->template['periodo']['fine'] = $programmazione['fine']['giorno'].'/'.$programmazione['fine']['m'].'/'.$programmazione['fine']['anno'];
			$this->template['periodo']['attivazione'] = $programmazione['attivazione']['giorno'].'/'.$programmazione['attivazione']['m'].'/'.$programmazione['attivazione']['anno'];
			$this->template['periodo']['note'] = $programmazione['note'];
			
			$films = $this->Programmazioni->get_details($id);
			$i=0;
			foreach($films as $film)
			{
				$this->template['film'][$i]['orario']['feriale'] = $film['orario']['feriale'];
				$this->template['film'][$i]['orario']['festivo'] = $film['orario']['festivo'];
				$this->template['film'][$i]['orario']['note'] = $film['orario']['note'];
				$this->template['film'][$i]['locandina'] = $film['locandina'];
				$this->template['film'][$i]['titolo'] = $film['titolo'];
				$this->template['film'][$i]['id_film'] = $film['id_film'];
			$i++;
			}
		}
		elseif(!empty($errori))
		{
			$this->template['periodo'] = $this->input->post('periodo');
			$this->template['film'] = $this->input->post('orario');
		}
		else
		{
			$this->template['periodo']['inizio'] = '';
			$this->template['periodo']['fine'] = '';
			$this->template['periodo']['attivazione'] = '';
			$this->template['periodo']['note'] = '';
			$i=0;
			for($i=0; $i<10; $i++)
			{
				$this->template['film'][$i]['orario']['feriale'] = '';
				$this->template['film'][$i]['orario']['festivo'] = '';
				$this->template['film'][$i]['orario']['note'] = '';
				$this->template['film'][$i]['locandina'] = '';
				$this->template['film'][$i]['titolo'] = '';
				$this->template['film'][$i]['id_film'] = '';
			}
		}
		
		$locandine = $this->Films->form_select();
		$this->template['selectfilms'][0] = 'Seleziona locandina';
		foreach($locandine as $locandina)
		{
			$this->template['locandinajs'][$locandina['id']] = $locandina['locandina'];;
			$this->template['selectfilms'][$locandina['id']] = $locandina['titolo'];
		}
		$this->template['errori'] = $errori;
		
		$this->template['content_view'] = 'pannello/programmazione';
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
		$this->Programmazioni->cancella($id);
		$this->session->set_flashdata('flash', 'Programmazione <strong>cancellata</strong>.');
		redirect('pannello/');
	}
	
	function submit()
	{
		
		$errori = array();
		$errori = $this->Programmazioni->check();
		
		if(count($errori) > 0)
		{
			$this->crea($this->input->post('id_programmazione'), $this->input->post('action'), $errori);
			return;
		}
		
		if($this->input->post('action') == 'Crea') $errori = $this->Programmazioni->crea();
		if($this->input->post('action') == 'Modifica') $errori = $this->Programmazioni->modifica();
		if($this->input->post('action') == 'Copia') $errori = $this->Programmazioni->copia();
		
		if(is_array($errori) && count($errori) > 0)
		{
			$this->crea($this->input->post('id_programmazione'), $this->input->post('action'), $errori);
			return;
		}
		else
		{
			$id =& $errori;
		}
		
		$this->session->set_flashdata('flash', 'Operazione <strong><i>'.$this->input->post('action').'</i></strong> programmazione avvenuta correttamente.');
		redirect('pannello/programmazione/visualizza/'.$id);
	}
	
	function redazioni($id='')
	{
		/*Estrae programmazione*/
		$this->template['programmazione'] = $this->Programmazioni->get($id);
		
		/*Estrae dettagli*/
		$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;
		
		$this->template['content_view'] = 'pannello/programmazione_redazioni';
		$this->load->view('pannello/template',$this->template);
	}
}