$(document).ready(function(){
	$('.datepicker').datepicker({
		onClose: function(dateText, inst) {
			if($(this).attr('id') == 'inizio') $('#fine').val(dateText);
			if($(this).attr('id') == 'inizio') $('#attivazione').val(dateText);
		}
	});

	$('#film_add').click(function(){
		$('.film ul.clearfix:hidden:first').slideDown('slow');
		return false;
	});

	$('#programmazione_redazione_copia').click(function(){
		$('#programmazione_redazione_testo').focus().select();
		return false;
	});

	$('#programmazione_cancella').click(function(){
		if (confirm('Cancellare la programmazione?')) return true;
		return false;
	});

	$('.news_cancella').click(function(){
		if (confirm('Cancellare la News?')) return true;
		return false;
	});

	$('.anteprima_cambia').click(function(){
		div = $(this).prev().attr('id');
		id = $(this).prev().attr('class');

		$.ajax({
			type: "POST",
			url: "/pannello/film/anteprima/",
			data: "action=anteprima&id="+id,
			beforeSend: function(){
				$('#'+div).empty().html('<img src="/assets/pannello/images/loading.gif" style="position:relative; top:4px;" />');
			},
			success: function(result){
				$('#'+div).empty().html(result);
			},
			error: function() {
				$('#'+div).empty().html('Connection error');
			}
		});
		return false;
	});

	$('#titolo').change(function() {
		t = $(this).val();
		$('#filmup').val(t);
		$('#youtube').val(t);
	});

	$('#filmup').focus(function(){ if($(this).val() == 'Cerca su FilmUp') $(this).val(''); return false; });
	$('#filmup').blur(function(){ if($(this).val() == '') $(this).val('Cerca su FilmUp'); return false; });
	$('#filmup').keypress(function(event) {
		if (event.keyCode == '13') {
			//event.preventDefault();
			url = 'http://www.filmup.leonardo.it/cgi-bin/search.cgi?ps=10&fmt=long&q='+$('#filmup').val()+'&ul=%25%2Fsc_%25&x=60&y=8&m=all&wf=2221&wm=wrd&sy=0';
			window.open(url);
			return false;
		}
	});

	$('#youtube').focus(function(){ if($(this).val() == 'Cerca su Youtube') $(this).val(''); return false; });
	$('#youtube').blur(function(){ if($(this).val() == '') $(this).val('Cerca su Youtube'); return false; });
	$('#youtube').keypress(function(event) {
		if (event.keyCode == '13') {
			//event.preventDefault();
			url = 'http://www.youtube.com/results?search_query='+$('#youtube').val()+' trailer ita';
			window.open(url);
			return false;
		}
	});

	$('#locandinaweb').focus(function(){ $(this).val(''); return false; });
	$('#locandinaweb').blur(function(){ if($(this).val() == '') $(this).val('http://'); return false; });

});