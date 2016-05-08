var page = require('webpage').create(),
  system = require('system'),
  address, output, first,
  _ = require('lodash');

address = 'http://citibykeforecast.loc/gmap';
output = './mon17-mon24/';

page.viewportSize = { width: 640, height: 720 };

page.open(address, function (status) {
  if (status !== 'success') {
    console.log('Unable to load the address!');
    phantom.exit();
  } else {
    window.setTimeout(function () {
      getNext();
    }, 10000);
  }
});

page.onCallback = function(data) {
    if( typeof data['parseTime'] !== 'string') {
      console.log('parseTime == string');
      phantom.exit();
      return;
    }
    console.log(data['parseTime'], data['stop']);
    if(data['stop'] !== true) {
      page.render(output+data['timestamp']+'.png');
      getNext();
    }
    else {
      phantom.exit();
    }
};

page.onConsoleMessage = function (msg) {
  console.log(msg);

};

function getNext() {
  _.delay(function () {
    page.evaluate(function(){
      console.log(new Date());
      Citibykeforecast.next();
    });
  }, 1000);
  //window.setTimeout(function () { getNext(); }, 250);
}


//ffmpeg -f image2 -r 10 -pattern_type glob -i '*.png' -c:v libx264 /Users/fabriziogiordano/Dropbox/Apps/Vimeo/mon10-mon17.mp4