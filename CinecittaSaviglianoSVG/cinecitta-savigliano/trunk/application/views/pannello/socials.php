	<?php
	$flash = $this->session->flashdata('flash');
	if(!empty($flash)):?>
	<div class="infos">
		<p><?php echo $this->session->flashdata('flash'); ?></p>
	</div>
	<?php endif;?>

	<div class="title">
		<h2>Facebook</h2>
		<p>Inserisci uno status sulla Facebook Fan Page di Cinecittà</p>
	</div>
	<form action="/pannello/socials/submit" method="post" class="main_form">
		<fieldset class="film">
		<legend>Nuovo status</legend>
				<p>

					<script>
					$(document).ready(function(){
						$('#status').bind('keydown',function(e){ if(e.which == 13) return false; });
					});
					</script>

					<label>Testo:</label>
					<textarea class="text" style="width: 660px; height: 60px" name="status" id="status"><?php echo set_value('status', ''); ?></textarea> <label class="aside"> <?php echo form_error('status','',''); ?> </label>

					<small><strong>Prossima: </strong>
						<p style="font-size:18px" id="next"><?php echo $filmtitles['next'];?></p>
						<a href="#" onclick="$('#status').val($('#next').text()); return false;">inserisci</a></small>

					<small><strong>Attiva: </strong>
						<p style="font-size:18px" id="current"><?php echo $filmtitles['current'];?></p>
						<a href="#" onclick="$('#status').val($('#current').text()); return false;">inserisci</a></small>
				</p>

				<p>
					<input type="submit" value="Pubblica" />
				</p>

		</fieldset>
	</form>


	<div class="body">
		<h3>Ultimi aggiornamenti</h3>
		<?php if(!empty($statuses) && is_array($statuses)): ?>
			<ul class="socials_statuses">
			<?php foreach($statuses as $s):
			list(, $id) = explode('_',$s['id']);
			$s['created_time'] = $this->Facebookmd->_timeago(strtotime($s['created_time']));
			?>
				<li>
					<img src="http://profile.ak.fbcdn.net/hprofile-ak-prn1/71135_104772962907523_7397058_q.jpg" />
					<p><a href="http://www.facebook.com/cinecittasavigliano?v=wall&story_fbid=<?php echo $id;?>&ref=mf">Cinecittà Savigliano</a> <?php echo $s['message'];?></p>
					<p class="fot"><span><?php echo $s['created_time'];?></span> | Likes: <?php if(!empty($s['likes']['count'])) echo $s['likes']['count']; else echo 0; ?> | Comments: <?php if(!empty($s['comments']['count'])) echo $s['comments']['count']; else echo 0; ?>
				</li>
			<?php endforeach;?>
			</ul>
		<?php endif;?>
	</div>

</div>