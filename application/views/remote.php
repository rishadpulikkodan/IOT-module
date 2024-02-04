<!DOCTYPE html>
<html>
<head>
	<title>IOT-Remote</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style type="text/css">
    th{
      text-align:right;
    }
    .plate{
      width: fit-content;
      padding: 12px;
      border-radius: 20px;
      border:0.5px solid gray;
      margin: 5px;
    }
  </style>
</head>
<body>
<script type="text/javascript">
  var auto_refresh = setInterval(
    function ()
    {
      $.ajax('<?= base_url()?>index.php/remote/live/device').then(function(device){
          $("#device").empty();
          $("#device").append(device);
      });
      $.ajax('<?= base_url()?>index.php/remote/live/date').then(function(date){
          $("#date").empty();
          $("#date").append(date);
      });
      $.ajax('<?= base_url()?>index.php/remote/live/ua').then(function(ua){
          $("#ua").empty();
          $("#ua").append(ua);
      });
      $.ajax('<?= base_url()?>index.php/remote/live/ip').then(function(ip){
          $("#ip").empty();
          $("#ip").append(ip);
      });
    },500);
</script>
<div class="container">
  <br>
  <div class="row">
    <div class="col" style="display:flex;overflow-x:auto;padding:10px;">
      <div class="plate">
        <text>Torch</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="torch">
          <label class="custom-control-label" for="torch"><i class="material-icons">&#xe90f;</i></label>
        </div>
      </div>
      <div class="plate">
        <text>Blink</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="blink">
          <label class="custom-control-label" for="blink"><i class="material-icons">&#xe25f;</i></label>
        </div>
      </div>
      <div class="plate">
        <text>Vibrate</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="vibrate">
          <label class="custom-control-label" for="vibrate"><i class="material-icons">&#xe62d;</i></label>
        </div>
      </div>
      <div class="plate">
        <text>Pattern</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="pattern">
          <label class="custom-control-label" for="pattern"><i class="material-icons">&#xe62d;</i></label>
        </div>
      </div>
      <div class="plate">
        <text>Music</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="music">
          <label class="custom-control-label" for="music"><i class="material-icons">&#xe405;</i></label>
        </div>
      </div>
      <div class="plate">
        <text>Div</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="div">
          <label class="custom-control-label" for="div"><i class="material-icons">&#xe3c6;</i></label>
        </div>
      </div>
      <div class="plate">
        <text>Div</text>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="divr">
          <label class="custom-control-label" for="divr"><i class="material-icons">&#xe41a;</i></label>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col" style="display:flex;overflow-x:auto;padding:10px;">
      <div class="plate">
        <text>Bg</text><br>
        <input onchange="bgcolor(this.value);" value="#ffffff" type="color" id="bgcolor">
      </div>
      <div class="plate">
        <text>Text color</text><br>
        <input onchange="textc(this.value);" value="#000000" type="color" id="textc">
      </div>
      <div class="plate">
        <text>Text</text><br>
        <input onkeyup="text(this.value);" value=" " type="text" id="text">
      </div>
      <div class="plate">
        <text>Text size</text><br>
        <input onkeyup="ts(this.value);" onchange="ts(this.value);" style="width:50px;" type="number" value="40" id="ts">
      </div>

    </div>
  </div>
  <br>
	<div class="row">
		<div class="col">
      <div class="table-responsive f2" style="border-radius: 10px;box-shadow:0px 0px 10px 0px#80808080;">
        <table class='table table-bordered table-sm table-hover table-striped' style='white-space:nowrap;'>
            <tr><th colspan="2" style="text-align:center;">Last connected device info</th></tr>
            <tr><th>DEVICE_TYPE</th><td id="device"></td></tr>
            <tr><th>DATE & TIME</th><td id="date"></td></tr>
            <tr><th>HTTP_REFERER</th><td></td></tr>
            <tr><th>USER_AGENT</th><td id="ua"></td></tr>
            <tr><th>IP</th><td id="ip"></td></tr>
            <tr><th></th><td>https://firmtech.tech/products/iot/index.php/devices</td></tr>
        </table>
      </div>
		</div>
	</div>
  <br>
  <div class="row">
    <div class="col" style="text-align:center;">
      <p>Last location if have</p>
      <?php
        if($lat == 'null'){ ?>
          <p align="center" style="color:red;">Null</p>
        <?php } else { ?>
          <iframe id="iframe" src="https://maps.google.com/maps?q=<?=$lat?>, <?=$lot?>&z=15&output=embed" style="width:50vh;height:50vh;"></iframe>
        <?php } ?>
    </div>
  </div>
  <br>
	<div class="row">
		<div class="col" style="text-align:center;">
			<a class="btn btn-primary" href="<?=base_url()?>remote/reset">Reset / Clear</a>
		</div>
	</div>
  <br>
</div>
<script type="text/javascript">
  function bgcolor(thi){
    thi = thi.replace('#','');
    $.ajax("<?=base_url()?>index.php/remote/css/bgcolor/"+thi)
    .then(function(response){
      if(response=='err'){
        alert("error");
      }
    }).fail(function(err){ alert("Server failed error"+err); } )
  }
  function textc(thi){
    thi = thi.replace('#','');
    $.ajax("<?=base_url()?>index.php/remote/css/textc/"+thi)
    .then(function(response){
      if(response=='err'){
        alert("error");
      }
    }).fail(function(err){ alert("Server failed error"+err); } )
  }
  function text(thi){
    $.ajax("<?=base_url()?>index.php/remote/css/text/"+thi)
    .then(function(response){
      if(response=='err'){
        alert("error");
      }
    }).fail(function(err){ alert("Server failed error"+err); } )
  }
  function ts(thi){
    $.ajax("<?=base_url()?>index.php/remote/css/ts/"+thi+"px")
    .then(function(response){
      if(response=='err'){
        alert("error");
      }
    }).fail(function(err){ alert("Server failed error"+err); } )
  }
</script>
<script type="text/javascript">
  $("#torch").click(function(){
      if($("#torch").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/torch/on")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
      else if($("#torch").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/torch/off")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
  $("#blink").click(function(){
      if($("#blink").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/torch/blink")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){
          alert("Server failed error"+err);
        })
      }
      else if($("#blink").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/torch/off")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
  $("#vibrate").click(function(){
      if($("#vibrate").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/vibrate/on")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){
          alert("Server failed error"+err);
        })
      }
      else if($("#vibrate").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/vibrate/off")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
  $("#pattern").click(function(){
      if($("#pattern").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/vibrate/blink")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){
          alert("Server failed error"+err);
        })
      }
      else if($("#pattern").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/vibrate/off")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
  $("#music").click(function(){
      if($("#music").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/music/on")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){
          alert("Server failed error"+err);
        })
      }
      else if($("#music").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/music/off")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
  $("#div").click(function(){
      if($("#div").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/div/on")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){
          alert("Server failed error"+err);
        })
      }
      else if($("#div").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/div/off")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
  $("#divr").click(function(){
      if($("#divr").prop("checked") == true){
        $.ajax("<?=base_url()?>index.php/remote/div/rotate")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){
          alert("Server failed error"+err);
        })
      }
      else if($("#divr").prop("checked") == false){
        $.ajax("<?=base_url()?>index.php/remote/div/on")
        .then(function(response){
          if(response=='err'){
            alert("error");
          }
        }).fail(function(err){ alert("Server failed error"+err); } )
      }
  });
</script>
</body>
</html>