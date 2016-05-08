<!DOCTYPE html>
<html lang="it">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Cinecitta' Savigliano</title>
	<link rel="stylesheet" type="text/css" href="/assets/pannello/css/style/style.css" />
	<link rel="stylesheet" type="text/css" href="/assets/pannello/css/blitzer/jquery-ui-1.8.2.custom.css" />

	<script type="text/javascript" src="/assets/pannello/js/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/pannello/js/jquery-ui-1.8.2.custom.min.js"></script>
	<script type="text/javascript" src="/assets/pannello/js/jquery.ui.datepicker-it.js"></script>

	<script type="text/javascript" src="/assets/pannello/js/effects.js"></script>

	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!--[if lte IE 7]>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
	<![endif]-->
</head>
<body class="home">
	<header>
		<div class="wrapper">
			<h1><a href="/pannello">Cinecitt&agrave; Savigliano<span>Pannello di controllo</span></a></h1>
			<?php if($this->session->userdata('logged')):?>
			<nav>
				<ul class="nav">
					<li><a href="/pannello">Programmazione</a></li>
					<li><a href="/pannello/film">Films</a></li>
					<li><a href="/pannello/news">News</a></li>
					<li><a href="/pannello/newsletter">Newsletter</a></li>
					<li><a href="/pannello/socials">Facebook</a></li>
					<li><a href="/pannello/cache">Cache</a></li>
				</ul>
			</nav>
			<?php endif;?>
			<div class="user">
			<?php if($this->session->userdata('logged')):?>
				<h3>Ciao <strong><?php echo $this->session->userdata('utente'); ?></strong></h3>
				<small><a href="/pannello/login/logout">Esci</a></small>
			<?php else:?>
				<a href="/pannello/login" class="access">Entra</a>
			<?php endif;?>
			</div>
		</div>
	</header>
	<div class="content"><div class="content_int">
		<div class="wrapper">
		<div class="main browse">

			<?php $this->load->view($content_view); ?>

			<?php if($this->uri->segment(2) != 'login'): ?>
			<aside>
				<div class="block panel">
					<div class="title">
						<a href="/pannello/programmazione/crea" class="add">Crea</a>
						<h3>Programmazione</h3>
					</div>
					<div class="int">
						<ul>
							<?php foreach($sidebar as $programmazione):?>
								<li class="<?php if($programmazione['incorso']) echo 'current '; if($this->uri->segment(4) == $programmazione['id']) echo 'active'; ?>" >
									<em><a href="/pannello/programmazione/copia/<?php echo $programmazione['id'];?>">Copia</a></em>
									<em><a href="/pannello/programmazione/modifica/<?php echo $programmazione['id'];?>">Modifica</a></em>
									<a href="/pannello/programmazione/visualizza/<?php echo $programmazione['id'];?>"><?php echo $programmazione['inizio']['giorno'];?> al <?php echo $programmazione['fine']['giorno'];?></a>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
				<!--
				<section class="block info_video">
					<div class="title"><h3>Info Video</h3></div>
					<div class="int">
						<h4>Pligoo's url:</h4>
						<p> <input type="text" value="http://www.pligoo.com/playlist/54/#1" /> <small>Use it for share this video</small></p>
						<p> <a href="http://www.youtube.com/watch?v=kFfK5vl5N5g">This video on <strong>YouTube</strong></a></p>
					</div>
				</section>
				-->
			</aside>
			<?php endif; ?>

		</div> <!-- end Wrapper-->
		</div></div> <!-- and Content-->

	<footer>
		<div class="wrapper">
			Per supporto: Fabrizio Giordano - Email: <a href="mailto:giordano.fabrizio@gmail.com">giordano.fabrizio@gmail.com</a> - Cell: <strong>3316323134</strong>
		</div>
	</footer>

</body>
</html>