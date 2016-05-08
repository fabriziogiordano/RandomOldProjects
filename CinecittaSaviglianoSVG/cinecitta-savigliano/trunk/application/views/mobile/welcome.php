<div><b>Programmazione</b></div>
<?php if($programmazione && $programmazione['incorso']):?>
	<div><b><?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false); ?></b></div>
	<div class="s"><?php echo $programmazione['note'];?> </div>
	<ul>
	<?php if($films):?>
		<?php foreach($films as $film):?>
			<li>
				<a href="/mobile/film/<?php echo $film['id_film'];?>"><?php echo $film['titolo'];?><?php if(!empty($film['tred']) && $film['tred']) echo " <span>- 3D</span>";?></a> 
				<p>Feriale: <span><?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></span></p>
				<p>Festivi: <span><?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></span></p>
				<?php if(!empty($film['orario']['note']) && strlen($film['orario']['note'])>1) echo '<p class="note">Note: '.$film['orario']['note'].'</p>';?>
			</li>
		<?php endforeach; ?>
	<?php else: ?>
		<li>Nessun film caricato.</li>
	<?php endif;?>
	</ul>
<?php else: ?>
	<div>Non ci sono al momento programmazioni disponibili.</div>
<?php endif; ?>