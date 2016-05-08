	<?php 
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>

	<div class="title">
		<h2>File temporanei</h2>
		<p>Elimina i file temporanei e la cache</p>
	</div>
	
	<div class="body">
		<p><a href="/pannello/cache/cancella">Cancella cache</a></p>
		
		<?php if(is_array($cache) && count($cache)>0):?>
			<p><strong>Totale files: <?php echo count($cache);?></strong></p>
		<?php foreach($cache as $c):?>
			<?php echo $c;?><br/>
		<?php endforeach;?>
		<?php elseif(is_array($cache) && count($cache)==0):?>
			Cache vuota
		<?php else:?>
			<?php echo $cache;?><br/>
		<?php endif;?>
		
	</div>
</div>