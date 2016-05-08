<?php
class Newsm extends Model {

	function __construct()
	{
		parent::Model();
	}
	
	function get($id=NULL)
	{
		if(!empty($id))
		{
			$this->query = $this->db->query(
				'SELECT id, DATE(data_caricamento) as data_caricamento, DATE(data_news) as data_news, titolo, testo FROM tbl_news WHERE id = ? LIMIT 1',
				array($id)
			);
		}
		else
		{
			$this->query = $this->db->query('SELECT id, DATE(data_caricamento) as data_caricamento, DATE(data_news) as data_news, titolo, testo FROM tbl_news WHERE data_news <= NOW() ORDER BY data_news DESC LIMIT 1');
		}
		return $this->_extract();
	}
	
	function get_all($id=NULL)
	{
		$this->query = $this->db->query('SELECT id, DATE(data_caricamento) as data_caricamento, DATE(data_news) as data_news, titolo, testo FROM tbl_news ORDER BY data_news DESC LIMIT 20');
		return $this->_extract();
	}
	
	function _extract()
	{
		$news = $this->query->result_array();
		if(is_array($news) && count($news) > 0)
		{
			$return = array();
			$i=0;
			$attiva=FALSE;
			foreach ($news as $n)
			{
				$return[$n['id']]['id'] = $n['id'];
				list($anno, $mese, $giorno) = explode('-', $n['data_caricamento']);
				$return[$n['id']]['data_caricamento'] = $giorno.'/'.$mese.'/'.$anno;
				list($anno, $mese, $giorno) = explode('-', $n['data_news']);
				$return[$n['id']]['data_news'] = $giorno.'/'.$mese.'/'.$anno;
				$return[$n['id']]['titolo'] = $n['titolo'];
				$return[$n['id']]['testo'] = $n['testo'];
				
				if(date('Ymd') >= $anno.$mese.$giorno && !$attiva)
				{
					$return[$n['id']]['attiva'] = TRUE;
					$attiva = TRUE;
				}
				else
					$return[$n['id']]['attiva'] = FALSE;
			$i++;
			}
		return $return;
		}
		else
		{
			return FALSE;
		}
	}
	
	function crea($id='')
	{
		list($giorno, $mese, $anno) = explode('/', $this->input->post('data_news'));
		
		/*crea la riga nella tabella tbl_news */
		$this->db->set('data_caricamento', 'NOW()', FALSE);
		$this->db->set('data_news', $anno.'-'.$mese.'-'.$giorno.' '.'00:00:00');
		$this->db->set('titolo', $this->input->post('titolo'));
		$this->db->set('testo', $this->input->post('testo'));
		
		if(empty($id))
		{
			$this->db->insert('tbl_news');
			$id = $this->db->insert_id();
		}
		else
		{
			$this->db->where('id', $id);
			$this->db->update('tbl_news');
		}
		
		if(empty($id))
		{
			$error[] = 'Errore ID News';
			echo 'Errore';
			return $error;
		}
		
		$this->_clear_cache();
		
	return $id;
	}
	
	function modifica()
	{
		return $this->crea($this->input->post('id'));
	}
	
	function copia()
	{
		return $this->crea();
	}
	
	function check()
	{
		$action = $this->input->post('action');
		$data_news = $this->input->post('data_news');
		$titolo = $this->input->post('titolo');
		$testo = $this->input->post('testo');
		$errori = array();
		
		/* data_new, titolo, testo devono essere indicati*/
		if(empty($data_news)) $errori[] = 'Indicare data news';
		if(empty($titolo)) $errori[] = 'Indicare un titolo';
		if(empty($testo)) $errori[] = 'Indicare testo';
		
		list($giorno, $mese, $anno) = explode('/', $this->input->post('data_news'));
		$data_news = $anno.'-'.$mese.'-'.$giorno.' '.'00:00:00';
		$query = $this->db->query('SELECT id FROM tbl_news WHERE data_news = \''.$data_news.'\' LIMIT 1');
		if($query->num_rows() > 0 && $action != 'Modifica') $errori[] = 'Data inizio news già presente.';
		
		if( count($errori) == 0 ) return NULL;
		return $errori;
	}
	
	function cancella($id='')
	{
		$this->db->delete('tbl_news', array('id' => $id));
		
		$this->_clear_cache();
	return;
	}
	
	function _clear_cache()
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
	}
}