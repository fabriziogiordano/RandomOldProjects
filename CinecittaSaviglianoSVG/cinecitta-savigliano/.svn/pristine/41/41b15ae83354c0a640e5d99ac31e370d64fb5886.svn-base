	<?php if(!empty($errori)):?>
	<div class="errors">
		<h2>Errore</h2>
		<?php
		foreach($errori as $errore)
		{
			echo '<p>'.$errore.'</p>';
		}
		?>
	</div>
	<?php endif;?>
	<div class="title">
		<h2>Film - Gestione</h2>
	</div>

	<form action="/pannello/film/submit" method="post" class="main_form" enctype="multipart/form-data">
		<?php echo form_hidden('id', $id); ?>
		<?php echo form_hidden('action', $action); ?>
		<?php echo form_hidden('locandina', $locandina); ?>

		<div style="float:right; width:260px">
			<label style="font-size:11px">Cerca su Film Up:</label> <input id="filmup" name="filmup" type="text" value="Cerca su FilmUp"/>
			<br/><br/>
			<label style="font-size:11px">Cerca su Youtube:</label> <input id="youtube" name="youtube" type="text" value="Cerca su Youtube"/>
			<?php if(!empty($locandina)):?>
				<img src="<?php echo '/locandine/'.$locandina;?>" id="locandina" width="160px" height="200px" style="margin-top:20px; margin-left:0px;"/>
			<?php endif;?>
		</div>

		<p>
			<label>Titolo <small style="display:inline;">prossimamente <?php echo form_checkbox('anteprima', '1', $anteprima);?></small></label>
			<?php echo form_input(array('id'=>'titolo', 'name' => 'titolo', 'value' => $titolo, 'size' => '40', 'class' => 'text')); ?>
			<label class="aside"><?php echo form_checkbox('tred', '1', $tred);?> 3D</label>
		</p>
		<p>
			<label>Url</label>
			<?php echo form_input(array('id'=>'url', 'name' => 'url', 'value' => $url, 'size' => '40', 'class' => 'text')); ?>
		</p>
		<p>
			<label>Trailer</label>
			<?php echo form_input(array('id'=>'trailer', 'name' => 'trailer', 'value' => $trailer, 'size' => '40', 'class' => 'text')); ?>
			<small>Incollare l'URL della pagina del trailer su Youtube se presente.</small>
		</p>
		<p>
			<label for="textarea">Trama / Descrizione:</label>
			<?php echo form_textarea(array('id'=>'testo', 'name' => 'testo', 'value' => $testo, 'rows' => '5', 'cols'=> '38', 'class' => 'text')); ?>
		</p>
		<p>
			<label>Carica locandina</label>
			<input type="file" id="locandinalocal" name="locandinalocal" class="text" size="10"/>
		</p>
		<p>
			<label>Carica locandina da Web</label>
			<?php echo form_input(array('id'=>'locandinaweb', 'name' => 'locandinaweb', 'value' => 'http://', 'size' => '40', 'class' => 'text')); ?>
			<small>Fare tasto destro sull’immagine dal sito del film e copiare l’indirizzo url dell’immagine qui.</small>
		</p>

		<p>
		    <input type="submit" value="Carica" />
	    </p>
	</form>
</div>