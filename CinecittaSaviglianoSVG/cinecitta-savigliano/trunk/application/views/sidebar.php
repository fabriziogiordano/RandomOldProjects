<div class="sidebar">
	<div class="block panel">
		<div class="title">
			<h3>Mobile App</h3>
		</div>
		<div class="body">
			<p>
				Cinecittà Savigliano iPhone App<br>
				<a href="http://itunes.apple.com/app/id891428478"><img src="/assets/web/images/iphoneappstore.png" alt="Cinecittà Savigliano iPhone App"></a>
			</p>
			<p>
				Cinecittà Savigliano Android App<br>
				<a href="https://play.google.com/store/apps/details?id=com.fabriziogiordano.cinecittasavigliano"><img src="/assets/web/images/androidplaystore.png" alt="Cinecittà Savigliano Android App"></a>
			</p>
		</div>
	</div>

	<div id="fbpageslike" class="block panel">
		<div class="title">
			<h3>Newsletter e Facebook Fan Page</h3>
		</div>
		<div class="body">
			<p>
				<fb:like href="http://www.facebook.com/cinecittasavigliano" layout="standard" show_faces="true" width="250px" action="like" colorscheme="light"></fb:like>
			</p>
			<br style="clear:both;" />
			<p>
				Desideri essere <a name="newsletter">aggiornato</a> settimanalmente dei film in programmazione?
				<form action="/newsletter/submit" method="post" class="newsletter" onsubmit="form_newsletter(); return false;">
					<input type="text" value="Inserisci la tua email" id="newsletteremail" name="newsletteremail">
					<input type="text" value="Inserisci il tuo nome" id="newsletternome" name="newsletternome" style="display:none;">
					<input type="submit" id="newsletterinvia" name="invia" value="Invia">
					<p id="newsletter_error"></p>
				</form>
			</p>
		</div>
	</div>

	<?php if(!empty($news) && is_array($news)):?>
	<div class="block panel">
		<div class="title">
			<h3>News</h3>
		</div>
		<div class="body">
			<p class="news"><a href="/news/<?php echo $news['id']; ?>/<?php echo url_title($news['titolo']); ?>"><?php echo $news['titolo']; ?></a></p>
		</div>
	</div>
	<?php endif;?>

	<?php if(!empty($anteprime) && is_array($anteprime) && count($anteprime)>0):?>
	<div class="block panel">
		<div class="title">
			<h3>In evidenza</h3>
		</div>
		<div class="body">
			<ul id="anteprime" class="jcarousel jcarousel-skin-tango">
			<?php foreach($anteprime as $anteprima):
			$ancor_film = '/film/'.$anteprima['id'].'/'.url_title($anteprima['titolo']);
			?>
				<li>
					<a href="<?php echo $ancor_film;?>">
						<h4><?php echo $anteprima['titolo'];?></h4>
						<img src="/locandine/<?php echo $anteprima['locandina'];?>"/>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<?php endif;?>

	<div class="block panel">
		<div class="title">
			<h3>Pubblicità</h3>
		</div>
		<div class="body" id="pareri">
<script type="text/javascript"><!--
google_ad_client = "pub-2824096340105392";
/* 234x60, creato 29/10/10 */
google_ad_slot = "4398826536";
google_ad_width = 234;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
		</div>
	</div>

</div>