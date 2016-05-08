	<?php
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>

	<div class="title">
		<h2>Films</h2>
		<p>Films caricati su Cinecitt&agrave; Savigliano</p>
	</div>
	<form action="#" method="post" class="main_form">
		<fieldset class="film">
		<legend>Films <em><a href="/pannello/film/gestione">Aggiungi</a></em></legend>
			<?php foreach($films as $film): ?>
			<ul class="clearfix">
				<li>
				<div class="listafilm">
					<em><a href="/pannello/film/gestione/<?php echo $film['id'];?>">Aggiorna</a></em>
					<p>
						<label>Titolo</label>
						<?php echo $film['titolo'];?>
					</p>
					<p>
						<label>Url</label>
						<a href="<?php echo $film['url'];?>"><?php echo $film['url'];?></a>
					</p>
					<p>
						<label>Trailer</label>
						<a href="<?php echo $film['trailer'];?>"><?php echo $film['trailer'];?></a>
					</p>
					<p>
						<label>Prossimamente</label>
						<span id="a-<?php echo $film['id'];?>" class="<?php echo $film['id'];?>"><?php if($film['anteprima']) echo 'si'; else echo 'no'; ?></span>
						<a href="#" class="anteprima_cambia"> cambia </a>
					</p>
					<p>
						<label>3D</label><?php if($film['tred']) echo 'si'; else echo 'no'; ?>
					</p>
					<p>
						<label>Descrizione</label>
						<?php echo substr($film['testo'],0,160);?> ...
					</p>
				</div>
				<div>
					<img src="<?php if(!empty($film['locandina'])) echo '/locandine/'.$film['locandina']; else echo 'http://dummyimage.com/160x200/DDD/fff.jpg&text=seleziona'; ?>" width="160px" height="200px" />
				</div>
				</li>
			</ul>
			<?php endforeach;?>
		</fieldset>
	</form>
</div>