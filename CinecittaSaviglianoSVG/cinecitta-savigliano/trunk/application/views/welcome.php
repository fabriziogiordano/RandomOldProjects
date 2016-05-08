<div class="main browse">
	<!-- Placeholder for messages in home page
	<div class="title"><h2>Titolo</h2></div>
	<div class="body"><p>Messaggio</p></div>
	-->
	
	<div class="title">
		<?php if($films):?>
			<h2>Programmazione <?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], true); ?></h2>
			<p><?php echo $programmazione['note'];?></p>
		<?php else:?>
			<h2>Nessuna programmazione valida</h2>
		<?php endif;?>
	</div>
	
	<div class="play_list">
	<?php if($films):?>
		<ul>
			<?php foreach($films as $film):
			$ancor_film = 'film/'.$film['id_film'].'/'.url_title($film['titolo']);
			?>
			<li id="film_<?php echo $film['id_film'];?>" <?php if(!empty($film['tred']) && $film['tred']) echo 'class="tred"';?>>
					<div class="locandina">
						<a href="/<?php echo $ancor_film;?>"><img src="/locandine/<?php echo $film['locandina'];?>"/></a>
						<div class="cover boxcaption">
							<em><a href="/<?php echo $ancor_film;?>">continua..</a></em>
							<h4><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo ' <span> 3D</span>';?></h4>
							<p><?php echo substr($film['testo'], 0, 120) ;?></p>
						</div>
					</div>
					<p class="subtitle">
						<?php if(!empty($film['trailer']) && strlen($film['trailer'])>1) echo '<a class="trailer" href="'.$film['trailer'].'">Trailer</a>';?>
						<span class="fbspan"><fb:like href="<?php echo $this->config->item('base_url').$ancor_film;?>" layout="button_count" width="100px" height="25px" show_faces="false"></fb:like></span>
					</p>
					<p class="orario">Orario</p>
					<p class="o"><strong>Feriali:</strong><br/><?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></p>
					<p class="o"><strong>Festivi:</strong><br/><?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></p>
					<p class="note"><?php if(!empty($film['orario']['note']) && strlen($film['orario']['note'])>1) echo '<strong>Note:</strong> '.$film['orario']['note'].'';?></p>
			</li>
			<?php endforeach;?>
		</ul>
	<?php else:?>
		<p> Nessun film caricato</p>
	<?php endif;?>
	</div>

<?php /*?>
	<ul class="film_list">
		<?php if($films):?>
			<?php foreach($films as $film):
			$ancor_film = '/film/'.$film['id_film'].'/'.url_title($film['titolo']);
			?>
				<li>
					<div>
						<a href="<?php echo $ancor_film; ?>">
							<img src="/locandine/<?php echo $film['locandina'];?>"/>
						</a>
					</div>
					<h4>
						<?php if(!empty($film['tred']) && $film['tred']) echo ' <span class="showtipsy" title="Film proiettato in 3D">3D</span>';?>
						<a href="<?php echo $ancor_film; ?>"><?php echo $film['titolo'];?></a>
					</h4>
					<ul>
						<li>
							<h5>Orario</h5>
							<p><strong>Feriali:</strong><br/><?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></p>
							<p><strong>Festivi:</strong><br/><?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></p>
							<p><?php if(!empty($film['orario']['note']) && strlen($film['orario']['note'])>1) echo '<strong>Note:</strong><br/>'.$film['orario']['note'];?></p>
						</li>
						<li>
							<h5>Trama</h5>
							<p>
								<?php if(!empty($film['testo'])) if(strlen($film['testo'])>50) echo substr($film['testo'],0,200).'...<br/><a href="'.$ancor_film.'">Continua a leggere</a>'; else echo $film['testo'];?>
							</p>
						</li>
					</ul>
				</li>
			<?php endforeach;?>
		<?php else:?>
			<li>
				<p><strong>Errore:</strong> Nessun film caricato</p>
			</li>
		<?php endif;?>
	</ul>
<?php */?>

</div>