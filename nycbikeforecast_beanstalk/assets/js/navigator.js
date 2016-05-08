var map,
    currentPositionMarker,
    markers = [],
    markersdata = [],
    dockshtml = '',
    dragstart,
    $mapbikes = document.getElementById('mapbikes'),
    $resetposition = document.getElementById('resetposition'),
    $menu = document.getElementById('menu'),
    $share = document.getElementById('share'),
    compiled = _.template("<div class='close'>Close</div><div class='station_name'>Name: <%= sn %></div><div class='available_bikes'>Bikes: <%= ab %></div><div class='available_docks'>Docks: <%= ad %></div>");

var PIXEL_RATIO = (function () {
    var ctx = document.createElement("canvas").getContext("2d"),
        dpr = window.devicePixelRatio || 1,
        bsr = ctx.webkitBackingStorePixelRatio ||
              ctx.mozBackingStorePixelRatio ||
              ctx.msBackingStorePixelRatio ||
              ctx.oBackingStorePixelRatio ||
              ctx.backingStorePixelRatio || 1;
    return dpr / bsr;
})();

var marker_width = 60,
    marker_height = 40,
    marker_fontsize = 8;

var imgbg = new Image();
    imgbg.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAAoCAYAAACiu5n/AAAExklEQVR42u2ZbWiVZRjH99LOObHpjiwMdTJtE61V21JCJTJkiS9sk6QvRlb4mq5s5FsUS6cr0KlzvqBNRCVQ1A9K9SFdUBmGktP6UnnGLDewNmPmazE8v/4353IeDmwF5xzoHHfBjz3PdV/Xvef33M/97HCWAtxX9Dqg8CcyvXop0oRXZIthokAUiuIEp9Bchpmb11xTMlxi7969U7q6us6TXBGUU/OePXueN+kMJ+wTw0w2KcNJy3GouaZkiQKSO4JyzDfXlIGikD6iOwhdt+F2N5xug9YrcCcY60sKQmcnHDsGBw/C5cvEMuT4mHO9++Yqpo9Y1QRpq+CFRnhkHeS/BVevE9s4c8ZdCeTmQl4eeL0uF7PbmZGRUeJc+xT+th0+OAGDV0Dm4jukzBcL4c0D8On3cP0G0UdLC5w+DXPnhiQPH4YjRyA9HWbOhOZmt/LxFz5+UQPvSHa5VnVlkIGL/2Lkym6ebYCaJijfCnM3EH3MmgU5OeD3w/DhsGsXrF4NI0fCpEkweTJs3Rpf4Y2noLQRDjdrJX9QwRtBnloPv3ZK8ihcvAoAnlfhXAvRRXU1VFXByZNwVJNv2waHDoVWvqMDampg06b4CS84oMRSyHkbTl6Ahq/gmR3QfhM+Pq+xGvi8FQDK9sGHnxBd7N4NjY0AcOoUlJTAjBlw9qzd/Y2wYUM8hG01F4l5UPBuaJ/6l0NtE4BEL8B+5TokDzB+BxzVeVRRVwdr1947Tk11+ze00hBa4fXr4yO85Qt4qRF+/g0uXoHNJ2BsLZRuhwNnITya3B6fA53XiC7q66GhAQBu3YLt22HnTujuBgidb94cH+HL12DwOni6Dor0c8ZH8McN2PcdZL4Pk3S+8DMo2QnZS+Gbn4g+amuhrMytaGiFt2xxN8A9xqFcRYU9AXHawx0SPNcO59vg+t9WLTpvwvEfYcfX8GUAfv+T2EQgEBLSKurRDe1ZoeNQTmOqiYPw/zv6haMWbm1tJZnpX+F+4X7h5BIuug+Ei8OFC5Nd2OPxPB4uXJDswl6vd1SPcBJ8axnsA5ybhHN7hJP2e2mTdW7p6enZPcK9/OehSBRHMDbivMhqrUfcq5tYWVm5qK2tLcB/DFfrelxvz++yed0j6fahe/mIkjDGhZ8bxa7W9YhcJ+scw4XTRIbwiSwxUPgjGCRyIvNWaz3iXt1QMXrZsmWvtbe3X+BfwtW4WtdjvTk2l83by3VZXR/X5TO3NEw4VkTevEzxsHhiyZIlr1+6dKmFXsKNuRpXaz2Z4RcZK+Il/IDw2V3PFU+KKbNnz35PH+J/ISJczo25GqvNtV6fmysRhD1igBgiHrX9OFPMLy8vrw8EAm1YuGOXc2NWM9F6htgcnkQQ9toKjRDjxHTxiqgSa0SdaDDqLFdlNdOtZ4TN4U0EYZ/IEfligqgQC8QKsdYk6406y62wmgrrybc5fIm4wtPEy6JSrBTVYo1RbblKq5kWucKJtofHiPFiqnhRzBHzxEJjnsvZ2FSrHRO+hxPpLe23Cx8liu1RfU6UiilGqeUmWM0o6/En0ls6LUx6gHhIDBV5okCMFmOM0ZbLsxrVqsdkE+XvcGqYtEc8KLJE9t1PYREMsrEsq/XclRWpsb6+fwDXYAXy30AG7wAAAABJRU5ErkJggg==';

$resetposition.addEventListener('touchstart', function(){
  MAP.restoreLocation(dragstart);
});

setTimeout(function () {
  window.scrollTo(0, 1);
  $menu.style.top = window.innerHeight - 50 + 'px';
}, 1000);

function initialize() {
  var Lat = 40.760424;
  var Lng = -73.9887083;
  google.maps.visualRefresh = true;

  var center = new google.maps.LatLng(Lat, Lng);
  map = new google.maps.Map($mapbikes, {
    zoom: 15,
    center: center,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true
  });

  currentPositionMarker = new google.maps.Marker({
    position: center,
    map: map,
    icon: "http://i.stack.imgur.com/orZ4x.png",
    zIndex: 2
  });

  MAP.getLocationUpdate();

  $mapbikes.style.height = window.screen.height+"px";
  google.maps.event.trigger(map, 'resize');

//  google.maps.event.addListenerOnce(map, 'idle', function(){
//    //var bounds = map.getBounds();
//    //console.log(bounds);
//    //var ne = bounds.getNorthEast();
//    //var sw = bounds.getSouthWest();
//    //var nw = new google.maps.LatLng(ne.lat(), sw.lng());
//    //var se = new google.maps.LatLng(sw.lat(), ne.lng());
//  });
//
//  google.maps.event.addListener(map, 'center_changed', function() {
//  });

  google.maps.event.addListener(map, 'dragstart', function(e) {
    $resetposition.style.display = 'block';
    $resetposition.style.top = window.innerHeight - 40 + 'px';
    window.dragstart = true;
  });

  var getDatadebounce = _.debounce(getData, 100);

  google.maps.event.addListener(map, 'bounds_changed', function() {
    getDatadebounce();
  });

}

function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize";
  document.body.appendChild(script);
}
window.onload = loadScript;


function generateMarker() {
  //var zoom = map.getZoom();
  //console.log(map.getCenter())
  //markers.forEach(function(m){
  //  m.setMap(null);
  //});

  delete markersdata;
  markersdata = [];

  for(var i=0,ln=Docks.stations.length; i < ln; i++) {
    var latLng = new google.maps.LatLng(Docks.stations[i].la, Docks.stations[i].lo);
    var bounds = map.getBounds();
    if(bounds.contains(latLng)) {
      //if(typeof markersdata[Docks.stations[i]['id']] !== void 0) continue;
      var dist = distance(Docks.stations[i].la, Docks.stations[i].lo, map.getCenter().lat(), map.getCenter().lng());
      dist = Math.round(dist*100)/100;
      markersdata.push({
        'id'     : Docks.stations[i]['id'],
        'ad'     : Docks.stations[i]['ad'],
        'ab'     : Docks.stations[i]['ab'],
        'sn'     : Docks.stations[i]['sn'],
        'la'     : Docks.stations[i]['la'],
        'lo'     : Docks.stations[i]['lo'],
        'latLng' : latLng,
        'dist'   : dist
      });
    }
  }

  markersdata.sort(function(a,b) {return (a.dist > b.dist) ? 1 : ((b.dist > a.dist) ? -1 : 0);} );

  delete dockshtml;
  dockshtml = '';
  for(var i=0,ln=markersdata.length; i < ln; i++) {
    dockshtml += markersdata[i].id + ': ' + markersdata[i].sn + ' <br> Bikes: ' + '' + markersdata[i].ab + ' Docks: ' + markersdata[i].ad + ' ' + markersdata[i].dist + ' miles <br>';
    if(markers[markersdata[i].id] === undefined) {
      //Create Marker
      id = markersdata[i].id;
      markers[id] = new google.maps.Marker({
        position: new google.maps.LatLng(markersdata[i].la, markersdata[i].lo),
        map: map,
        icon: {
          url: createMarker(markersdata[i].id, markersdata[i].sn, markersdata[i].ab, markersdata[i].ad), //'/assets/img/hipster_1x.png',
          //size: new google.maps.Size(marker_width * PIXEL_RATIO, marker_height * PIXEL_RATIO),
          size: new google.maps.Size(marker_width, marker_height),
          scaledSize: new google.maps.Size(marker_width, marker_height)
        },
        zIndex: 1,
        optimized: false
      });
      //Assign event
      google.maps.event.addListener(markers[id], 'click', (function(i){
        return function() {
          $share.style.display = 'block';
          $share.innerHTML = compiled(markersdata[i]);
          $share.removeEventListener('touchstart', shareHandler, false);
          $share.addEventListener('touchstart', shareHandler, false);
        }
      })(i));
    }
  }

  generateListDocksHTML();
}

function shareHandler(e) {
  e.preventDefault(); e.stopPropagation();
  console.log(e);
  if(e.target.className === 'close') {
    $share.removeEventListener('touchstart', shareHandler, false);
    $share.style.display = 'none';
  }
}

function distance(lat1,lon1,lat2,lon2) {
    var R = 3958.7558657440545; // km (change this constant to get miles) 6371
    var PI = Math.PI / 180;
    var dLat = (lat2-lat1) * PI;
    var dLon = (lon2-lon1) * PI;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1 * PI ) * Math.cos(lat2 * PI ) *
        Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return d;
}

var createMarker = _.memoize(function(id, sn, ab, ad) {
  var canvas = document.createElement("canvas");

  context = canvas.getContext("2d");

  var centerX = canvas.width / 2;
  var centerY = canvas.height / 2;

  context.drawImage(imgbg,0,0, canvas.width, canvas.height);

  /*ID*/
  context.fillStyle ="rgba(0,0,0,.6)";
  context.font = (32)+"px Helvetica";
  context.textAlign = "left";
  //context.fillText(sn, 5 * PIXEL_RATIO, 26 * PIXEL_RATIO, 50 * PIXEL_RATIO);
  context.fillText(sn, 20, 98, 300);

  /*Bikes*/
  context.fillStyle ="rgba(0,0,0,1)";
  context.font = (44)+"px Helvetica";
  context.textAlign = "right";
  context.fillText(ab, 150, 50);

  /*Docks*/
  context.fillStyle ="rgba(0,0,0,1)";
  context.font = (44)+"px Helvetica";
  context.textAlign = "right";
  context.fillText(ad, 270, 50);

  return canvas.toDataURL();
}, function(id, sn, ab, ad){
  return ab+''+ad;
});


function generateListDocksHTML(){
  document.getElementById('docks').innerHTML =
  //Math.random() + ' - ' + dockshtml.length + ' - ' + markersdata.length + ' <br> ' +
  dockshtml;
}

function getData() {
  if(typeof window.Docks !== 'undefined' && (Date.now() - window.Docks.fetched > 10) ) {
    generateMarker();
    return;
  }
  var request = new XMLHttpRequest();
  request.open('GET', 'http://207.237.144.200:90/api/latest', false);
  request.onreadystatechange = function() {
    if(request.readyState == 4) {
      if(request.status == 200) {
        try {
          var data = JSON.parse(request.responseText);
          //console.log(data);
          window.Docks = data;
          document.getElementById('parseTime').innerHTML = data.parseTime;
          delete data;
          window.Docks.fetched = Date.now();
          generateMarker();
        }
        catch(err) {
          //console.log(err);
        }
      }
    }
  };
  request.send(null);
  return;
}


var MAP = (function(){
  var watchID,
      geoLoc,
      latitude,
      longitude,
      accuracy,
      center;

  function showLocation(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    accuracy = position.coords.accuracy;
    center = new google.maps.LatLng(latitude, longitude);
    currentPositionMarker.setPosition(center);
    if(!window.dragstart) {
      map.setCenter(center);
    }
  }

  function restoreLocation() {
    $resetposition.style.display = 'none';
    window.dragstart = false;
    center = new google.maps.LatLng(latitude, longitude);
    map.setCenter(center);
    currentPositionMarker.setPosition(center);
  }

  function errorHandler(err) {
    return;
    if(err.code == 1) {
      alert("Error: Access is denied!");
    }
    else if( err.code == 2) {
      alert("Error: Position is unavailable!");
    }
  }

  function getLocationUpdate(){
     if(navigator.geolocation){
        // timeout at 60000 milliseconds (60 seconds)
        var options = {
          enableHighAccuracy: true
          //maximumAge: 30000,
          //timeout: 60000
        };
        watchID = navigator.geolocation.watchPosition(showLocation,
                                       errorHandler,
                                       options);
     }
     else {
        alert("Sorry, browser does not support geolocation!");
     }
  }

  return {
    getLocationUpdate : getLocationUpdate,
    restoreLocation : restoreLocation
  }
})();