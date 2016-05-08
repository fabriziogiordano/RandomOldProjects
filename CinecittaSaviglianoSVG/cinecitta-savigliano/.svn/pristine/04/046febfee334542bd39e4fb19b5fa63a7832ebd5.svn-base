<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Cinecitt&#224; Savigliano</title>
		<description>Programmazione di Cinecitt&#224; Savigliano</description>
		<link>http://www.cinecittasavigliano.it</link>
		<atom:link href="http://www.cinecittasavigliano.it/rss" rel="self" type="application/rss+xml" />
		
		<?php if($programmazione && $programmazione['incorso']):
		list($anno, $mese, $giorno) = explode('-', $programmazione['data_caricamento']);
		$data = date('r', mktime(0, 0, 0, ltrim($mese), ltrim($giorno), $anno) );
		?>
		<lastBuildDate><?php echo $data; ?></lastBuildDate>
		<pubDate><?php echo $data; ?></pubDate>
			<item>
				<title>Programmazione <?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false); ?></title>
				<link>http://www.cinecittasavigliano.it</link>
				<guid isPermaLink="false"><?php echo md5($data); ?></guid>
				<pubDate><?php echo $data; ?></pubDate>
				<description>
				<![CDATA[
					<p>Note: <?php echo utf8_encode($programmazione['note']);?></p><br/>
					<?php if($films):?>
					<?php foreach($films as $film):
						if(empty($film['orario']['feriale'])) $film['orario']['feriale'] = '';
						if(empty($film['orario']['festivo'])) $film['orario']['festivo'] = '';
						if(empty($film['note'])) $film['note'] = '';
						?>
						<br/>
						<strong><?php echo utf8_encode($film['titolo']);?></strong>
						<br/>
						<p><strong>Feriale:</strong> <?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></p>
						<p><strong>Festivi:</strong> <?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></p>
						<p><strong>Note:</strong> <?php echo utf8_encode($film['note']);?></p>
						<br/>
					<?php endforeach; ?>
					<?php else: ?>
						<p>Nessun film caricato.</p>
					<?php endif;?>
				]]>
					</description>
				</item>
		<?php else: ?>
			<lastBuildDate> <?php echo date('r'); ?> </lastBuildDate>
			<pubDate> <?php echo date('r'); ?> </pubDate>
		<?php endif; ?>
	</channel>
</rss>