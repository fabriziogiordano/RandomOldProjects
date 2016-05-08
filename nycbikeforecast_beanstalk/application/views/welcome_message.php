
<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />
  <title>NYC Bike Forecast - citibikenyc map</title>
  <link rel="stylesheet" href="/assets/css/normalize.css">
  <link rel="stylesheet" href="/assets/css/foundation.css">
  <script src="/assets/js/vendor/custom.modernizr.js"></script>
</head>
<body>

  <style>
  	.head {
  		height:300px;
  		overflow: hidden;

  	}
  	.head h1 {
  		position: relative;
			z-index: 200;
			text-align: center;
			color: white;
			text-shadow: 2px 2px 2px black;
  	}
		.head img{
			position: absolute;
			top: -100px;
		}
  </style>

  <div class="row head">
    <div class="large-12 columns">
    	<h1>NYC Bike Forecast</h1>
      <img src="/assets/img/bg-nyc.jpg">
      <hr>
    </div>
  </div>
<?php
$w = 640;
$h = 720;
$nw = 500;
$nh = ceil(720/640*500);
?>
  <div class="row">
  	<div class="large-12 columns"><h2>Monday 17th to Sunday 23th</h2></div>
    <div class="large-7 columns">
      <iframe width="<?=$nw?>" height="<?=$nh?>" src="https://www.youtube.com/embed/MEfmWCbQaOE" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="large-5 columns">
      <h4>Forecasts</h4>
      <p>This week we assist to a higher concentration during 9 to 11am of bikes in the Financial District.</p>
      <p>Union Square is the most busy area and it is not simple to find available docks in the afternoon.</p>
      <p>New locations has been announced and added by CitiBike to cover areas around Centra Park.</p>
    </div>
  </div>

  <div class="row">
  	<div class="large-12 columns"><h2>Monday 10th to Sunday 16th</h2></div>
    <div class="large-7 columns">
      <iframe width="<?=$nw?>" height="<?=$nh?>" src="https://www.youtube.com/embed/42DOuChcs4U" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="large-5 columns">
    	<h4>Forecasts</h4>
    	<p></p>
    	<p></p>
    	<p></p>
    </div>
  </div>

  <footer class="row">
    <div class="large-12 columns">
      <hr />
      <div class="row">
        <div class="large-6 columns">
          <p>&copy; Copyright no one at all. Go to town.</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<?php /*
  <script>
  document.write('<script src=/assets/js/vendor/' +
  ('__proto__' in {} ? 'zepto' : 'jquery') +
  '.js><\/script>')
  </script>
  <?php *<script src="js/foundation.min.js"></script>*?>
	<script src="/assets/js/foundation/foundation.js"></script>
	<script src="/assets/js/foundation/foundation.alerts.js"></script>
	<script src="/assets/js/foundation/foundation.clearing.js"></script>
	<script src="/assets/js/foundation/foundation.cookie.js"></script>
	<script src="/assets/js/foundation/foundation.dropdown.js"></script>
	<script src="/assets/js/foundation/foundation.forms.js"></script>
	<script src="/assets/js/foundation/foundation.joyride.js"></script>
	<script src="/assets/js/foundation/foundation.magellan.js"></script>
	<script src="/assets/js/foundation/foundation.orbit.js"></script>
	<script src="/assets/js/foundation/foundation.reveal.js"></script>
	<script src="/assets/js/foundation/foundation.section.js"></script>
	<script src="/assets/js/foundation/foundation.tooltips.js"></script>
	<script src="/assets/js/foundation/foundation.topbar.js"></script>
	<script src="/assets/js/foundation/foundation.interchange.js"></script>
	<script src="/assets/js/foundation/foundation.placeholder.js"></script>
  <script>
    $(document).foundation();
  </script>
*/?>
</body>
</html>