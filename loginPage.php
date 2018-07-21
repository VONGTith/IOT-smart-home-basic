<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="roomStyle.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<head>
	<title></title>
</head>
<body>

	<div class="Background1">
		<img src="Background1.png" class="bg1"></img>
		<section></section>
		<img src="Background3.png" class="bg3"></img>
	</div>
	<div class="menutitle">
		<img src="smartroom.png">
	</div>
	<div id="MyClockDisplay" class="clock"></div>
	<div class="loingPage">
		<form method="POST" action="./dologin.php">
			<img src="profile.png">
			<p>User Admin</p>
			<input class="username" type="text" name="username"><br>
			<input class="userpassword" type="password" name="password"><br>
			<input class="loginSubmit" type="submit" name="submit" value="Login">
		</form>
	</div>

</body>
<script type="text/javascript">
	$(function(){
		var move = 0;
		setInterval(function(){
			move-=1;
			$('section').css('background-position', move + 'px');
		}, 20)
	})
</script>

<script type="text/javascript">
	function showTime(){
		var date = new Date();
		var h = date.getHours(); // 0 - 23
		var m = date.getMinutes(); // 0 - 59
		var s = date.getSeconds(); // 0 - 59
		var session = "AM";
 
			if(h == 0){
				h = 12;
			}
 
			if(h > 12){
				h = h - 12;
				session = "PM";
			}
 
			h = (h < 10) ? "0" + h : h;
			m = (m < 10) ? "0" + m : m;
			s = (s < 10) ? "0" + s : s;
 
			var time = h + ":" + m + ":" + s + " " + session;
			document.getElementById("MyClockDisplay").innerText = time;
			document.getElementById("MyClockDisplay").textContent = time;
 
			setTimeout(showTime, 1000);
		}
		showTime();
</script>
</html>