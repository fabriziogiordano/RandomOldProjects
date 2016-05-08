	<!--
	<section class="intro">
		<h2>Pannello di controllo: Cinecitt&agrave; Savigliano</h2>
		<p>Per richieste di aiuto chiamare Fabrizio Giordano +39 331 6323134.</p>
	</section>
	-->
	<?php 
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>
	
	<div class="title">
		<?php if($films):?>
			<em class="cancella"><a href="/pannello/programmazione/cancella/<?php echo $programmazione['id'];?>" id="programmazione_cancella">Cancella</a></em>
			<em><a href="/pannello/newsletter/crea/<?php echo $programmazione['id'];?>">Crea newsletter</a></em>
			<em><a href="/pannello/programmazione/redazioni/<?php echo $programmazione['id'];?>">Invia alle redazioni</a></em>
			<em><a href="/<?php echo $programmazione['id'];?>">Anteprima</a></em>
			<h2>Programmazione <?php if($programmazione['incorso']) echo ' Attiva ';?><span><?php echo titoloprogrammazione::titolo( $programmazione['inizio']['giorno'], $programmazione['inizio']['mese'], $programmazione['fine']['giorno'], $programmazione['fine']['mese'], false); ?><br/><small>(Attivazione: <?php echo $programmazione['attivazione']['giorno'];?> <?php echo $programmazione['attivazione']['mese'];?>)</small></span> <span id="result"> </span> </h2>
			<p><?php echo $programmazione['note'];?></p>
		<?php else:?>
			<h2>Nessuna programmazione valida</h2>
		<?php endif;?>
	</div>
	
<script type="text/javascript">
/* <![CDATA[ */
$(function() {
	$("#sortable").sortable({
				update: function(e, ui) {
						var order = $('#sortable').sortable('serialize');
						/*alert(order);*/
						$.ajax({
							type: "POST",
							url: "/pannello/film/reorder",
							data: "id_programmazione=<?php echo $programmazione['id'];?>&"+order,
							beforeSend: function(){
								/* $('#result').empty().html('<img src="/assets/pannello/images/loading.gif" style="position:relative; top:4px;" />'); */
							},
							success: function(result){
								/* $('#result').empty().html(result);
							},
							error: function() {
								/* $('#result').empty().html('Connection error'); */
							}
						});
					}
			});
	$("#sortable").disableSelection();
});
/* ]]> */
</script>
	
	<section class="play_list">
	<?php if($films):?>
		<ul id="sortable">
			<?php foreach($films as $film):?>
				<li id="film_<?php echo $film['id_film'];?>" <?php if(!empty($film['tred']) && $film['tred']) echo 'class="tred"';?>>
					<article>
						<a href="/pannello/film/gestione/<?php echo $film['id_film'];?>">
							<img src="/locandine/<?php echo $film['locandina'];?>"/>
						</a>
						<h4><a href="/pannello/film/gestione/<?php echo $film['id_film'];?>"><?php echo $film['titolo'];?> <?php if(!empty($film['tred']) && $film['tred']) echo ' <span> 3D</span>';?> </a></h4>
						<p><strong>Feriali:</strong><br/><?php if(!empty($film['orario']['feriale']) && strlen($film['orario']['feriale'])>1) echo $film['orario']['feriale'];?></p>
						<p><strong>Festivi:</strong><br/><?php if(!empty($film['orario']['festivo']) && strlen($film['orario']['festivo'])>1) echo $film['orario']['festivo'];?></p>
						<p><?php if(!empty($film['orario']['note']) && strlen($film['orario']['note'])>1) echo '<strong>Note:</strong> '.$film['orario']['note'];?></p>
					</article>
				</li>
			<?php endforeach;?>
		</ul>
	<?php else:?>
		<div class="ui-widget">
			<div style="margin: 10px 0 20px; padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all"> 
				<p style="margin: 10px;"><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>
				<strong>Errore:</strong> Nessun film caricato</p>
			</div>
		</div>
	<?php endif;?>
	</section>
</div>