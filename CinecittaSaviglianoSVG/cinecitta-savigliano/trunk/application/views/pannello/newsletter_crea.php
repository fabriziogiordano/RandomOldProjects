<script type="text/javascript" src="/assets/pannello/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
// Initializes all textareas with the tinymce class
$().ready(function() {
   $('textarea.tinymce').tinymce({
		script_url : '/assets/pannello/tiny_mce/tiny_mce.js',
		theme : "advanced",
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,link,unlink",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		/*
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "",
		*/
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "none",
		theme_advanced_resizing : true
   });
});
</script>
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

<?php if($alreadysent):?>
<div class="errors">
	<p>Programmazione già inviata agli utenti</p>
</div>
<?php endif;?>

<?php if($programmazione['attivo'] == 'si'):?>
<div class="infos">
	<p>Programmazione non ancora attiva</p>
</div>
<?php endif;?>

	<div class="title">
		<h2>Newsletter</h2>
		<p>Creazione</p>
	</div>
	<form action="/pannello/newsletter/anteprima" method="post" class="main_form">
		<?php echo form_hidden('id_programmazione', $id_programmazione); ?>
		
		<fieldset>
			<p>
				<label>Oggetto</label>
				<?php echo form_input(array('id'=>'oggetto', 'name' => 'oggetto', 'value' => $oggetto,'size' => '60', 'class' => 'text')); ?>
			</p>
			<p>
				<label for="textarea">Corpo del messaggio</label>
				<?php echo form_textarea(array('id'=>'body', 'name' => 'body', 'value' => $body, 'rows' => '35', 'cols'=> '65', 'class' => 'tinymce')); ?>
			</p>
		</fieldset>
		<p>
		    <input type="submit" value="Anteprima" />
	    </p>
	</form>
</div>