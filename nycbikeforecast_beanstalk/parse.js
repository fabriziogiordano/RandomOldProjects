var fs=require('fs');

var dir='/Users/fabriziogiordano/Dropbox/Debian/CityBike/';
var data={};

fs.readdir(dir,function(err,files){
  if (err) throw err;
  var c = 0, d = 0;

  files
  .filter(function(file) {
    return file.substr(-4) === 'json';
  })
  .some(function(file){
    c++;
    d++;
    console.log(d);
    if(d === 2) return false;

    fs.readFile(dir+file,'utf-8',function(err,html){
      if (err) throw err;
      console.log(dir+file);
      if (0===--c) {
        data = JSON.parse(html);
        console.log(data);
      }
    });

    return true;
  });
});