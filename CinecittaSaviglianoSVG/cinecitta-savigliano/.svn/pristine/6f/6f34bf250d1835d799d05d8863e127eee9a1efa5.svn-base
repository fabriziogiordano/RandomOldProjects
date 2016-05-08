	<div class="title">
		<h2>Newsletters</h2>
		<p>Anteprima</p>
	</div>
	
	<form action="/pannello/newsletter/generaemail" method="post" class="main_form">
		<?php echo form_hidden('id_programmazione', $id_programmazione); ?>
		<?php echo form_hidden('oggetto', base64_encode($oggetto)); ?>
		<?php echo form_hidden('body', base64_encode($body)); ?>
		<?php echo form_hidden('tot_email', $tot_email); ?>
		
		<fieldset>
			<label>Destinatari</label>
			<p class="newsletter">
				<b><?php echo $tot_email; ?></b>
			</p>
			<label>Oggetto</label>
			<p class="newsletter">
				<?php echo $oggetto; ?>
			</p>
			<label for="textarea">Corpo del messaggio</label>
			<p class="newsletter">
				<span> <?php echo $body; ?> </span>
			</p>
		</fieldset>
		<p>
		    <input type="submit" value="Genera emails" />
	    </p>
	</form>
	
</div>