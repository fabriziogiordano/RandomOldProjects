<?php
class Ajax extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->model('Contatti');
	}
	
	function index()
	{
		redirect('/');
	}
	
	function newsletter()
	{
		$nome = $this->input->post('nome');
		$email = $this->input->post('email');
		
		if(empty($email) || empty($nome)) { echo 0; return; }
		
		$this->Contatti->salva_newsletter();
		echo 1;
		return;
	}
	
	function contattaci()
	{
		/*
		echo $this->input->post('nome');
		echo $this->input->post('email');
		echo $this->input->post('newsletter');
		echo $this->input->post('privacy');
		echo $this->input->post('testo');
		*/
		$newsletter = $this->input->post('newsletter');
		
		/*Se l'utente ha acconsentito lo registriamo per la newsletter*/
		if($newsletter == 1) { $this->newsletter(); }
		
		/*Salva modulo in DB*/
		$this->Contatti->salva_contattaci();
		
		/*Invia EMAIL a email_info */
		$this->load->library('email');
		
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		$this->email->from($this->input->post('email'), $this->input->post('nome'));
		#echo $this->config->item('email_info');
		$this->email->to($this->config->item('email_info'));
		$this->email->bcc('giordano.fabrizio+cinecitta@gmail.com, cinecittasavigliano@gmail.com');
		
		$this->email->subject('Cinema - Modulo contattaci da '. $this->input->post('nome'));
		$this->email->message($this->_message());
		
		$this->email->send();
		#echo $this->email->print_debugger();
		echo 1;
		return;
	}
	
	function pareri()
	{
		/*Invia EMAIL a email_info */
		$this->load->library('email');
		
		$this->email->from($this->input->post('email'), $this->input->post('nome'));
		#echo $this->config->item('email_info');
		$this->email->to('giordano.fabrizio@gmail.com');
		
		$this->email->subject('Cinema - Modulo parere da '. $this->input->post('nome'));
		$this->email->message($this->input->post('messaggio'));
		
		$this->email->send();
		#echo $this->email->print_debugger();
		echo 1;
		return;
	}	
	
	function _message()
	{
		$testoemailinfo = '<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
body {
	font: 11px "Trebuchet MS", "Lucinda Grande", Verdana, Arial, sans-serif;
	color: #666;
	text-align:left;
	margin:4px;
	border-top: 3px solid #FF9900;
};
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<h1>Richiesta contatti</h1>
<p>Nome: <b>'. $this->input->post('nome') .'</b></p>
<p>Email: <b><a href="mailto:'. $this->input->post('email') .'">'. $this->input->post('email') .'</a></b></p>
<p>Testo: <b>'. $this->input->post('testo') .'</b></p>
<p>Newsletter: '. $this->input->post('newsletter') .'</p>
<p>Privacy: '. $this->input->post('privacy'). '</p>
</body>
</html>';
	return $testoemailinfo;
	}
}