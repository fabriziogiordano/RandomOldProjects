<script type="text/javascript">
	function locandina(select, locandina) { $('#'+locandina).attr('src', locandine[$('#'+select+' option:selected').val()]); return false; }
	var locandine=new Array();
	locandine[0]="http://dummyimage.com/160x200/DDD/fff.jpg&text=seleziona";
	<?php foreach($locandinajs as $k => $v) echo 'locandine['.$k.']="/locandine/'.$v.'"; '; ?>
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
	
	<div class="title">
		<h2><?php echo $action; ?> programmazione
		<?php if($action == 'Modifica'):?><span><?php echo $periodo['inizio'];?> al <?php echo $periodo['fine'];?></span><?php endif;?>
		</h2>
		<p><?php echo $periodo['note']; ?></p>
	</div>
	<form action="/pannello/programmazione/submit" method="post" class="main_form">
		<?php echo form_hidden('id_programmazione', $id_programmazione); ?>
		<?php echo form_hidden('action', $action); ?>
		
		<fieldset>
			<legend>Periodo</legend>
			<p class="calendario">
				<label>Data inizio</label>
				<?php echo form_input(array('id'=>'inizio', 'name' => 'periodo[inizio]', 'value' => $periodo['inizio'],'size' => '10', 'class' => 'text datepicker')); ?>
			</p>
			<p class="calendario">
				<label>Data fine</label>
				<?php echo form_input(array('id'=>'fine', 'name' => 'periodo[fine]', 'value' => $periodo['fine'],'size' => '10', 'class' => 'text datepicker')); ?>
			</p>
			<p class="calendario">
				<label>Data attivazione</label>
				<?php echo form_input(array('id'=>'attivazione', 'name' => 'periodo[attivazione]', 'value' => $periodo['attivazione'],'size' => '10', 'class' => 'text datepicker')); ?>
			</p>
			<p style="clear:left; margin-bottom:-10px;">
				<label><span>Note</span></label>
				<?php echo form_input(array('name' => 'periodo[note]', 'value' => $periodo['note'],'size' => '70', 'class' => 'text')); ?>
				<small><strong>Esempio:</strong> La programmazione potr&agrave; subire variazioni.</small>
			</p>
		</fieldset>
		<fieldset class="film">
		<legend>Films</legend>
			<?php for($i=0; $i<10; $i++):
			if(empty($film[$i]['id_film']))
			{
				$film[$i]['orario']['feriale'] = '';
				$film[$i]['orario']['festivo'] = '';
				$film[$i]['orario']['note'] = '';
				$film[$i]['id_film'] = '';
				$film[$i]['sala'] = 1;
				$film[$i]['locandina'] = '';
			}
			?>
			<ul class="clearfix <?php if($i>2 && empty($film[$i]['id_film'])) echo 'hidden"'; ?>">
				<li>
				<div class="orario">
					<label>Feriale</label>
					<?php echo form_input(array('name' => 'orario['.$i.'][orario][feriale]', 'value' => $film[$i]['orario']['feriale'],'size' => '30', 'class' => 'text')); ?>
					<small><strong>Esempio:</strong> 19:35 20:00</small>
					
					<label>Festivo</label>
					<?php echo form_input(array('name' => 'orario['.$i.'][orario][festivo]', 'value' => $film[$i]['orario']['festivo'],'size' => '30', 'class' => 'text')); ?>
					<small><strong>Esempio:</strong> 19:35 20:00</small>
					
					<label>Note</label>
					<?php echo form_input(array('name' => 'orario['.$i.'][note]', 'value' => $film[$i]['orario']['note'],'size' => '30', 'class' => 'text')); ?>
					<small><strong>Esempio:</strong> Film non adatto ad un pubblico giovane.</small>
				</div>
				<div>
					<p>
					<?php echo form_dropdown('orario['.$i.'][id_film]', $selectfilms, $film[$i]['id_film'], 'class="filmselect" id="select'.$i.'" onchange="locandina(\'select'.$i.'\', \'locandina'.$i.'\');"');?>
					<?php echo form_dropdown('orario['.$i.'][sala]', array( '1' => 'Sala 1', '2' => 'Sala 2', '3' => 'Sala 3', '4' => 'Sala 4', '5' => 'Sala 5' ), 1, 'class="hidden"');?>
					<!--<label class="hidden aside"><?php echo form_checkbox('orario['.$i.'][3d]', '1', FALSE); ?> 3D</label>-->
					</p>
					<img id="locandina<?php echo $i; ?>" src="<?php if(!empty($film[$i]['locandina'])) echo '/locandine/'.$film[$i]['locandina']; else echo 'http://dummyimage.com/160x200/DDD/fff.jpg&text=seleziona';?>" width="160px" height="200px"/>
					<?php echo form_hidden('orario['.$i.'][locandina]', $film[$i]['locandina']); ?>
				</div>
				</li>
			</ul>
			<?php endfor;?>
			<a href="/aggiungi_film" id="film_add">Aggiungi</a>
		</fieldset>
	
		<p>
		    <input type="submit" value="<?php echo $action; ?>" />
	    </p>
	</form>
</div>