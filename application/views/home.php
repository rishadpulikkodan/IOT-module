<!DOCTYPE html>
<html>
<head>
	<title>IOT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css">
		button{
			width: 100%;
			height: 20vh;
			font-size: 5vh;
		}
	</style>
</head>
<body>
	<a href="<?=base_url()?>devices">
		<button><i class="material-icons">&#xe337;</i> Devices</button>
	</a>
	<br><br>
	<a href="<?=base_url()?>remote">
		<button><i class="material-icons">&#xe8c7;</i> Remote</button>
	</a>
	<br><br>
	<p align="center">About<br/><br/>
	Powered By Firmtech<br/>
	&copy; 2016 ~ <?php echo date('Y'); ?> <a target="_blank" href="https://firmtech.tech">firmtech</a>
	</p>
</body>
</html>