<div style="font-size:small"><a href="/mobile">Indietro</a></div></div>

<?php if($film):?>
	<div><b><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo ' <em> 3D</em>';?></b></div>
<?php else:?>
	<div><b>Film non disponibile</b></div>
<?php endif;?>
<div class="s"><b> </b></div>

<?php if($film):?>
	<div><img src="/locandine/<?php echo $film['locandina'];?>"/></div>
	<h3>Trama</h3>
	<?php echo $film['testo'];?>
	<h3>URL</h3>
	<a href="<?php echo $film['url'];?>"><?php echo $film['url'];?></a>
<?php else:?>
	<p><strong>Errore:</strong> Film non disponibile</p>
<?php endif;?>