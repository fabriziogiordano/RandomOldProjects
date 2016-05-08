<?php
$jqpath = '/assets/iphone/';
$jqtheme = 'apple';
?>
<!DOCTYPE HTML>
<html manifest="cache.manifest">
<head>
<meta charset="UTF-8" />
<title>Cinecittà Savigliano</title>
<style type="text/css" media="screen">@import "<?php echo $jqpath; ?>/jQTouch/jqtouch/jqtouch.css";</style>
<style type="text/css" media="screen">@import "<?php echo $jqpath; ?>/jQTouch/themes/<?php echo $jqtheme; ?>/theme.css";</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="<?php echo $jqpath; ?>/jQTouch/jqtouch/jqtouch.js"></script>
<script type="text/javascript" charset="utf-8">
/* <![CDATA[ */
	var jQT = new $.jQTouch({
		icon: '/assets/iphone/images/cinecitta_icon.png',
		addGlossToIcon: true,
		startupScreen: '/assets/iphone/images/cinecitta_startup.png',
		statusBar: 'black',
		useFastTouch: false,
		preloadImages: [
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/actionButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/activeButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/backButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/back_button_clicked.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/button_clicked.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/cancel.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/chevron.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/grayButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/greenButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/listArrowSel.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/listGroup.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/loading.gif',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/on_off.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/pinstripes.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/redButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/selection.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/thumb.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/toggle.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/toggleOn.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/toolButton.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/toolbar.png',
			'<?php echo $jqpath;?>/jQTouch/themes/<?php echo $jqtheme;?>/img/whiteButton.png'
		]
	});
/* ]]> */
</script>
<style type="text/css" media="screen">
	#jqt h3 {
	    font: bold 16px "Helvetica Neue", Helvetica;
	    text-shadow: rgba(255,255,255,.2) 0 1px 1px;
	    color: rgb(76, 86, 108);
	    margin: -10px 20px 20px 20px;
	}
		
	#jqt ul li h4 span {
	    font: bold 16px "Helvetica Neue", Helvetica;
	    text-shadow: rgba(255,255,255,.2) 0 1px 1px;
	    color: rgb(76, 86, 108);
	}
	
	#jqt ul {font-size:20px;}
	#jqt ul li span {font-size:14px;}
	#jqt ul li.arrow {overflow:hidden;}
	
	#jqt ul li div.locandina {float:left; width:66px;}
	#jqt ul li div.locandina img{width:60px; height:80px;}
	
	#jqt ul li div.orario {float:left; width:100px;}
	#jqt ul li div.orario h4 {color:#000;}
	#jqt ul li div.orario p strong {color:#999;}
	#jqt ul li div.orario a {color:#4C566C;}
	
	#jqt ul li h4 {text-shadow: #ccc 0px 1px 0px; font-size:17px; overflow:hidden; text-overflow:ellipsis;"}
	#jqt ul li p.note {color: #999; text-shadow: #ccc 0px 1px 0px; font-size:14px; overflow:hidden; text-overflow:ellipsis;"}
	
	#jqt ul.film {font-size:20px;}
	#jqt ul.film li span {font-size:14px;}
	#jqt ul.film li.arrow {overflow:hidden;}
	
	#jqt ul.film li div.locandina img{width:180px; height:240px;}
	#jqt ul.film li div.descrizione {font-size:16px;}
	#jqt ul.film li h4 {text-shadow: #ccc 0px 1px 0px; font-size:17px; overflow:hidden; text-overflow:ellipsis;"}
	#jqt ul.film li p.note {color: #999; text-shadow: #ccc 0px 1px 0px; font-size:14px; overflow:hidden; text-overflow:ellipsis;"}
  
	#jqt .button2{
		position: absolute;
		overflow: hidden;
		top: 8px;
		left: 6px;
		margin: 0;
		border-width: 0 5px;
		padding: 0 3px;
		width: auto;
		height: 30px;
		line-height: 30px;
		font-family: inherit;
		font-size: 12px;
		font-weight: bold;
		color: #fff;
		text-shadow: rgba(0, 0, 0, 0.5) 0px -1px 0;
		text-overflow: ellipsis;
		text-decoration: none;
		white-space: nowrap;
		background: none;
		-webkit-border-image: url(<?php echo $jqpath; ?>/jQTouch/themes/<?php echo $jqtheme; ?>/img/toolButton.png) 0 5 0 5;
	}

	#jqt .button.active2{
		-webkit-border-image: url(<?php echo $jqpath; ?>/jQTouch/themes/<?php echo $jqtheme; ?>/img/toolButton.png) 0 5 0 5;	
	}
	
	#jqt.fullscreen #home .info {
	display: none;
	}
	div#jqt #about {
		padding: 100px 10px 40px;
		text-shadow: rgba(255, 255, 255, 0.3) 0px -1px 0;
		font-size: 13px;
		text-align: center;
		/*background: #161618;*/
	}
	div#jqt #about p {
		margin-bottom: 8px;
	}
	div#jqt #about a {
		color: #000;
		font-weight: bold;
		text-decoration: none;
	}
	
	.info strong {font-size:24px; font-weight:bold;}
	
</style>

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

</head>
<body>
	<div id="jqt">
		<?php $this->load->view($content_view); ?>
	</div>
<?php if($this->config->item('server_type')): ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-137286-1', 'cinecittasavigliano.it');
  ga('send', 'pageview');

</script>
<?php endif; ?>
</body>
</html>