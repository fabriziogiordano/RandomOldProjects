<!DOCTYPE html>
<!--[if IEMobile 7 ]>  <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php echo lang('head_title');?></title>
  <meta name="description" content="">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="cleartype" content="on">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/img/touch/apple-touch-icon-144x144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/img/touch/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/img/touch/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/assets/mobile/img/touch/apple-touch-icon-57x57-precomposed.png">
  <!-- <link rel="shortcut icon" href="/assets/mobile/img/touch/apple-touch-icon.png"> -->

  <meta name="apple-mobile-web-app-capable" content="no">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link href='/assets/css/style.css?v=<?= $version['css'] ?>' rel='stylesheet' type='text/css'>

</head>
<body>
<div id="portrait">
  <div id="search"><span><?php echo lang('mobile_cancel');?></span><input id="targetinput" type="text" value="" /></div>
  <div id="searchcontent">Adding more point of interest</div>
  <header><h1><span class="icon-bicycle"></span><strong>+</strong></h1></header>
  <div id="menu"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"><span class="icon-list"></span></div>
  <div id="menulist"></div>
  <div id="timer"><strong class="time"></strong><span class="icon-stopwatch"></span><span class="icon-cycle"></span></div>
  <div id="timerlist"></div>
  <div id="parseTime"><?php echo lang('mobile_loading');?></div>
  <div id="resetlocation"><span class="icon-location-2"></span></div>
  <div id="bookmarks"><span class="icon-bookmark"></span></div>
  <div id="bookmarkscontent"></div>
  <div id="mapbikes"></div>
  <div id="dock"></div>
</div>
<div id="landscape">
  <h1><span class="icon-bicycle"></span> <?php echo lang('mobile_title');?> </h1>
  <div id="timing">00 : 00</div>
</div>
<div id="fb-root"></div>

<script type="text/x-dot-template" id="menulisttmpl">
  <ul>
    {{? it.user }}
    <li>
      <span class="facebook_logout"><?php echo lang('mobile_logout');?></span>
      <span>{{=it.user.first_name}}</span>
      <!--<strong>{{=it.rides}}</strong> Rides  <strong>{{=it.miles}}</strong> Miles-->
    </li>
    <li>
      {{? it.friends }}
        {{~it.friends :value:index}}
          <span><img src='{{=value.pic_square}}'></span> <!-- {{=value.name}} -->
        {{~}}
      {{?}}
    </li>
    {{??}}
    <li>
      <button class='facebook'><span class="icon-facebook"></span> <?php echo lang('mobile_loginwithfacebook');?></button>
    </li>
    {{?}}
    <li><?php echo lang('mobile_logintemporarytext');?></li>
  </ul>
</script>

<script type="text/x-dot-template" id="docktmpl">
  <div data-dockid='{{=it.id}}' class="setbookmark"><strong></strong><span class="icon-bookmark {{? it.bookmarksAdded}}added{{?}}"></span></div>
  <div class='close'><span></span></div>
  <div class='dock'>
    <div class="dock_name">{{=it.sn}}</div>
    <span class="icon-bicycle"></span> {{=it.ab}}
    <span class="icon-unlock-stroke"></span> {{=it.ad}}
    {{? it.distance }}<span class='distance'><?php echo lang('mobile_dockdistance');?> <strong>{{=it.distance}}</strong> <?php echo lang('mobile_dockdistanceunit');?></span>{{?}}
  </div>

  <button data-dockid='{{=it.id}}' value='{{=it.timer}}' class='timing {{? it.timer}}active{{?}}'>
    <div class="countdown"><span class="icon-stopwatch"></span></div>
    <strong>{{=it.timerlabel}}</strong>

    <!--<div class="sharetwitter disabled"><span class="icon-twitter"></span></div>-->
    <div class="sharefacebook {{=it.facebook}}"><span class="icon-facebook"></span></div>
  </button>
</script>

<script type="text/x-dot-template" id="timerlisttmpl">
  {{? it.history }}
  <h2><?php echo lang('mobile_historytitle');?></span></h2>
  <ul>
  {{~it.history :value:index}}
    <li class="{{=value.class}}" data-timer-start-la="{{=value.start.la}}" data-timer-start-lo="{{=value.start.lo}}"  data-timer-stop-la="{{=value.stop.la}}" data-timer-stop-lo="{{=value.stop.lo}}">
      <span class="duration">{{=value.duration}}</span>
      <span class="icon-stopwatch"></span>
      <span class="start">{{=value.start.time}}</span>
      <span class="stop">{{=value.stop.time}}</span>
    </li>
  {{~}}
  </ul>
  {{?}}
</script>

<script type="text/x-dot-template" id="bookmarkstmpl">
<h2><?php echo lang('mobile_bookmarkstitle');?></h2>
{{? it.length }}
  <ul>
  {{~it :dock:index}}
    <li {{?index%2}}class="zebra"{{?}} data-dockid="{{=dock.id}}" data-dockla="{{=dock.la}}" data-docklo="{{=dock.lo}}">
      <span class="icon-trashcan"></span>
      <p><span class="icon-location"></span>{{=dock.sn}}</p>
      <span class='available_bikes'><span class="icon-bicycle"></span> {{=dock.ab}}</span>
      <span class='available_docks'><span class="icon-unlock-stroke"></span> {{=dock.ad}}</span>
      <span class='distance'><?php echo lang('mobile_dockdistance');?> <strong>{{=dock.distance}}</strong> <?php echo lang('mobile_dockdistanceunit');?></span>
    </li>
  {{~}}
  </ul>
{{??}}
  <p><?php echo lang('mobile_bookmarksnone');?></p>
{{?}}
</script>
<script src="/assets/js/vendor/concatenate.doT.promise.moment.min.js?v=<?= $version['js'] ?>"></script>
<script>
bikeplusoptions = {};
bikeplusoptions.lang     = {
  mobile_js_logout     : '<?php echo lang('mobile_js_logout'); ?>',
  mobile_js_ride_start : '<?php echo lang('mobile_js_ride_start'); ?>',
  mobile_js_ride_starting : '<?php echo lang('mobile_js_ride_starting'); ?>',
  mobile_js_ride_finish : '<?php echo lang('mobile_js_ride_finish'); ?>',
  mobile_dockdistanceratio : <?php echo lang('mobile_dockdistanceratio'); ?>,
  mobile_js_bookmarks_added : '<?php echo lang('mobile_js_bookmarks_added'); ?>',
  mobile_js_global_lat : <?php echo lang('mobile_js_global_lat'); ?>,
  mobile_js_global_lng : <?php echo lang('mobile_js_global_lng'); ?>,

};
bikeplusoptions.fbappid  = '<?php echo $this->config->item('facebook_appid'); ?>';
bikeplusoptions.shareurl = '<?php echo $this->config->item('bikeplus_shareurl'); ?>';
Docks            = <?php echo $json; ?>;
Docks.fetched    = Date.now();
</script>
<script src="/assets/js/app.min.js?v=<?= $version['js'] ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google_map_key'); ?>&v=3.exp&sensor=false&callback=BikePlus.mapInit&libraries=places"></script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', '<?php echo $this->config->item('google_analytics_ua'); ?>', '<?php echo $this->config->item('google_analytics_domain'); ?>');
ga('send', 'pageview');
</script>

<?php if($this->config->item('env') == 'dev') echo '<script src="http://localhost:35729/livereload.js"></script>'; ?>
</body>
</html>