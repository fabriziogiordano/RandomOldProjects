$(document).ready(function(){
	$('.showtipsy').tipsy();
	
	$('.locandina').hover(function(){
		$(".cover", this).stop().animate({top:'50px'},{queue:true,duration:200});
	}, function() {
		$(".cover", this).stop().animate({top:'200px'},{queue:true,duration:260});
	});
	
	$('#anteprime').jcarousel({
		vertical: true, 
		scroll: 1,
		wrap: 'circular',
		auto: 5,
		initCallback: anteprime_initCallback
	});

	$("a.trailer").fancybox({
		overlayShow: true,
		frameWidth:640,
		frameHeight:360
	});
	
	$('#newsletteremail').focus(function(){
		if($(this).val() == 'Inserisci la tua email') $(this).val('');
		$('#newsletternome').show();
		$('#newsletterinvia').show();
		return false;
	});
	$('#newsletteremail').blur(function(){ if($(this).val() == '') $(this).val('Inserisci la tua email'); return false; });
	
	$('#newsletternome').focus(function(){
			if($(this).val() == 'Inserisci il tuo nome') $(this).val('');
			return false;
		});
	$('#newsletternome').blur(function(){ if($(this).val() == '') $(this).val('Inserisci il tuo nome'); return false; });
	
	
	$('#pareritext').focus(function(){
		if($(this).val() == 'Suggerimenti e/o pareri') $(this).val('');
		$(this).animate({height:'40px'},1000).css('color','#333');
		$('#pareriemail').fadeIn(1000);
		$('#parerinome').fadeIn(2500);
		$('#pareriinvia').fadeIn(5000);
		return false;
	});
	$('#pareritext').blur(function(){
		if($(this).val() == '')
		{
			$(this).val('Suggerimenti e/o pareri');
			//$(this).css('height','18px');
			//$('#pareriemail').hide();
			//$('#parerinome').hide();
			//$('#pareriinvia').hide();
		}
		return false;
	});
	
	$('#pareriemail').focus(function(){
			$(this).css('color','#333');
			if($(this).val() == 'Inserisci la tua email (opzionale)') $(this).val('');
			return false;
	});
	$('#pareriemail').blur(function(){ if($(this).val() == '') $(this).val('Inserisci la tua email (opzionale)'); return false; });

	$('#parerinome').focus(function(){
			$(this).css('color','#333');
			if($(this).val() == 'Inserisci il tuo nome (opzionale)') $(this).val('');
			return false;
	});
	$('#parerinome').blur(function(){ if($(this).val() == '') $(this).val('Inserisci il tuo nome (opzionale)'); return false; });

	if(location.hash == '#trailer')
	{
		$("a.trailer").trigger('click');
	}
	
	//window.setTimeout("attachCominsoon()", 5000);
});

function anteprime_initCallback(carousel) {carousel.clip.hover(function() { carousel.stopAuto(); }, function() { carousel.startAuto(); }); }

function form_newsletter()
{
	var nome = $('#newsletternome').val();
	if(nome == 'Inserisci il tuo nome' || nome == '')
	{
		$('#newsletter_error').empty().html('<span class="errore">Errore: Se ci indichi il nome ti invieremo newsletter personalizzate.</span>');
		return false;
	}
	
	var email = $('#newsletteremail').val();
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(reg.test(email) == false)
	{
		$('#newsletter_error').empty().html('<span class="errore">Errore: Inserire un indirizzo di posta elettronica valido.</span>');
		return false;
	}
	
	$.ajax({
		type: "POST",
		url: "/ajax/newsletter/",
		data: "email="+email+"&nome="+nome,
		beforeSend: function(){
			$('#invia').attr('disabled','true');
			$('#newsletter_error').empty().html('<img src="/assets/pannello/images/loading.gif" style="position:relative; top:4px; width:20px; height:20px;" />');
		},
		success: function(result){
			if(result)
			{
				$('#newsletter_error').empty().html('Grazie <b>'+nome+'</b>, riceverai settimanalmente la programmazione di Cinecittà');
				return false;
			}
			$('#invia').removeAttr('disabled');
		},
		error: function() {
			$('#newsletter_error').empty().html('Connection error');
			$('#invia').removeAttr('disabled');
		}
	});
	return false;
}

function form_contattaci()
{
	var email = $('#email').val();
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(reg.test(email) == false) {
		$('#contattaci_error').empty().html('<span class="errore">Errore: Inserire un indirizzo di posta elettronica valido.</span>');
		return false;
	}
	
	nome = $('#nome').val();
	email = $('#email').val();
	newsletter = $('#newsletter:checked').val();
	privacy = $('#privacy:checked').val();
	testo = $('#testo').val();

	if(nome.length < 2) {
		$('#contattaci_error').empty().html('<span class="errore">Errore: Nome obbligatorio.</span>');
		return false;
	}
		
	if(privacy != 1) {
		$('#contattaci_error').empty().html('<span class="errore">Errore: Occorre acconsentire alla privacy per poterci contattare via modulo. Oppure chiamaci.</span>');
		return false;
	}
	
	$.ajax({
		type: "POST",
		url: "/ajax/contattaci/",
		data: 	"nome="+nome+"&"+
				"email="+email+"&"+
				"newsletter="+newsletter+"&"+
				"privacy="+privacy+"&"+
				"testo="+testo+"&"+
				"",
		beforeSend: function(){
			$('#invia').attr('disabled','true');
			$('#contattaci_error').empty().html('<img src="/assets/pannello/images/loading.gif" style="position:relative; top:4px; width:20px; height:20px;" />');
		},
		success: function(result){
			if(result)
			{
				$('#formcontattaci').empty().html('<br/><h5>La richiesta è stata correttamente inoltrata.<br/>La ringraziamo, le risponderemo nel più breve tempo possibile.</h5>');
				return false;
			}
			else
			{
				$('#contattaci_error').empty().html('<span class="errore">Errore: ' + result + '.</span>');
				return false;
			}
		},
		error: function() {
			$('#contattaci_error').empty().html('Connection error');
			$('#invia').removeAttr('disabled');
		}
	});
	return false;
}

function form_pareri(){
	
	pareritext = $('#pareritext').val();
	pareriemail = $('#pareriemail').val();
	parerinome = $('#parerinome').val();
	
	$.ajax({
		type: "POST",
		url: "/ajax/pareri/",
		data: 	"messaggio="+pareritext+"&"+
				"email="+pareriemail+"&"+
				"nome="+parerinome+"&"+
				"",
		beforeSend: function(){
			$('#pareriinvia').attr('disabled','true');
			$('#pareri_error').empty().html('<img src="/assets/pannello/images/loading.gif" style="position:relative; top:4px; width:20px; height:20px;" />');
		},
		success: function(result){
			if(result)
			{
				$('#pareri').empty().html('<h5>La richiesta è stata correttamente inviata. Grazie per aver condiviso i tuoi suggerimenti.</h5><br/>');
				return false;
			}
			else
			{
				$('#pareri_error').empty().html('<span class="errore">Errore: ' + result + '.</span>');
				return false;
			}
		},
		error: function() {
			$('#pareri_error').empty().html('Connection error');
			$('#pareriinvia').removeAttr('disabled');
		}
	});
	return false;
}

function attachCominsoon()
{
	swfobject.embedSWF(
		"http://cinema.comingsoon.it/AndiamoAlCinema.swf?csuid=www.cinecittasavigliano.it&amp;csby=free&amp;volumeON=NO",
		"comingsoon",
		"300",
		"225",
		"9.0.0"
		/*,
		"expressInstall.swf",
		{name1:"hello",name2:"world",name3:"foobar"},
		{menu:"false"},
		{id:"myDynamicContent",name:"myDynamicContent"}
		*/
		);
}