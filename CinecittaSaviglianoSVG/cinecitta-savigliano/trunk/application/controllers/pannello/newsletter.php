<?php
class Newsletter extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->session->userdata('logged'))
		{
			redirect('/pannello/login/', 'refresh');
		}
		/*Estrae programmazioni*/
		$this->template['sidebar'] = $this->Programmazioni->get_all();

		$this->load->model('Newsletters', 'Newsletter');
	}

	function index()
	{
		$this->template['newsletter'] = $this->Newsletter->get_all();

		$this->template['content_view'] = 'pannello/newsletter';
		$this->load->view('pannello/template',$this->template);
	}

	function crea($id='')
	{
		if(!empty($id))
		{
			/*Estrae programmazione*/
			$this->template['programmazione'] = $this->Programmazioni->get($id);
			$anteprime = $this->Films->anteprime();
			if(is_array($anteprime)) $this->template['anteprime'] =& $anteprime;

			/*Estrae dettagli*/
			$this->template['films'] = ($this->template['programmazione']) ? $this->Programmazioni->get_details($this->template['programmazione']['id']) : FALSE;

			/*Controlla che non sia già stata inviata*/
			$this->template['alreadysent'] = $this->Newsletter->check_sent($this->template['programmazione']['id']);

			$this->template['oggetto'] = 'Programmazione Cinecittà Savigliano '.titoloprogrammazione::titolo(
																			$this->template['programmazione']['inizio']['giorno'],
																			$this->template['programmazione']['inizio']['mese'],
																			$this->template['programmazione']['fine']['giorno'],
																			$this->template['programmazione']['fine']['mese'],
																			false
																			);
			$this->template['body'] = $this->_body();
			$this->template['id_programmazione'] = $this->template['programmazione']['id'];

		}
		else
		{
			$this->template['programmazione'] = FALSE;
			$this->template['alreadysent'] = FALSE;
			$this->template['oggetto'] = '';
			$this->template['body'] = '';
			$this->template['id_programmazione'] = '';
		}

		$this->template['content_view'] = 'pannello/newsletter_crea';
		$this->load->view('pannello/template',$this->template);
	}

	function anteprima()
	{

		$this->template['tot_email'] = $this->Newsletter->count_to();

		$this->template['id_programmazione'] = $this->input->post('id_programmazione');
		$this->template['oggetto'] = $this->input->post('oggetto');
		$this->template['body'] = $this->input->post('body');

		$this->template['content_view'] = 'pannello/newsletter_anteprima';
		$this->load->view('pannello/template',$this->template);
	}

	function generaemail()
	{
		$this->template['id_programmazione'] = $this->input->post('id_programmazione');
		$this->template['oggetto'] = base64_decode($this->input->post('oggetto'));
		$this->template['body'] = base64_decode($this->input->post('body'));

		$this->newsletter['id_programmazione'] = & $this->template['id_programmazione'];
		$this->newsletter['oggetto'] = & $this->template['oggetto'];
		$this->newsletter['body'] = base64_encode($this->_rawbody($this->template['body']));

		//echo $this->_rawbody($this->template['body']);
		//echo $this->newsletter['body'];

		/*Salva*/
		$this->template['email'] = $this->Newsletter->save($this->newsletter);

		$this->template['content_view'] = 'pannello/newsletter_generaemail';
		$this->load->view('pannello/template',$this->template);
	}

	function invia($id_newletter = '')
	{
		ini_set('max_execution_time', 1000);
		ini_set('memory_limit', '1000M');

		$this->load->library('email');
		$config['mailtype'] = 'html';
		$config['wordwrap'] = FALSE;
		$config['wrapchars'] = 1000;
		$config['useragent'] = 'CinecittaSavigliano';
		$this->email->initialize($config);

		if(!empty($id_newletter))
		{
			echo '<h1>Invio newsletter in corso, <span style="color:red;">non chiudere questa pagina!!!</span></h1>';
			echo '<h1><span style="color:red;">Attendere la scritta <span style="color:black;">FATTO</span></span></h1>';
			$this->Newsletter->send($id_newletter);
			echo '<h1><span style="color:red;">FATTO</span>, Chiudere questa pagina.</h1>';
		}
		else
		{
			echo 'Errore invio generale';
		}
	}

	function _body()
	{
	return $this->_content();
	}

	function _rawbody($content)
	{
	#echo $content;
		$raw = '
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Template 9 - Right Sidebar</title>
	<style type="text/css" media="screen">
		body {
			margin: 0;
			padding: 0;
			background-color: #ffffff;
		}
		td.permission p a {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 10px;
			font-weight: normal;
			color: #1F85BE;
		}

		td.header {
			background-image: url(\'http://www.cinecittasavigliano.it/assets/email/header.gif\');
			background-repeat: no-repeat;
			background-position: top center;
			background-color: #c22826;
			height: 50px;
		}

		td.header h1 {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 30px;
			font-weight: normal;
			color: #333333;
			margin-left: 50px;
			margin-bottom: 24px;
		}

		table.content {
			background-color: #f5f5f5;
		}

		td.sidebar a {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 11px;
			font-weight: normal;
			color: #1F85BE;
			text-decoration: none;
		}

		td.sidebar ul {
			margin: 0 0 0 24px;
			padding: 0;
		}

		td.sidebar ul li,
		td.sidebar ul li a {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 12px;
			font-weight: normal;
			color: #1F85BE;
		}

		td.sidebar h3 {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 16px;
			font-weight: bold;
			color: #E04C22;
			margin: 10px 0 14px 0;
			padding: 0;
		}

		td.sidebar p {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 11px;
			font-weight: normal;
			color: #505050;
			margin: 0 0 13px 0;
			padding: 0;
		}

		td.border {
			border-right: 2px solid #e0e0e0;
		}

		td.mainbar a {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 12px;
			font-weight: normal;
			color: #1F85BE;
			text-decoration: none;
		}

		td.mainbar h2 {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 16px;
			font-weight: bold;
			color: #E04C22;
			margin: 0 0 4px 0;
			padding: 0 0 4px 0;
			border-bottom: 1px solid #cbcbcb;
		}

		td.mainbar p {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 12px;
			font-weight: normal;
			color: #333333;
			margin: 0 0 16px 0;
			padding: 0;
			overflow:hidden;
		}

		td.mainbar p.top {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 10px;
			font-weight: bold;
			color: #a72323;
			margin: 0 0 30px 0;
			padding: 0;
		}

		td.mainbar p.top a {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 10px;
			font-weight: bold;
			color: #1F85BE;
		}

		td.mainbar ul {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 12px;
			font-weight: normal;
			color: #333333;
			margin: 0 0 20px 24px;
			padding: 0;
		}

		td.footer {
			padding: 20px 0 20px 0;
		}

		td.footer p {
			font-family: \'Lucida Grande\', sans-serif;
			font-size: 10px;
			font-weight: normal;
			color: #151515;
		}

		td p.film{height:110px;}
	</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center">
			<table width="580" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="header" align="left" valign="bottom">
						<img src="http://www.cinecittasavigliano.it/assets/email/header.gif" alt="Cinecittà Savigliano" width="580" height="50" />
					</td>
				</tr>
				<tr>
					<td>
					<!-- -->
						'.$content.'
					<!-- -->
					</td>
				</tr>
			</table>
			<table width="646" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><img src="http://www.cinecittasavigliano.it/assets/email/footer-tail.jpg" alt="Footer" width="646" height="87" /></td>
				</tr>
				<tr>
					<td align="center" class="footer">
						<p style="font-size:10px;">Se non desideri essere aggiornato sulle programmazioni di Cinecittà <a href="http://www.cinecittasavigliano.it/newsletter/optout/[EMAIL]/[ID]">clicca qui</a></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>
		';
	return $raw;
	}

	function _content()
	{
		$titolo = 'Ecco la programmazione di Cinecittà Savigliano <br/> <strong>'.titoloprogrammazione::titolo(
																		$this->template['programmazione']['inizio']['giorno'],
																		$this->template['programmazione']['inizio']['mese'],
																		$this->template['programmazione']['fine']['giorno'],
																		$this->template['programmazione']['fine']['mese'],
																		false
																		).'</strong>';
		$programmazione = '';
		foreach($this->template['films'] as $film){
			$programmazione .= '
<h2 style="color:#E04C22; font-size:12px; margin: 5px 0 0 0; padding:0;">'.$film['titolo'].'</h2>
<p class="film" style="height:110px; margin-top:2px;"><img src="http://www.cinecittasavigliano.it/locandine/'.$film['locandina'].'" alt="'.url_title($film['titolo']).'" width="75" height="100" align="left" style="margin-right:10px;"/>
	Feriali: '.$film['orario']['feriale'].' <br/>
	Festivi: '.$film['orario']['festivo'].' <br/>
	Note: '.$film['orario']['note'].' <br/>
	<a href="http://www.cinecittasavigliano.it/film/'.$film['id_film'].'/'.url_title($film['titolo']).'#trailer">Guarda il trailer</a>
</p>
			';
		}

		if(isset($this->template['anteprime']) && is_array($this->template['anteprime']) && count($this->template['anteprime'])>0)
		{
			$anteprime = '<h3 style="color:#E04C22; font-size:12px; margin: 5px 0 0 0; padding:0;">Prossimamente</h3> <ul>';
			foreach($this->template['anteprime'] as $anteprime){
				$anteprime.= '<li><a href="http://www.cinecittasavigliano.it/film/'.$anteprime['id_film'].'/'.url_title($anteprime['titolo']).'">'.$anteprime['titolo'].'</a></li>';
			}
			$anteprime = '</ul>';
		}

		$content = '
<table width="580" height="130" border="0" cellspacing="16" cellpadding="0" class="content" bgcolor="#f5f5f5">
	<tr>
		<td class="mainbar" align="left" valign="top" width="354">
			<p>Ciao <b>[UTENTE]</b></p>
			<p>'.$titolo.'</p>

			'.$programmazione.'

			<p>&nbsp;</p>

			<p>Buona giornata!,<br/> <i><b>La direzione di Cinecittà Savigliano</b></i><br/><a href="http://www.cinecittasavigliano.it">http://www.cinecittasavigliano.it</a></p>
		</td>
		<td class="border" width="2">&nbsp;</td>
		<td class="sidebar" align="left" valign="top" width="192">
			<h3 style="color:#E04C22; font-size:12px; margin: 5px 0 0 0; padding:0;">Community</h3>
			<p>Vuoi essere sempre aggiornato sui film in uscita, commentare e condividere i trailer dei film o scoprire le <a href="http://www.cinecittasavigliano.it/compleanno">promozioni</a> di Cinecittà?<br/>
				Seguici su:</p>
				<img src="http://www.cinecittasavigliano.it/assets/email/fb.gif" alt="Cinecitta Facebook Fan Page" width="14" height="14" style="margin-right:3px;"/> <a href="http://www.facebook.com/cinecittasavigliano">Facebook</a><br/>
				<img src="http://www.cinecittasavigliano.it/assets/email/tw.jpg" alt="Cinecitta su Twitter" width="14" height="14" style="margin-right:3px;"/> <a href="http://twitter.com/cinecittasav">Twitter</a><br/>

			<img src="http://www.cinecittasavigliano.it/assets/email/hr-small.gif" alt="-" width="192" height="28" />

			'.$anteprime.'

			<h3 style="color:#E04C22; font-size:12px; margin: 5px 0 0 0; padding:0;">iPhone</h3>
			<p>
				<a href="http://itunes.apple.com/app/id891428478"><img src="http://www.cinecittasavigliano.it/assets/web/images/iphoneappstore.png" alt="Cinecittà Savigliano iPhone App"></a>
			</p>
			
			<h3 style="color:#E04C22; font-size:12px; margin: 5px 0 0 0; padding:0;">Android</h3>
			<p>
				<a href="https://play.google.com/store/apps/details?id=com.fabriziogiordano.cinecittasavigliano"><img src="http://www.cinecittasavigliano.it/assets/web/images/androidplaystore.png" alt="Cinecittà Savigliano Android App"></a>
			</p>

			<br/><br/>

			<h3 style="color:#E04C22; font-size:12px; margin: 5px 0 0 0; padding:0;">iPhone</h3>
			<p>
				<img src="http://www.cinecittasavigliano.it/assets/web/images/iphone.gif" alt="Cinecitta su iPhone" width="40" height="50" align="left" style="margin-right:10px;"/>
				Cinecittà Savigliano è anche sul tuo iPhone. Accedi da mobile a <a href="http://www.cinecittasavigliano.it/iphone/web">http://www.cinecittasavigliano.it/</a>
				<br/><br/>
				Se non hai uno smart phone collegati alla <strong>http://www.cinecittasavigliano.it/mobile</strong> ottimizzata per il tuo cellulare.
			</p>
		</td>
	</tr>
</table>
		';
	return $content;
	}
}