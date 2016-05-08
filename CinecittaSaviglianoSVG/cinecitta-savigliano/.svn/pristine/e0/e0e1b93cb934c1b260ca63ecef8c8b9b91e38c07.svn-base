	<div class="title">
		<?php if($films):?>
			<h2>Invia la programmazione: <span><?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false); ?></span></h2>
			<p><?php echo $programmazione['note'];?></p>
		<?php else:?>
			<h2>Nessuna programmazione valida</h2>
		<?php endif;?>
	</div>

	<?php if($films):?>
		<form action="#" method="post" class="main_form">
			<fieldset>
				<legend>Testo da inviare alle redazioni</legend>
				<p>
					<label for="textarea"><a href="#" id="programmazione_redazione_copia">Copia</a></label>

					<textarea cols="70" rows="30" id="programmazione_redazione_testo">
La programmazione <?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false); ?> prevede:

<?php foreach($films as $film):?>

<?php echo $film['titolo'];?>

Orario:
   Feriali: <?php echo $film['orario']['feriale'];?>

   Festivi: <?php echo $film['orario']['festivo'];?>

<?php endforeach;?>
					</textarea>
				</p>
			</fieldset>
		</form>
	<?php else:?>
		<div class="ui-widget">
			<div style="margin: 10px 0 20px; padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all"> 
				<p style="margin: 10px;"><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>
				<strong>Errore:</strong> Programmazione non valida</p>
			</div>
		</div>
	<?php endif;?>
</div>