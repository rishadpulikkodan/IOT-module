<!DOCTYPE html>
<html>
<head>
	<title>IOT-Devices</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style type="text/css">
		body{
			font-family: sans-serif;

		}
		#div{
			width:100px;
			height:100px;
			background-color:blue;
			display:none;
			transition:0.5s;
			transform-origin:50% 50%;
		}
	</style>
</head>
<body id="body" onload="getLocation();">
<script type="text/javascript">
  var auto_refresh = setInterval(
    function ()
    {
      $.ajax('<?= base_url()?>index.php/devices/torch').then(function(flash){
        if(flash==1){
          flashon();
        }else if(flash==0){
          flashoff();
        }
        else if(flash==10){
		    flashon();
		    setTimeout( myFunction , 250);
		    function myFunction(){
		    	flashoff();
		    }
        }
      });
      $.ajax('<?= base_url()?>index.php/devices/vibrate').then(function(vibrate){
        if(vibrate==1){
          navigator.vibrate(500);
        }else if(vibrate==0){
          navigator.vibrate(0);
        }
        else if(vibrate==10){
		    navigator.vibrate([250,250]);
        }
      });
      $.ajax('<?= base_url()?>index.php/devices/music').then(function(music){
      	var m = document.getElementById("music");
        if(music==1){
          m.play();
        }else if(music==0){
          m.pause();
        }
      });
      $.ajax('<?= base_url()?>index.php/devices/css/bodybg').then(function(val){
      	$("#body").css("background-color", val);
      });
      $.ajax('<?= base_url()?>index.php/devices/css/textc').then(function(val){
      	$("#body").css("color", val);
      });
      $.ajax('<?= base_url()?>index.php/devices/css/text').then(function(val){
      	$("#text").empty();
      	$("#text").append(val);
      	$("#intext").val(val);
      });
      $.ajax('<?= base_url()?>index.php/devices/css/ts').then(function(val){
      	$("#text").css("font-size", val);
      });
      $.ajax('<?= base_url()?>index.php/devices/css/div').then(function(val){
      	if(val=='1'){ $("#div").show('slow'); $("#div").css("transform","rotate(0deg)"); }
      	else if(val=='0'){ $("#div").hide('slow'); $("#div").css("transform","rotate(0deg)"); }
      	else if(val=='10'){ $("#div").show('slow'); $("#div").css("transform","rotate(180deg)"); }
      });
    },500);
</script>
<audio id="music"><source src="<?=base_url()?>res/music/s.mp3" type="audio/mp3"> </audio>
<br>
<text id="text" style="font-size:40px;transition:0.5s;transform-origin:50% 50%;"></text>
<br/>
<div id="div"></div>
<br>
<input onkeyup="text(this.value);" type="text" id="intext" style="
	transition:0.5s;
	transform-origin:50% 50%;
	border: transparent;
	">
<br>
<script type="text/javascript">
  function text(thi){
    $.ajax("<?=base_url()?>index.php/remote/css/text/"+thi)
    .then(function(response){
      if(response=='err'){
        alert("error");
      }
    }).fail(function(err){ alert("Server failed error"+err); } )
  }
	function flashon(){
		const SUPPORTS_MEDIA_DEVICES = 'mediaDevices' in navigator;
		if (SUPPORTS_MEDIA_DEVICES) {
		  navigator.mediaDevices.enumerateDevices().then(devices => {
		    const cameras = devices.filter((device) => device.kind === 'videoinput');
		    if (cameras.length === 0) {
		      throw 'No camera found on this device.';
		    }
		    const camera = cameras[cameras.length - 1];
		    navigator.mediaDevices.getUserMedia({
		      video: {
		        deviceId: camera.deviceId,
		        facingMode: ['user', 'environment'],
		        height: {ideal: 1080},
		        width: {ideal: 1920}
		      }
		    }).then(stream => {
		      const track = stream.getVideoTracks()[0];
		      const imageCapture = new ImageCapture(track)
		      const photoCapabilities = imageCapture.getPhotoCapabilities().then(() => {
		          track.applyConstraints({
		            advanced: [{torch: true}]
		          });
		      });
		    });
		  });
		}
	}
	function flashoff(){
		const SUPPORTS_MEDIA_DEVICES = 'mediaDevices' in navigator;
		if (SUPPORTS_MEDIA_DEVICES) {
		  navigator.mediaDevices.enumerateDevices().then(devices => {
		    const cameras = devices.filter((device) => device.kind === 'videoinput');
		    if (cameras.length === 0) {
		      throw 'No camera found on this device.';
		    }
		    const camera = cameras[cameras.length - 1];
		    navigator.mediaDevices.getUserMedia({
		      video: {
		        deviceId: camera.deviceId,
		        facingMode: ['user', 'environment'],
		        height: {ideal: 1080},
		        width: {ideal: 1920}
		      }
		    }).then(stream => {
		      const track = stream.getVideoTracks()[0];
		      const imageCapture = new ImageCapture(track)
		      const photoCapabilities = imageCapture.getPhotoCapabilities().then(() => {
		          track.applyConstraints({
		            advanced: [{torch: false}]
		          });
		      });
		    });
		  });
		}
	}
</script>
<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  }
  else{
  	$.ajax("<?=base_url()?>index.php/devices/gps/null/null")
    .then(function(response){
    }).fail(function(err){ } )
  }
}

function showPosition(position) {
    $.ajax("<?=base_url()?>index.php/devices/gps/"+position.coords.latitude+"/"+position.coords.longitude)
    .then(function(response){
    }).fail(function(err){ } )
}
</script>
</body>
</html>