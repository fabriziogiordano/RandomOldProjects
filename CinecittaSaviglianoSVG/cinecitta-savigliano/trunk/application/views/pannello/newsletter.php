	<?php 
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>

	<div class="title">
		<h2>Newsletters</h2>
		<p>Elenco delle newsletter inviate agli utenti.</p>
	</div>
	
	<table>
		<tr class="title">
			<td style="width:100px">Data creazione</td>
			<td style="width:100px">Data invio</td>
			<td><a href="/pannello/newsletter/crea" class="add">Crea</a> Oggetto</td>
		</tr>
		<?php if($newsletter):?>
		<?php foreach($newsletter as $n):?>
			<tr>
				<td><?php echo $n['data_creazione'];?></td>
				<td><?php echo $n['data_invio'];?></td>
				<td>
					<em>Destinatari: <?php echo $n['tot_destinatari'];?></em>
					<a href="/newsletter/visualizza/<?php echo $n['id'];?>/<?php echo url_title($n['oggetto']);?>"><?php echo $n['oggetto'];?></a>
				</td>
			</tr>
		<?php endforeach;?>
		<?php endif;?>
	</table>
</div>