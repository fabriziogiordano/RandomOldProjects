<?php
class titoloprogrammazione{
	static function titolo($inizio_giorno, $inizio_mese, $fine_giorno, $fine_mese, $em=false){
		
		if($inizio_giorno == '01' || $inizio_giorno == '08') $dal = 'dall\''; else $dal = 'dal ';
		if($fine_giorno == '01' || $fine_giorno == '08') $al = 'all\''; else $al = 'al ';
		if($inizio_mese == $fine_mese) $inizio_mese = '';
		if($em)
		{
			$em1 = '<em>';
			$em2 = '</em>';
		}
		else
		{
			$em1 = '';
			$em2 = '';
		}
		return $dal.$em1.$inizio_giorno.' '.$inizio_mese.$em2.' '.$al.$em1.$fine_giorno.' '.$fine_mese.$em2;
	}
}