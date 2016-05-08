<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="it"
xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" >
<head profile="http://gmpg.org/xfn/11">
	<title>Cinema Savigliano Cinecitt&agrave; - <?php echo $metatitle; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="it_IT" />
	<meta name="title" content="Cinema Savigliano Cinecitt&agrave; - <?php echo $metatitle; ?>" />
	<meta name="description" content="<?php if(!empty($metadescription)) echo $metadescription; else echo $metatitle; ?>" />
	<meta name="keywords" content="cinema, savigliano, <?php echo $metatitle; ?>" />
	<meta name="author and developer" content="Fabrizio Giordano - http://fabriziogiordano.com" />
	
	<meta property="fb:app_id" content="144448172238305"/>
	<meta property="og:site_name" content="Cinema Cinecitt&agrave; Savigliano"/>
	<meta property="og:email" content="giordano.fabrizio@gmail.com"/>
	
	<?php if(!empty($fb_og) && is_array($fb_og)):?>
		<meta property="og:title" content="<?php echo $fb_og['title']; ?>"/>
		<meta property="og:url" content="<?php echo $fb_og['url']; ?>"/>
		<meta property="og:image" content="<?php echo $fb_og['image']; ?>"/>
	<?php else:?>
		<meta property="og:title" content="Cinema Cinecitt&agrave Savigliano"/>
		<meta property="og:url" content="http://www.facebook.com/cinecittasavigliano"/>
		<meta property="og:image" content="http://www.cinecittasavigliano.it/assets/web/images/fb.jpg"/>
		<?php /*<meta property="og:type" content="movie"/>*/?>
	<?php endif;?>

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>	
  <script type="text/javascript" src="/assets/web/tipsy/src/javascripts/jquery.tipsy.js"></script>
  <script type="text/javascript" src="/assets/web/jcarousel/jquery.jcarousel.min.js"></script>
  <script type="text/javascript" src="/assets/web/fancybox-with-video/jquery.pngFix.pack.js"></script>
  <script type="text/javascript" src="/assets/web/fancybox-with-video/jquery.fancybox-1.0.0.js"></script>
  <script type="text/javascript" src="/assets/web/fancybox-with-video/swfobject.js"></script>
  <script type="text/javascript" src="/assets/web/js/effects.js"></script>
	
	<link rel="stylesheet" type="text/css" href="/assets/web/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/assets/web/tipsy/src/stylesheets/tipsy.css" />
	<link rel="stylesheet" type="text/css" href="/assets/web/jcarousel/jcarousel.css" />
    <link rel="stylesheet" type="text/css" href="/assets/web/fancybox-with-video/fancy.css"/>

	
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.cinecittasavigliano.it/rss/" />
</head>
<body class="home">
	<div id="header">
		<div class="wrapper">
			<h1><a href="/"><span>Cinecitt&agrave; Savigliano</span></a></h1>
			<nav>
				<ul class="nav">
					<li><a href="/prossimamente">Prossimamente</a></li> 
					<li><a href="/dovesiamo">Dove siamo</a></li>
					<li><a href="/sale">Le sale</a></li>
					<li><a href="/xpand3d">3D</a></li>
				</ul>
			</nav>
			<div class="prenota">
				<a href="http://www.crea.webtic.it/Default.aspx?sc=5242" title="Prenota online">Prenota <strong>online</strong></a>
			</div>
		</div>
	</div>
	
	<div class="content"><div class="content_int">
		<div class="wrapper">
		
			<?php $this->load->view($content_view); ?>
			
			<?php $this->load->view('sidebar'); ?>
			
		</div>
	</div></div>
	
	<div class="subfooter"><div class="content_int">
		<div class="wrapper" style="position:relative;">
			<a href="/trailers" style="position:absolute; width:230px; height:230px; background:trasparent; z-index:200; top:30px; "> </a>
			<ul>
				<li style="overflow:hidden;">
					<h4>Trailers</h4>
					<?php /* ?>
					<p>
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,47,0" name="AndiamoAlCinema" width="300" height="225" align="middle" id="AndiamoAlCinema">
							<param name="allowScriptAccess" value="sameDomain" />
							<param name="allowFullScreen" value="true" />
							<param name="movie" value="http://cinema.comingsoon.it/AndiamoAlCinema.swf?csuid=www.cinecittasavigliano.it&amp;csby=free&amp;volumeON=NO" />
							<param name="quality" value="best" />
							<param nme="bgcolor" value="#000000" />
							<embed src="http://cinema.comingsoon.it/AndiamoAlCinema.swf?csuid=www.cinecittasavigliano.it&amp;csby=free&amp;volumeON=NO" width="300" height="225" align="middle" quality="best" bgcolor="#000000" name="AndiamoAlCinema" allowScriptAccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
						</object>
					</p>
					<?php */ ?>
					<script>
					var CSWebOpt = { w: 230 };
					</script>
					<script type="text/javascript" src="http://cinema.comingsoon.it/V5/js/showCSWeb.js"></script>
					<p>
						<div id="comingsoon">
							Loading <a href="/trailers">Coming Soon Trailers</a>...
						</div>
					</p>
				</li>
				<!--
				<li>
					<h4>iPhone</h4>
					<p>
						<a href="http://www.cinecittasavigliano.it/iphone/web"><img src="/assets/web/images/iphone.gif" class="iphone"/></a>
						<strong>Nuova WebApp iPhone</strong><br/>Cinecittà Savigliano è anche sul tuo iPhone. Accedi da mobile a <a href="http://www.cinecittasavigliano.it/iphone/web">http://www.cinecittasavigliano.it/</a>
					</p>
					<p>
						<br/>Se non hai uno smart phone collegati a <a href="http://www.cinecittasavigliano.it/mobile">http://www.cinecittasavigliano.it/mobile</a> per una versione ottimizzata per il tuo cellulare.
					</p>
				</li>
				-->
				<li>
					<h4>Iniziative</h4>
					<p>
						<a href="/compleanno"><img src="/assets/web/images/torta.gif" class="torta"/></a>
						E' il tuo compleanno? Cinecittà ti <a href="/compleanno">offre l'ingresso al cinema</a>.
					</p>
					<br/>
					<p>
						<a href="http://www.twitter.com/cinecittasav"><img src="http://twitter-badges.s3.amazonaws.com/t_logo-a.png" alt="Segui Cinecittà su Twitter" class="social showtipsy" /></a>
						Seguici su Twitter <a href="http://www.twitter.com/cinecittasav">@cinecittasav</a>
					</p>
					<br/>
					<p>
						<a href="http://www.cinecittasavigliano.it/rss"><img src="/assets/web/images/rss_feed_icon.gif" alt="Segui Cinecittà via Feed Rss" class="social showtipsy" /></a>
						Seguici via <a href="/rss">Feed Rss</a>
					</p>
				</li>
				
				<li>
					<h4>Contattaci</h4>
					<p>
						<a class="contattaci" href="/contattaci">Contattaci</a> per eventuali informazioni sul cinema.
					</p>
					<p>
					    <a href="#" class="showtipsy" title="Per prenotare puoi telefonare direttante al cinema, i posti migliori ti saranno riservati. Ricorda di ritirare i biglietti almeno 30 minuti prima dell'inizio dello spettacolo.">Prenota chiamando lo <strong>0172 726324</strong></a>
					</p>
					<h5>Credits</h5>
					<p>
						<a class="credits" href="http://fabriziogiordano.com/">Fabrizio Giordano</a>
					</p>
				</li>
				
			</ul>
		</div>
	</div></div>
	
	<div class="footer">
		<div class="wrapper">
			<p>Multisala - Cinecitt&agrave; Savigliano &copy; <?php echo date('Y');?> - P.IVA 02801680048 - Tel. 0172/726324 - Email. info@cinecittasavigliano.it </p>
		</div>
	</div>
<?php if($this->config->item('server_type')): ?>
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
	FB.init({appId: '<?php echo $this->config->item('fb_appid'); ?>', status: true, cookie: true, xfbml: true});
	
	FB.Event.subscribe('edge.create', function(response) {
		/* Check if the user is also a Cinecitta fan page user */
		/* 104772962907523 */
		if(response.search(/film/) > 0)
		{
			$('#fbpageslike').css('borderColor','#ffbd03');
			$('#fbpageslike .title').css('backgroundColor','#ffbd03');
			$('#fbpageslike .title h3').css('color','#000'); /*#3B5998*/
		}
	});
};

(function() {
	var e = document.createElement('script'); e.async = true;
	e.src = document.location.protocol + '//connect.facebook.net/it_IT/all.js';
	document.getElementById('fb-root').appendChild(e);
}());
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-137286-1', 'cinecittasavigliano.it');
ga('send', 'pageview');
</script>

<script src="/assets/web/js/flare.min.js"></script>
<script>
var prenota = document.querySelector('.prenota');

prenota.addEventListener('mouseover', function () {
  flare.emit({
    category: "Prenotazione",
    action: "mouseover",
    label: "MouseOver prenotazione",
    value: 1
  });
}, false);

prenota.addEventListener('touchstart', function () {
  flare.emit({
    category: "Prenotazione",
    action: "touchstart",
    label: "TouchStart prenotazione",
    value: 1
  });
}, false);

prenota.addEventListener('click', function () {
  flare.emit({
    category: "Prenotazione",
    action: "click",
    label: "Click prenotazione",
    value: 1
  });
}, false);
</script>
<?php endif; ?>
</body>
</html>