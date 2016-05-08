var Nycbikeforecast = (function(){

  var map,
      docks = [],
      dock = {},
      rectangle,
      increaser = 1,
      increaserstep = 1,
      current = 0,
      stop = false,
      beachMarker = {'a': [], 'b':[]},
      beachMarkerSwitcher = 'a',
      increaselabel = document.getElementById('increase'),
      mapCanvas = document.getElementById('map-canvas'),
      scaleCanvas = document.getElementById('scale'),
      hour = document.getElementById('hour');
      minute = document.getElementById('minute');

  google.maps.visualRefresh = true;

  function initialize() {
    var Lat = 40.72591351+0.001;
    var Lng = -73.983591215+0.012;

    navigator.geolocation.getCurrentPosition(function(position) {
      map.setCenter( new google.maps.LatLng(position.coords.latitude, position.coords.longitude) );
    });

    map = new google.maps.Map(mapCanvas, {
      zoom: 20,
      center: new google.maps.LatLng(Lat, Lng),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: options.disableDefaultUI
    });

    google.maps.event.addListenerOnce(map, 'idle', function(){
      generateScale();
      generateMarker();
      var bounds = map.getBounds();
      var ne = bounds.getNorthEast();
      var sw = bounds.getSouthWest();
      var nw = new google.maps.LatLng(ne.lat(), sw.lng());
      var se = new google.maps.LatLng(sw.lat(), ne.lng());
    });

    google.maps.event.addListener(map, 'zoom_changed', function() {
      rectangle.setOptions({
        bounds: map.getBounds()
      });
      generateMarker(map.getZoom());
    });

    google.maps.event.addListener(map, 'center_changed', function() {
      if(rectangle === undefined) return;
      rectangle.setOptions({
        bounds: map.getBounds()
      });
    });

    //var bikeLayer = new google.maps.BicyclingLayer();
    //bikeLayer.setMap(map);

    //create_scale();
  }

  function generateScale() {
    scaleContext = scaleCanvas.getContext("2d");
    scaleContext.clearRect(0,0,320,50);
    var b = [1 , 6 , 12, 23, 34, 39, 45];
    b.forEach(function(element, index){

      (function(e, i) {
        var image = [];
        image['i'+i] = new Image();
        image['i'+i].src = createMarker(e);
        image['i'+i].onload = function(){
          scaleContext.drawImage(image['i'+i], i*35+70, 0);
        }
      }(element, index))

    });
  }

  function getData() {
    //console.log('docks');
    //console.log(docks);
    //console.log(docks.length);
    if(docks.length < 10) {
      var request = new XMLHttpRequest();
      request.open('GET', '/api/get/'+current, false);
      request.onreadystatechange = function() {
        if(request.readyState == 4) {
          if(request.status == 200) {
            try {
              var concatenate = JSON.parse(request.responseText);
              docks = docks.concat(concatenate);
              current += 1;
              //console.log('docks');

              return getData();
            }
            catch(err) {
              //console.log(err);
              stop = true; return;
            }
            //(typeof fn === 'function') ? fn() : '';
          }
        }
      };
      request.send(null);
    }
    else {
      //console.log('docks due');
      //console.log(docks);
      delete dock;
      dock = {};
      dock = docks.shift();
      //console.log('dock me');
      //console.log(dock);
      return dock;
    }
    return;
  }

  function generateMarker(zoom) {
    if(zoom === undefined) {
      dock = getData();
    }
    //console.log('dock:', dock);
    //console.log('tot dock:', docks.length);
    if(typeof dock === "undefined" || docks.length < 10) {
      _.delay(getData, 50);
      //console.log('delay');
          //cons = {
          //  'stop': true
          //}
          //console.log(JSON.stringify(cons));
      generateMarker();
      return;
    }

    increaselabel.innerHTML = dock.parseTime;
    var date = new Date(dock.timestamp*1000+14400000);

    hours = date.getHours();

    hour.style.webkitTransform = "rotate("+Math.floor((hours/12*360)+90)+"deg)";
    minute.style.webkitTransform = "rotate("+Math.floor(date.getMinutes()/60*360)+"deg)";

    var fillOpacity = fillColor = '';

         if (hours == 0  ) { fillOpacity = 0.350; fillColor = '#084C8D'}
    else if (hours == 1  ) { fillOpacity = 0.350; fillColor = '#084C8D'}
    else if (hours == 2  ) { fillOpacity = 0.350; fillColor = '#084C8D'}
    else if (hours == 3  ) { fillOpacity = 0.300; fillColor = '#084C8D'}
    else if (hours == 4  ) { fillOpacity = 0.250; fillColor = '#084C8D'}
    else if (hours == 5  ) { fillOpacity = 0.200; fillColor = '#084C8D'}
    else if (hours == 6  ) { fillOpacity = 0.150; fillColor = '#084C8D'}
    else if (hours == 7  ) { fillOpacity = 0.100; fillColor = '#084C8D'}
    else if (hours == 8  ) { fillOpacity = 0.050; fillColor = '#084C8D'}
    else if (hours == 9  ) { fillOpacity = 0.000; fillColor = '#084C8D'}
    else if (hours == 10 ) { fillOpacity = 0.075; fillColor = '#FFFFCF'}
    else if (hours == 11 ) { fillOpacity = 0.150; fillColor = '#FFFFCF'}
    else if (hours == 12 ) { fillOpacity = 0.300; fillColor = '#FFFFCF'}
    else if (hours == 13 ) { fillOpacity = 0.150; fillColor = '#FFFFCF'}
    else if (hours == 14 ) { fillOpacity = 0.075; fillColor = '#FFFFCF'}
    else if (hours == 15 ) { fillOpacity = 0.050; fillColor = '#FFFFCF'}
    else if (hours == 16 ) { fillOpacity = 0.025; fillColor = '#FFFFCF'}
    else if (hours == 18 ) { fillOpacity = 0.000; fillColor = '#FFFFCF'}
    else if (hours == 19 ) { fillOpacity = 0.100; fillColor = '#084C8D'}
    else if (hours == 20 ) { fillOpacity = 0.150; fillColor = '#084C8D'}
    else if (hours == 21 ) { fillOpacity = 0.200; fillColor = '#084C8D'}
    else if (hours == 22 ) { fillOpacity = 0.250; fillColor = '#084C8D'}
    else if (hours == 23 ) { fillOpacity = 0.300; fillColor = '#084C8D'}

    if(rectangle) {
      rectangle.setOptions({
        fillColor: fillColor,
        fillOpacity: fillOpacity
      });
    }
    else {
      rectangle = new google.maps.Rectangle({
        bounds: map.getBounds(),
        map: map,
        fillColor: fillColor,
        fillOpacity: fillOpacity
      });
    }

    //var heatmapData = [];
    var zoom = map.getZoom();
    for(var i=0,ln=dock.stations.length; i < ln; i++) {
      var latLng = new google.maps.LatLng(dock.stations[i].latitude, dock.stations[i].longitude);
      beachMarker[beachMarkerSwitcher][i] = new google.maps.Marker({
        position: latLng,
        map: map,
        icon: createMarker(dock.stations[i].availableBikes, zoom)
      });

      //heatmapData.push({
      //  location: latLng,
      //   //weight: Math.pow(2, docks.stations[i].availableBikes/50)
      //});
    }


    beachMarkerSwitcher = (beachMarkerSwitcher === 'a') ? 'b':'a';
    beachMarker[beachMarkerSwitcher].forEach(function(m){
      m.setMap(null);
    });
    beachMarker[beachMarkerSwitcher] = [];

    //var heatmap = new google.maps.visualization.HeatmapLayer({
    //  data: heatmapData,
    //  dissipating: false,
    //  map: map
    //});

    if (typeof window.callPhantom === 'function') {
      window.callPhantom({
        'parseTime': dock.parseTime,
        'timestamp': dock.timestamp,
        'stop': stop
      });
    }

    //For PhantomJs
    cons = {
      'parseTime': dock.parseTime,
      'timestamp': dock.timestamp,
      'stop': stop
    }
    console.log(JSON.stringify(cons));
  }

  var createMarker = _.memoize(function(availableBikes, zoom) {
    var width = height = 0,
        radius = 1,
        canvas = document.createElement("canvas"),
        context = canvas.getContext("2d");

         if (availableBikes < 1 ) radius = 10;
    else if (availableBikes < 6 ) radius = 12;
    else if (availableBikes < 12) radius = 15;
    else if (availableBikes < 23) radius = 20;
    else if (availableBikes < 34) radius = 25;
    else if (availableBikes < 39) radius = 27;
    else if (availableBikes < 45) radius = 30;
    else                          radius = 30;


    width = height = radius = (radius * Math.pow(zoom/13, 8));
    fontsize = (8 * Math.pow(zoom/13, 5));

    radius /= 2;

    //console.log(availableBikes + ' - ' + radius);

    canvas.width = width;
    canvas.height = height;
    context.clearRect(0,0,width,height);

    var centerX = canvas.width / 2;
    var centerY = canvas.height / 2;

    var c = colors(availableBikes);
    context.beginPath();
    context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
    context.fillStyle = c;
    context.shadowColor = c.replace("0.75", "1", "gi");
    context.shadowBlur = 20;
    context.shadowOffsetX = 0;
    context.shadowOffsetY = 0;
    context.fill();
    context.lineWidth=1;
    context.fillStyle="rgba(0,0,0,0.5)";
    context.font= fontsize+"px sans-serif";
    context.fillText(availableBikes, centerX-3, centerY+3);

    return canvas.toDataURL();
  }, function(availableBikes, zoom){
    return availableBikes + '' + zoom;
  });


  function colors(availableBikes) {
    if(availableBikes > 40) return F(0);
    if(availableBikes > 35) return F(1);
    if(availableBikes > 30) return F(2);
    if(availableBikes > 25) return F(3);
    if(availableBikes > 20) return F(8);
    if(availableBikes > 15) return F(12);
    if(availableBikes > 13) return F(18);
    if(availableBikes > 10) return F(22);
    if(availableBikes > 8)  return F(25);
    if(availableBikes > 5 ) return F(32);
    if(availableBikes > 2 ) return F(40);
    return F(60);
  }

  // http://stackoverflow.com/questions/16399677/javascript-temperature-color
  var F = function(t) {

      var a = (t + 30)/60;
      a = (a < 0) ? 0 : ((a > 1) ? 1 : a);

      // Scrunch the green/cyan range in the middle
      var sign = (a < .5) ? -1 : 1;
      a = sign * Math.pow(2 * Math.abs(a - .5), .35)/2 + .5;

      // Linear interpolation between the cold and hot
      var h0 = 259;
      var h1 = 12;
      var h = (h0) * (1 - a) + (h1) * (a);

     //
      var rgba = pusher.color("hsv", h, 75, 90).rgb();
      return 'rgba(' + [rgba[0], rgba[1], rgba[2], '0.75'] + ')';
  };

  //function create_scale() {
  //  var canvas = document.getElementById('scale');
  //  var w = canvas.width;
  //  var h = canvas.height;
  //  var ctx = canvas.getContext('2d');
  //
  //  for (var x = 0; x < w; ++x) {
  //      var temp = -30 + (60 * x/(w-1));
  //      ctx.fillStyle = F(temp);
  //      ctx.fillRect(x, 0, 1, h);
  //  }
  //}

  function movetime() {
    next();
    if(!stop) setTimeout(function(){ movetime(); }, 250)
  }

  function next() {
    generateMarker();
  }

  google.maps.event.addDomListener(window, 'load', initialize);
  //increaselabel.addEventListener('click', movetime.bind(this));

  return {
    next: next,
    map: map
    //movetime: movetime
  }
})();

//document.addEventListener("DOMContentLoaded", Nycbikeforecast, false );