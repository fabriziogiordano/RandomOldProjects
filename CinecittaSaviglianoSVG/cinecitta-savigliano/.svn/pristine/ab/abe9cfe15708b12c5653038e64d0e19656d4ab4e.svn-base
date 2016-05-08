	<div class="title">
		<h2>Login</h2>
	</div>
	<form action="/pannello/login/submit" method="post" class="main_form">
		<p>
			<label>Utente:</label>
			<input type="text" class="text" size="20" name="utente" value="<?php echo set_value('utente', ''); ?>"/> <label class="aside"> <?php echo form_error('utente','',''); ?> </label>
		</p>
		<p>
			<label>Password:</label>
			<input type="password" class="text" size="20" name="password" value=""/> <label class="aside"> <?php echo form_error('password','',''); ?> </label>
		</p>
		<p>
			<input type="submit" value="Submit" />
			<?php echo validation_errors('<p class="error">','</p>'); ?>
		</p>
	</form>