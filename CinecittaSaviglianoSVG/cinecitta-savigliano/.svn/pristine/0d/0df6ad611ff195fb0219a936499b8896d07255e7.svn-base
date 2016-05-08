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
	
	<?php 
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>
	
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
		<h2>News</h2>
		<p>Testo che compare nel box New dal Cinema</p>
	</div>
	
	<form action="/pannello/news/submit" method="post" class="main_form" enctype="multipart/form-data">
		<?php echo form_hidden('id', $id); ?>
		<?php echo form_hidden('action', $action); ?>
		<p class="calendario">
			<label>Data online</label>
			<?php echo form_input(array('id'=>'inizio', 'name' => 'data_news', 'value' => $data_news,'size' => '10', 'class' => 'text datepicker')); ?>
		</p>
		<p>
			<label>Titolo</label>
			<?php echo form_input(array('id'=>'url', 'name' => 'titolo', 'value' => $titolo, 'size' => '64', 'class' => 'text')); ?>
		</p>
		<p>
			<label for="textarea">Testo</label>
			<?php echo form_textarea(array('id'=>'testo', 'name' => 'testo', 'value' => $testo, 'rows' => '5', 'cols'=> '76', 'class' => 'tinymce')); ?>
		</p>
		<p>
		    <input type="submit" value="Carica" />
	    </p>
	</form>
</div>