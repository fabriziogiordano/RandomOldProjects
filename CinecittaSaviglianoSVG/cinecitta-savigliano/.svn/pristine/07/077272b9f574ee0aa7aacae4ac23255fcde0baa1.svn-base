<?php
class Newsletters extends Model {
	
	function __construct()
	{
		parent::Model();
	}

	function get_all($paginatore = '')
	{
		if(empty($paginatore)) $paginatore = 0;
		$query = $this->db->query('SELECT id, DATE_FORMAT(data_creazione,\'%d/%m/%Y\') as data_creazione, DATE_FORMAT(data_invio,\'%d/%m/%Y\') as data_invio, oggetto, testo, tot_destinatari, data_invio as s FROM tbl_mail ORDER BY s DESC LIMIT ?, 30', array((int)$paginatore));
		return $query->result_array();
	}
	
	function check_sent($id_programmazione='')
	{
		if(empty($id_programmazione)) return FALSE;
		
		$query = $this->db->query('SELECT id_programmazione as n FROM tbl_mail WHERE id_programmazione = ? ', array($id_programmazione));
		
		if($query->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	return FALSE;
	}
	
	function count_to()
	{
		$query = $this->db->query('SELECT COUNT(*) as n FROM tbl_newsletter WHERE mailing = 1');
		
		if($query->num_rows()>0)
		{
			$row = $query->row();
			return $row->n;
		}
		else
		{
			return FALSE;
		}
	return FALSE;
	}
	
	function save($newsletter)
	{
		//$query = $this->db->query('SELECT id, nome, email FROM tbl_newsletter WHERE mailing = 1');
		$query = $this->db->query('SELECT count(email), id, LOWER(nome) as nome, LOWER(email) as email FROM tbl_newsletter WHERE mailing = 1 GROUP BY email');
		if($query->num_rows()>0)
		{
			
			//echo $newsletter['body'];
			
			/*Salva tabella  tbl_mail   */
			//$this->db->set('data_invio', 'NOW()', FALSE);
			$this->db->set('id_programmazione', $newsletter['id_programmazione']);
			$this->db->set('oggetto', $newsletter['oggetto']);
			$this->db->set('testo', $newsletter['body']);
			$this->db->set('tot_destinatari', $query->num_rows());
			$this->db->insert('tbl_mail');
			$id_newsletter = $this->db->insert_id();
			if(!$id_newsletter) return 0;
			
			$i=0;
			/*Salva tabella  tbl_mail_dett   */
			foreach ($query->result() as $ins)
			{
				//$this->db->set('data_invio', 'NOW()', FALSE);
				$this->db->set('id_mail', $id_newsletter);
				$this->db->set('utente_mail', $ins->email);
				$this->db->set('utente_nome', ucwords($ins->nome));
				$this->db->set('utente_id', $ins->id);
				$this->db->insert('tbl_mail_dett');
				$i++;
			}
			
			return array('id_newsletter'=>$id_newsletter, 'tot_newsletter'=>$i);
		}
	return 0;
	}
	
	function send($id_newletter = '')
	{
		if($_SERVER['SERVER_NAME'] == 'jiffycal.com') return TRUE;
		
		/*Selezione i dati della email*/
		$query = $this->db->query('SELECT id, oggetto, testo FROM tbl_mail WHERE id = ?', array($id_newletter));
		if($query->num_rows() > 0)
		{
			$this->db->set('data_invio', 'NOW()', FALSE);
			$this->db->where('id', $id_newletter);
			$this->db->update('tbl_mail');
			
			$row = $query->row();
			
			$body = base64_decode($row->testo);
			$from = $this->config->item('email_info');
			
			/*Estrae tutte le email e cicla l'invio*/
			$to = $this->db->query('SELECT id, utente_id, utente_mail, utente_nome FROM tbl_mail_dett WHERE id_mail = ? AND sent = ?', array($id_newletter,'0'));
			if($to->num_rows() > 0)
			{
				$i=0;
				foreach ($to->result() as $t)
				{
					$this->email->clear();
					
					$this->email->to($t->utente_mail);
					$this->email->from('noreply@cinecittasavigliano.it', 'Cinecittà Savigliano');
					$this->email->subject($row->oggetto);
					$this->email->message($this->_emailbody($body, $t->utente_nome, $t->utente_mail, $t->utente_id));
					$this->email->send();
					#echo $this->email->print_debugger();
					$i++; echo $i; flush();
					
					$this->db->set('data_invio', 'NOW()', FALSE);
					$this->db->set('sent', '1');
					$this->db->where('id', $t->id);
					$this->db->update('tbl_mail_dett');
				}
			}
			else
			{
				echo 'Errore 103: Nessuna email utente da inviare per id:'.$id_newletter;
			}
		}
		else
		{
			echo 'Errore 102: Nessuna newsletter da inviare per id:'.$id_newletter;
		}

	}
	
	function _emailbody($body, $nome, $email, $id)
	{
		$search  = array('[UTENTE]', '[EMAIL]', '[ID]', '../../../');
		$replace = array(ucfirst(strip_tags($nome)), md5($email), md5($id), 'http://www.cinecittasavigliano.it/');
	return str_replace($search, $replace, $body);
	}
	
	function remove_user($email, $id)
	{
		$query = $this->db->query('SELECT id FROM tbl_newsletter WHERE MD5(id) = ? AND MD5(email) = ?', array($id, $email));
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			$this->db->set('mailing', 0);
			$this->db->where('id', $row->id);
			$this->db->update('tbl_newsletter');
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	return FALSE;
	}
}