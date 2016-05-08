<?php
class Films extends Model {

	function __construct()
	{
		parent::Model();
	}

	function form_select()
	{
		$query = $this->db->query('SELECT id, titolo, locandina FROM tbl_film WHERE anteprima != 1 AND data_caricamento > DATE_SUB(CURDATE(),INTERVAL 45 DAY) ORDER BY data_caricamento DESC LIMIT 30');
		return $query->result_array();
	}

	function lista()
	{
		$query = $this->db->query('SELECT id, titolo, url, testo, locandina, trailer, anteprima, tred FROM tbl_film ORDER BY anteprima DESC, data_caricamento DESC LIMIT 30');
		$i=0;
		foreach ($query->result_array() as $row)
		{
			$f[$i]['id'] = $row['id'];
			$f[$i]['titolo'] = stripslashes($row['titolo']);
			$f[$i]['url'] = ($row['url']) ? $row['url']:'n/a';
			$f[$i]['trailer'] = ($row['trailer']) ? $row['trailer']:'';
			$f[$i]['testo'] = nl2br(stripslashes($row['testo']));
			$f[$i]['locandina'] = $row['locandina'];
			$f[$i]['anteprima'] = $row['anteprima'];
			$f[$i]['tred'] = $row['tred'];
		$i++;
		}
		return $f;
	}

	function get($id='')
	{
		if(empty($id)) return FALSE;

		$query = $this->db->query('SELECT id, titolo, url, testo, locandina, trailer, anteprima, tred FROM tbl_film WHERE id = ?', array($id));
		if($query->num_rows() == 1)
		{
			$i=0;
			foreach ($query->result_array() as $row)
			{
				$f['id'] = $row['id'];
				$f['titolo'] = stripslashes($row['titolo']);
				$f['url'] = ($row['url']) ? $row['url']:'n/a';
				$f['trailer'] = ($row['trailer']) ? $row['trailer']:'';
				$f['testo'] = nl2br(stripslashes($row['testo']));
				$f['locandina'] = $row['locandina'];
				$f['anteprima'] = $row['anteprima'];
				$f['tred'] = $row['tred'];
			$i++;
			}
			return $f;
		}
		return FALSE;
	}

	function anteprima_update($id='')
	{
		$query = $this->db->query('SELECT anteprima FROM tbl_film WHERE id = ?', array($id));
		$row = $query->row_array();
		if($row['anteprima']) $row['anteprima'] = 0; else $row['anteprima'] = 1;

		$data = array('anteprima'=>$row['anteprima']);
		$this->db->update('tbl_film', $data, array('id' => $id));

		$this->_clear_cache();

	return $row['anteprima'];
	}

	function crea($id='')
	{
		/*crea la riga nella tabella tbl_programmazione */
		$data = array(
			'titolo' => $this->input->post('titolo'),
			'url' => $this->input->post('url'),
			'trailer' => $this->input->post('trailer'),
			'testo' => $this->input->post('testo'),
			'locandina' => $this->locandina,
			'anteprima' => $this->input->post('anteprima'),
			'tred' => $this->input->post('tred')
		);

		if(empty($id))
		{
			$this->db->insert('tbl_film', $data);
			$id = $this->db->insert_id();
		}
		else
		{
			$this->db->update('tbl_film', $data, array('id' => $id));
		}

		$this->_clear_cache();
	}

	function check($id='')
	{
		$titolo = $this->input->post('titolo');
		if(!empty($titolo) && strlen($titolo)<3)
		{
			$errori[] = 'Il titolo film deve essere di almeno 3 caratteri';
			return $errori;
		}


		$this->locandina = $this->input->post('locandina');

		if(!empty($_FILES['locandinalocal']) && $_FILES['locandinalocal']['error'] != 4)
		{
			$this->locandina = $this->_locandina_local();
			if(is_array($this->locandina)) return $this->locandina;
		}

		$locandinaurl = $this->input->post('locandinaweb');
		if(!empty($locandinaurl) && strlen($locandinaurl)>8)
		{
			$this->locandina = $this->_locandina_web($locandinaurl);
			if(is_array($this->locandina)) return $this->locandina;
		}
	}

	function anteprime()
	{
		$query = $this->db->query('SELECT id, titolo, url, testo, locandina, trailer, anteprima, tred FROM tbl_film WHERE anteprima = \'1\' ORDER BY anteprima DESC, data_caricamento DESC LIMIT 30');
		$i=0;
		foreach ($query->result_array() as $row)
		{
			$f[$i]['id'] = $row['id'];
			$f[$i]['id_film'] = $row['id'];
			$f[$i]['titolo'] = stripslashes($row['titolo']);
			$f[$i]['url'] = ($row['url']) ? $row['url']:'n/a';
			$f[$i]['trailer'] = ($row['trailer']) ? $row['trailer']:'';
			$f[$i]['testo'] = nl2br(stripslashes($row['testo']));
			$f[$i]['locandina'] = $row['locandina'];
			$f[$i]['anteprima'] = $row['anteprima'];
			$f[$i]['tred'] = $row['tred'];
		$i++;
		}
		return (!empty($f)) ? $f : array();
	}

	function _locandina_local()
	{
		$config['upload_path'] = './locandine/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('locandinalocal'))
		{
			$errori = array();
			$errori[] = $this->upload->display_errors();
			return $errori;
		}
		else
		{
			$file = $this->upload->data();
			return $file['file_name'];
		}
	return FALSE;
	}

	function _locandina_web($url)
	{
		$copy = @fopen($url, 'rb');
		$contents = '';
		if($copy){
			while (!feof($copy)) $contents .= fread($copy, 1024);
			fclose($copy);

			$nome = basename($url);
			$paste = fopen(FCPATH.'/locandine/'.$nome,'wb');
			fwrite($paste,$contents);
			fclose($paste);
			return $nome;
		}
		else {
			$errori = array();
			$errori[] = '<p>Errore nel leggere il file remoto.</p>';
			return $errori;
		}
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