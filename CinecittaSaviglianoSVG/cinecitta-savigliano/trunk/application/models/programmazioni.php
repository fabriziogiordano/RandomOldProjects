<?php
class Programmazioni extends Model {

	function __construct()
	{
		parent::Model();
		
		$this->mese = array(
			'01'=>'Gennaio',
			'02'=>'Febbraio',
			'03'=>'Marzo',
			'04'=>'Aprile',
			'05'=>'Maggio',
			'06'=>'Giugno',
			'07'=>'Luglio',
			'08'=>'Agosto',
			'09'=>'Settembre',
			'10'=>'Ottobre',
			'11'=>'Novembre',
			'12'=>'Dicembre'
			);
	}
	
	function get($id='')
	{
		if(!empty($id))
		{
			$query = $this->db->query(
				'SELECT id, DATE(data_caricamento) as data_caricamento, DATE(inizio) as inizio, DATE(fine) as fine, DATE(attivazione) as attivazione, attivo, note FROM tbl_programmazione WHERE id = ? LIMIT 1',
				array($id)
			);
		}
		/*Estrae quella attiva*/
		else
		{
			$query = $this->db->query('SELECT id, DATE(data_caricamento) as data_caricamento, DATE(inizio) as inizio, DATE(fine) as fine, DATE(attivazione) as attivazione, attivo, note FROM tbl_programmazione WHERE attivazione <= CURDATE() AND fine >= CURDATE() LIMIT 1');
		}
		
		$row = $query->row_array();
		
		if(is_array($row) && count($row) != 0)
		{
			$return['id'] = $row['id'];
			$return['data_caricamento'] = $row['data_caricamento'];
			$return['inizio'] = $row['inizio'];
			list($anno, $mese, $giorno) = explode('-', $row['inizio']);
			$return['inizio'] = array('giorno'=>$giorno, 'mese'=>$this->_mese($mese), 'm'=>$mese, 'anno'=>$anno);
		
			$return['fine'] = $row['fine'];
			list($anno, $mese, $giorno) = explode('-', $row['fine']);
			$return['fine'] = array('giorno'=>$giorno, 'mese'=>$this->_mese($mese), 'm'=>$mese, 'anno'=>$anno);
		
			$return['attivazione'] = $row['attivazione'];
			list($anno, $mese, $giorno) = explode('-', $row['attivazione']);
			$return['attivazione'] = array('giorno'=>$giorno, 'mese'=>$this->_mese($mese), 'm'=>$mese, 'anno'=>$anno);
		
			$return['attivo'] = $row['attivo'];
			$return['note'] = $row['note'];
		
			$return['incorso'] = $this->_incorso($row['inizio'],$row['fine'],$row['attivazione']);
			return $return;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_all()
	{
		$query = $this->db->query('SELECT id, DATE(data_caricamento) as data_caricamento, DATE(inizio) as inizio, DATE(fine) as fine, DATE(attivazione) as attivazione, attivo, note FROM tbl_programmazione ORDER BY inizio DESC LIMIT 10');
		$programmazioni = $query->result_array();
		if(is_array($programmazioni) && count($programmazioni) > 0)
		{
			$return = array();
			$i=0;
			foreach ($programmazioni as $row)
			{
				$return[$row['id']]['id'] = $row['id'];
				$return[$row['id']]['data_caricamento'] = $row['data_caricamento'];
				$return[$row['id']]['inizio'] = $row['inizio'];
				list($anno, $mese, $giorno) = explode('-', $row['inizio']);
				$return[$row['id']]['inizio'] = array('giorno'=>$giorno, 'mese'=>$this->_mese($mese), /*'mese'=>$mese,*/ 'anno'=>$anno);
		
				$return[$row['id']]['fine'] = $row['fine'];
				list($anno, $mese, $giorno) = explode('-', $row['fine']);
				$return[$row['id']]['fine'] = array('giorno'=>$giorno, 'mese'=>$this->_mese($mese), /*'mese'=>$mese,*/ 'anno'=>$anno);
		
				$return[$row['id']]['attivazione'] = $row['attivazione'];
				list($anno, $mese, $giorno) = explode('-', $row['attivazione']);
				$return[$row['id']]['attivazione'] = array('giorno'=>$giorno, 'mese'=>$this->_mese($mese), /*'mese'=>$mese,*/ 'anno'=>$anno);
		
				$return[$row['id']]['attivo'] = $row['attivo'];
				$return[$row['id']]['note'] = $row['note'];
		
				$return[$row['id']]['incorso'] = $this->_incorso($row['inizio'],$row['fine'],$row['attivazione']);
		
				//print_r($return);
			$i++;
			}
		return $return;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_details($id='')
	{
		/*Estrae*/
		$films = $this->db->query(
			'SELECT p.id_film as id_film, f.titolo as titolo, f.url as url, f.testo as testo, f.locandina as locandina, f.trailer as trailer, f.anteprima as anteprima, f.tred as tred, p.note as note FROM tbl_program_dettaglio p LEFT JOIN tbl_film f ON p.id_film = f.id WHERE id_programmazione = ? ORDER BY p.order ASC',
			array($id)
		);

		//$a = $query->result_array();
		//print_r($a);
		foreach ($films->result_array() as $row)
		{
			$film[$row['id_film']]['id_film'] = $row['id_film'];
			$film[$row['id_film']]['titolo'] = $row['titolo'];
			$film[$row['id_film']]['url'] = $row['url'];
			$film[$row['id_film']]['testo'] = nl2br($row['testo']);
			$film[$row['id_film']]['locandina'] = $row['locandina'];
			$film[$row['id_film']]['anteprima'] = $row['anteprima'];
			$film[$row['id_film']]['trailer'] = $row['trailer'];
			$film[$row['id_film']]['tred'] = $row['tred'];
			$film[$row['id_film']]['orario'] = $this->_orario($id, $row['id_film']);
			$film[$row['id_film']]['orario']['note'] = $row['note'];
		}
		//print_r($film);
	return $film;
	}
	
	function get_film_titles($id='')
	{
		/*Estrae*/
		$films = $this->db->query(
			'SELECT f.titolo as titolo FROM tbl_program_dettaglio p LEFT JOIN tbl_film f ON p.id_film = f.id WHERE id_programmazione = ? ORDER BY p.order ASC',
			array($id)
		);
		$title = '';
		foreach ($films->result_array() as $row)
		{
			$title .= $row['titolo'].', ';
		}
		$title = substr($title, 0, -2);
	return $title;
	}
	
	function crea($id='')
	{
		$periodo = $this->input->post('periodo');
		list($igiorno, $imese, $ianno) = explode('/', $periodo['inizio']);
		list($fgiorno, $fmese, $fanno) = explode('/', $periodo['fine']);
		list($agiorno, $amese, $aanno) = explode('/', $periodo['attivazione']);
		
		/*crea la riga nella tabella tbl_programmazione */
			$data = array(
				/*'data_caricamento' => 'NOW()',*/
				'inizio' => $ianno.'-'.$imese.'-'.$igiorno.' '.'00:00:00',
				'fine' => $fanno.'-'.$fmese.'-'.$fgiorno.' '.'00:00:00',
				'attivazione' => $aanno.'-'.$amese.'-'.$agiorno.' '.'00:00:00',
				/*'attivo' => ,*/
				'note' => $periodo['note'],
			);
			
			if(empty($id))
			{
				$this->db->insert('tbl_programmazione', $data);
				$id = $this->db->insert_id();
			}
			else
			{
				$this->db->update('tbl_programmazione', $data, array('id' => $id));
			}
			
			if(empty($id))
			{
				$error[] = 'Errore ID Programmazione';
				echo 'Errore';
				return $error;
			}
			
		$orari = $this->input->post('orario');
		//var_dump($orari);
		/*crea la riga nella tabella tbl_orario */
		/*crea la riga nella tabella tbl_program_dettaglio */
			$this->db->delete('tbl_orario', array('id_programmazione' => $id));
			$this->db->delete('tbl_program_dettaglio', array('id_programmazione' => $id));
			foreach($orari as $orario)
			{
				if(empty($orario['id_film']) || $orario['id_film'] == 0) continue;
				$data = array(
					'id_programmazione' => $id,
					'id_film' => $orario['id_film'],
					/*'id_sala' => ,*/
					'data' => 'feriale',
					'orario' => $orario['orario']['feriale']
				);
				$this->db->insert('tbl_orario', $data);
				$data = array(
					'id_programmazione' => $id,
					'id_film' => $orario['id_film'],
					/*'id_sala' => ,*/
					'data' => 'festivo',
					'orario' => $orario['orario']['festivo']
				);
				$this->db->insert('tbl_orario', $data);
				
				$data = array(
					'id_programmazione' => $id,
					'id_film' => $orario['id_film'],
					/*'id_sala' => ,*/
					/*'id_orario' => , TODO cancellare questa colonna */
					'note' => $orario['note']
				);
				$this->db->insert('tbl_program_dettaglio', $data);
			}
		
		$this->_clear_cache();
		
	return $id;
	}
	
	function modifica()
	{
		return $this->crea($this->input->post('id_programmazione'));
	}
	
	function copia()
	{
		return $this->crea();
	}
	
	function cancella($id='')
	{
		$this->db->delete('tbl_programmazione', array('id' => $id));
		$this->db->delete('tbl_orario', array('id_programmazione' => $id));
		$this->db->delete('tbl_program_dettaglio', array('id_programmazione' => $id));
		
		$this->_clear_cache();
		
	return;
	}
	
	function check()
	{
		$periodo = $this->input->post('periodo');
		$orari = $this->input->post('orario');
		$errori = array();
		
		/* data inizio e data fine devono essere indicati*/
		if(empty($periodo['inizio']) || empty($periodo['fine']) )
		{
			$errori[] = 'Indicare data di inizio e di fine';
			return $errori;
		}
		
		/* data inizio minore data fine */
			list($igiorno, $imese, $ianno) = explode('/', $periodo['inizio']);
			list($fgiorno, $fmese, $fanno) = explode('/', $periodo['fine']);
			list($agiorno, $amese, $aanno) = explode('/', $periodo['attivazione']);
			$inizio = $ianno.$imese.$igiorno;
			$fine = $fanno.$fmese.$fgiorno;
			$attivazione = $aanno.$amese.$agiorno;
			
			if($inizio>$fine)
			{
				$errori[] = 'Data inizio deve essere maggiore della data di fine.';
				return $errori;
			}
			if($attivazione>$inizio)
			{
				$errori[] = 'Data attivazione deve essere minore della data di inizio.';
				return $errori;
			}
		
		/* date programmazioni non everlappano altre programmazioni */
			if($this->input->post('action') != 'Modifica')
			{
				$inizio = $ianno.'-'.$imese.'-'.$igiorno;
				$fine = $fanno.'-'.$fmese.'-'.$fgiorno;
				$attivazione = $aanno.'-'.$amese.'-'.$agiorno;
				$query = $this->db->query("
					SELECT id, DATE(inizio) as inizio, DATE(fine) as fine
					FROM tbl_programmazione
					WHERE
					('$inizio' >= inizio AND '$inizio' <= fine)
					OR
					('$fine' >= inizio AND '$fine' <= fine)
					OR
					('$inizio' <= inizio AND '$fine' >= fine)
					OR
					('$inizio' >= inizio AND '$fine' <= fine)
				
					/*
					OR
					('$fine' >= inizio AND '$inizio' <= fine)
					OR
					('$inizio' <= inizio AND '$fine' >= fine)
					OR
					('$inizio' <= fine AND '$fine' <= fine)
					*/
				");
				if ($query->num_rows() > 0)
				{
					foreach ($query->result_array() as $row)
					{
						list($ianno, $imese, $igiorno) = explode('-', $row['inizio']);
						list($fanno, $fmese, $fgiorno) = explode('-', $row['fine']);
				
						$errori[] = 'Programmazione <a href="'.$row['id'].'" target=_new>dal '.$igiorno.' '.$this->_mese($imese).' al '.$fgiorno.' '.$this->_mese($fmese).' </a> nello stesso periodo.';
					}
					return $errori;
				}
			}
		
		/*deve esserci almeno un film*/
			$check_film = TRUE;
			$check_orario = FALSE;
			foreach($orari as $orario)
			{
				if(!empty($orario['id_film']) || $orario['id_film'] > 0) $check_film = FALSE;
				if(!empty($orario['id_film']) && empty($orario['orario']['feriale']) && empty($orario['orario']['festivo'])) $check_orario = TRUE;
			}
			if($check_film) $errori[] = 'Occorre selezionare almeno un film';
			if($check_orario) $errori[] = 'Occorre indicare almeno un orario feriale e/o festivo';
		
		
		if( count($errori) == 0 ) return NULL;
		return $errori;
	}
	
	function _incorso($inizio = '', $fine = '', $attivazione = '')
	{
		
		list($anno, $mese, $giorno) = explode('-', $inizio);
		$inizio = $anno.$mese.$giorno;
		
		list($anno, $mese, $giorno) = explode('-', $fine);
		$fine = $anno.$mese.$giorno;
		
		list($anno, $mese, $giorno) = explode('-', $attivazione);
		$attivazione = $anno.$mese.$giorno;
		
		$oggi = date("Ymd");
		
		if( ( $oggi >= $inizio || $oggi >= $attivazione )  && $oggi <= $fine ) return TRUE;
		return FALSE;
	}
	
	function _mese($mese = '', $size = '')
	{
		return $this->mese[$mese];
	}
	
	function _orario($id_programmazione='', $id_film='')
	{
		//echo $id_programmazione;
		//echo $id_film;
		/*Estrae Orari*/
		$orari = $this->db->query(
			'SELECT data, orario FROM tbl_orario WHERE id_programmazione = ? AND id_film = ?',
			array($id_programmazione,$id_film)
		);
		foreach ($orari->result_array() as $row)
		{
			//var_dump($row);
			$orario[$row['data']] = $row['orario'];
		}
		//print_r($orario);
	return $orario;
	}
	
	function reorder($id_programmazione='', $order='')
	{
		$i=0;
		foreach($order as $o)
		{
			$this->db->update('tbl_program_dettaglio', array('order'=>$i), array('id_programmazione' => $id_programmazione, 'id_film' => $o));
			$i++;
		}
		$this->_clear_cache();
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