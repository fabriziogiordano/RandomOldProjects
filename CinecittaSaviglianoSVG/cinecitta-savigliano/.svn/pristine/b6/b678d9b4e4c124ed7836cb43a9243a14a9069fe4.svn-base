<?php
class Cache extends Controller {

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
		if ($handle = opendir($this->config->item('cache_path')))
		{
			$this->template['cache'] = array();
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != "..")
				{
					$this->template['cache'][] = $file;
				}
			}
			closedir($handle);
		}
		else
		{
			$this->template['cache'] = 'Error opening cache folder.';
		}
		$this->template['content_view'] = 'pannello/cache';
		$this->load->view('pannello/template',$this->template);
	}
	
	function cancella()
	{
		if ($handle = opendir($this->config->item('cache_path')))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != "..")
				{
					#echo $this->config->item('cache_path').$file;
					unlink($this->config->item('cache_path').$file);
				}
			}
			closedir($handle);
		}
		else
		{
			$this->session->set_flashdata('flash', 'Errore');
		}
		$this->session->set_flashdata('flash', 'File cache correttamente cancellati');
		redirect('/pannello/cache/', 'refresh');
	}
}