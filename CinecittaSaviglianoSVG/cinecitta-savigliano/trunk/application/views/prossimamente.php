<div class="main browse">
	<div class="title">
		<h2>Prossimamente</h2>
		<p>I film che verranno proiettati prossimamente sugli schermi di Cinecittà.</span></p>
	</div>
	<div class="play_list prossimamente">
	<span class="facebooklike"><fb:like layout="button_count" width="110" show_faces="false"></fb:like></span>
	<?php if($anteprime):?>
		<ul>
			<?php foreach($anteprime as $film):
			$ancor_film = 'film/'.$film['id_film'].'/'.url_title($film['titolo']);
			?>
				<li id="film_<?php echo $film['id_film'];?>" <?php if(!empty($film['tred']) && $film['tred']) echo 'class="tred"';?>>
						<div class="locandina">
							<a href="/<?php echo $ancor_film;?>">
								<img src="/locandine/<?php echo $film['locandina'];?>"/>
							</a>
							<div class="cover boxcaption">
								<em><a href="/<?php echo $ancor_film;?>">continua..</a></em>
								<h4><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo ' <span> 3D</span>';?></h4>
								<p><?php echo substr($film['testo'], 0, 120) ;?></p>
							</div>
						</div>
						<p class="subtitle" style="height:25px;">
							<?php if(!empty($film['trailer']) && strlen($film['trailer'])>1) echo '<a class="trailer" href="'.$film['trailer'].'">Trailer</a>';?>
							<span>
								<fb:like href="<?php echo $this->config->item('base_url').$ancor_film;?>" layout="button_count" width="100px" height="25px" show_faces="false"></fb:like>
							</span>
						</p>
				</li>
			<?php endforeach;?>
		</ul>
	<?php else:?>
		<p> Nessun film caricato</p>
	<?php endif;?>
	</div>
</div>