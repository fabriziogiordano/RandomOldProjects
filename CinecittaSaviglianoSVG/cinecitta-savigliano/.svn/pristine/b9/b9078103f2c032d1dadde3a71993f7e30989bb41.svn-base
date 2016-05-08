	<?php 
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>

	<div class="title">
		<h2>News</h2>
		<p>Testo che compare nel box <strong>News</strong> del Cinema</p>
	</div>
	
	<table>
		<tr class="title">
			<td style="width:100px">Data online</td>
			<td><a href="/pannello/news/crea" class="add">Crea</a> Titolo</td>
		</tr>
		<?php if($news):?>
		<?php foreach($news as $n):?>
			<tr <?php if($n['attiva']) echo 'class="attiva"';?>>
				<td><?php echo $n['data_news'];?></td>
				<td>
					<em><a href="/pannello/news/cancella/<?php echo $n['id'];?>" class="news_cancella">Cancella</a></em>
					<em><a href="/pannello/news/modifica/<?php echo $n['id'];?>">Modifica</a></em>
					<a href="/news/<?php echo $n['id'];?>/<?php echo url_title($n['titolo']);?>"><?php echo $n['titolo'];?></a>
				</td>
			</tr>
		<?php endforeach;?>
		<?php endif;?>
	</table>
</div>