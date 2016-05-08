<?php
class Contatti extends Model {
	
	function __construct()
	{
		parent::Model();
	}

	function salva_newsletter()
	{
		/*Controlla che la mail non sia già registrata*/
		$query = $this->db->get_where('tbl_newsletter', array('email' => $this->input->post('email')));
		
		if($query->num_rows()<1)
		{
			$data = array(
				'email' => $this->input->post('email'),
				'nome' => $this->input->post('nome'),
				'mailing' => '1',
				'ip' => $_SERVER['REMOTE_ADDR']
			);
		
			$this->db->insert('tbl_newsletter', $data);
			$id = $this->db->insert_id();
		}
	}
	
	function salva_contattaci()
	{
		$data = array(
			'nome' => $this->input->post('nome'),
			'email' => $this->input->post('email'),
			'commenti' => $this->input->post('testo'),
			'privacy' => $this->input->post('si'),
			'ip' => $_SERVER['REMOTE_ADDR']
		);
		
		$this->db->insert('tbl_contatti', $data);
		$id = $this->db->insert_id();
	}
	
	function estrae_newsletter()
	{
		
	}
}