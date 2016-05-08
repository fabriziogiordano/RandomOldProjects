<div id="home" class="current">
	<div class="toolbar">
		<a class="button2 slideup" href="#about">Info</a>
		<h1>Cinecitt&agrave;</h1>
		<a class="button slide" href="#prenota">Prenota</a>
		<!--<a class="button slideup" id="infoButton" href="#prenota">Prenota</a>-->
	</div>
	<!--
	<div class="info">
		These apps open in a new window. Don&#8217;t forget to save them to your home screen to enable full-screen mode.
	</div>
	-->
	<?php if($programmazione && $programmazione['incorso']):?>
	<?php
	if (preg_match('/android/i', $_SERVER['HTTP_USER_AGENT'])) {
		echo '<p style="text-align:center; padding: 10px">';
		echo 'Scarica l\'app ufficiale Android di Cinecitt&agrave; Savigliano.<br>';
		echo '<a href="https://play.google.com/store/apps/details?id=com.fabriziogiordano.cinecittasavigliano"><img src="http://assets.bikeplusapp.com/img/en_app_rgb_wo_45.png" alt="Cinecittà Savigliano Android App"></a>';
		echo '</p>';
	}
	
	if (preg_match('/ip(hone|od)/i', $_SERVER['HTTP_USER_AGENT'])) {
		echo 'L\'iPhone App ufficiale di Cinecitt&agrave; Savigliano &egrave; in review nell\'Apple Store.';
	}
	
	?>
	<h2>Programmazione <br/> <?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false); ?></h2>
	<h3><?php echo $programmazione['note'];?></h3>
	<ul class="rounded">
		<?php if($films):?>
		<?php foreach($films as $film):?>
		<li class="arrow">
			<a href="#film<?php echo $film['id_film'];?>">
				<h4><?php echo $film['titolo'];?><?php if(!empty($film['tred']) && $film['tred']) echo " <span>- 3D</span>";?></h4>
				<div class="locandina">
					<img src="/locandine/<?php echo $film['locandina'];?>"/>
				</div>
				<div class="orario">
				<span>
					<p>Feriale:<br/>
						<em><?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></em>
					</p>
					<p>Festivi:<br/>
						<em><?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></em>
					</p>
					<?php if(!empty($film['orario']['note']) && strlen($film['orario']['note'])>1) echo '<p class="note">Note:<br/>'.$film['orario']['note'].'</p>';?>
				</span>
				</div>
			</a>
		</li>
		<?php endforeach; ?>
		<?php else: ?>
			<h2>Nessun film caricato.</h2>
		<?php endif;?>
	</ul>
	<?php else: ?>
		<h2>Non ci sono al momento programmazioni disponibili.</h2>
	<?php endif; ?>
	
	<?php /* if($webapp): ?>
	<div class="info">
		<p>Aggiungi Cinecittà Savigliano ai tuoi preferiti, clicca sul <strong> + </strong> e salva questa WebApp.</p>
	</div>
	<?php endif; */ ?>
  <script type="text/javascript"><!--
    // XHTML should not attempt to parse these strings, declare them CDATA.
    /* <![CDATA[ */
    window.googleAfmcRequest = {
      client: 'ca-mb-pub-2824096340105392',
      format: '320x50_mb',
      output: 'html',
      slotname: '4263943672',
    };
    /* ]]> */
  //--></script>
  <script type="text/javascript"    src="http://pagead2.googlesyndication.com/pagead/show_afmc_ads.js"></script>
</div>

<?php if($films):?>
<?php foreach($films as $film):?>
<div id="film<?php echo $film['id_film'];?>">
	<div class="toolbar">
		<a class="back" href="#">Indietro</a>
		<h1><?php echo $film['titolo'];?></h1>
		<a class="button slide" href="#prenota">Prenota</a>
	</div>
	<ul class="rounded film">
		<li style="overflow:hidden;">
				<div class="locandina">
					<img src="/locandine/<?php echo $film['locandina'];?>"/>
				</div>
				<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<div class="descrizione">
					<h4><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo " <span>- 3D</span>";?></h4>
					<p><br/><strong>Trama</strong><br/><?php echo $film['testo'];?></p>
					<p><br/><strong>Indirizzo web</strong><br/><a href="<?php echo $film['url'];?>"><?php echo $film['url'];?></a></p>
				</div>
		</li>
	</ul>
	
  <?php /* if($webapp): ?>
  <div class="info">
    <p>Aggiungi Cinecittà Savigliano ai tuoi preferiti, clicca sul <strong> + </strong> e salva questa WebApp.</p>
  </div>
  <?php endif; */ ?>
</div>
<?php endforeach; ?>
<?php endif;?>

<div id="prenota">
	<div class="toolbar">
		<a class="back" href="#">Indietro</a>
		<h1>Prenota</h1>
	</div>
	<h2>Prenota</h2>
	<h3>
		Per prenotare puoi telefonare direttante al cinema, i posti migliori ti saranno riservati.
		<br/>Ricorda di ritirare i biglietti almeno 30 minuti prima dell'inizio dello spettacolo.
	</h3>
	<p><br /><br /><a href="tel://0172726324" class="greenButton goback">Chiama (0172 726324)</a></p>
</div>

<div id="about" class="selectable">
	<h2>Cinecitt&agrave; Savigliano</h2>
	<p><strong>Realizzato da <a href="http://fabriziogiordano.com/">http://fabriziogiordano.com/</a></strong></p>
	<p>Multisala - Cinecitt&agrave; Savigliano &copy; <?php echo date('Y');?> - P.IVA 02801680048 - Tel. 0172/726324 - Email. info@cinecittasavigliano.it </p>
	<p><br /><br /><a href="#" class="whiteButton goback">Chiudi</a></p>
</div>
