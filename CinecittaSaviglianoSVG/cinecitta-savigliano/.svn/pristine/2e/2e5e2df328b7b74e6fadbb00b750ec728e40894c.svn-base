<style>
	.play_list li {display:block; height:240px;}
	.locandina{float:left; margin-right:15px;}
</style>
<div class="title">
	<?php if($films):?>
		<h1>Programmazione <?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], true); ?></h1>
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
						<a href="<?php echo $this->config->item('base_url').$ancor_film;?>">
							<img src="<?php echo $this->config->item('base_url');?>locandine/<?php echo $film['locandina'];?>"/>
						</a>
					</div>
					<h3><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo ' <span> 3D</span>';?></h3>
					<p><?php echo substr($film['testo'], 0, 120) ;?> <em><a href="<?php echo $this->config->item('base_url').$ancor_film;?>">continua..</a></em></p>
					
					<h4>Orario</h4>
					<p><strong>Feriali:</strong><br/><?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></p>
					<p><strong>Festivi:</strong><br/><?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></p>
					<p class="note"><?php if(!empty($film['orario']['note']) && strlen($film['orario']['note'])>1) echo '<strong>Note:</strong> '.$film['orario']['note'];?></p>
					
					<p><?php if(!empty($film['trailer']) && strlen($film['trailer'])>1) echo '<img src="http://www.cinecittasavigliano.it/assets/web/images/video.gif" /> <a class="trailer" href="'.$this->config->item('base_url').$ancor_film.'#trailer" target=_new>Guarda il Trailer</a>';?></p>
			</li>
		<?php endforeach;?>
	</ul>
<?php else:?>
	<p> Nessun film caricato</p>
<?php endif;?>
</div>