<div class="main browse">
	<div class="title">
		<?php if($film):?>
			<h2><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo ' <em> 3D</em>';?> </h2>
			<p><a href="/">&laquo; Programmazione</a></p>
		<?php else:?>
			<h2>Film non disponibile</h2>
		<?php endif;?>
	</div>
	
	<div class="body film">
	<?php if($film):?>
		<span><fb:like href="<?php echo $fb_og['url'];?>" layout="button_count" width="110" show_faces="false"></fb:like></span>
		<div>
			<img src="/locandine/<?php echo $film['locandina'];?>"/>
		</div>
		<h3>Sito web</h3>
			<a href="<?php echo $film['url'];?>"><?php echo $film['url'];?></a>
		
		<?php if(!empty($film['trailer']) && strlen($film['trailer'])>1):?>
		<h3>Trailer</h3>
			<a class="trailer" href="<?php echo $film['trailer']; ?>">Visualizza video</a>
		<?php endif;?>
		<h3>Trama</h3>
			<?php echo $film['testo'];?>
	<?php else:?>
		<p><strong>Errore:</strong> Film non disponibile</p>
	<?php endif;?>
	</div>
</div>