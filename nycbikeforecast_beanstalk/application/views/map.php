<!DOCTYPE html>
<html>
<head>
<title>NYC Bike Forecast</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
<link href='/assets/css/style.css' rel='stylesheet' type='text/css'>
<link href='/assets/css/buttons/gh-buttons.css' rel='stylesheet' type='text/css'>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=geometry,visualization"></script>
<script src="/assets/js/lodash.min.js"></script>
<script src="/assets/js/pusher.color.min.js"></script>
</head>
<body>

<?php if($controlls): ?>
  <button class="button danger big" onclick="Nycbikeforecast.next();">Next</button>
  <!-- <button style="position:relative; left:30px;" onclick="Nycbikeforecast.movetime();">Move</button> -->

  <div id="controlls">
      <!--
      <form method="get" action="/map/full">
        <?php
          $time = array(
            strtotime('10 June 2013, 8am') => '10 June 2013, 8am',
            strtotime('11 June 2013, 8am') => '11 June 2013, 8am'
          );
          echo form_dropdown('time', $time, strtotime('10 June 2013, 8am'), 'id="time"');
        ?>
      </form>
      -->
  </div>
<?php endif; ?>

  <div class="face">
    <div id="hour"></div>
    <div id="minute"></div>
  </div>

  <div id="increase">Start Animation</div>
  <div id="map-canvas"></div>

  <canvas id="scale" width="320" height="50" style="position:absolute; top:5px; right:5px; z-index: 1000;"></canvas>

<script>
  var options = {
    'disableDefaultUI': <?php echo ($controlls) ? 'false' : 'true' ; ?>
  }
</script>
<script src="/assets/js/map.js"></script>
</body>
</html>