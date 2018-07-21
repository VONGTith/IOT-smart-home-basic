<?php
	$port = fopen("COM5", "w+"); 
	usleep( 250000 );
	$string = fread($port,7);
	fclose($port);
	require_once("./config.php");
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	mysqli_query($con, "UPDATE `teperature` SET `id`=0,`temp`=$string WHERE id=0");
	$result = mysqli_query($con, "select * from light");
	$i = 0;

	if (mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_object($result)) {
			$light[$i] = $row->status;
			$i++;
		}
	}

	$result = mysqli_query($con, "select * from teperature");
	if (mysqli_num_rows($result) > 0) {
		$temp = mysqli_fetch_object($result)->temp;
	}

?> 

<!DOCTYPE html>
<html>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<link rel="stylesheet" type="text/css" href="roomStyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
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
	<div class="tableBox">
		<ul>
			<li>
				<a id="myBtnhome" class="menuBox boxColor" href="./home.php">
					<i class="fas fa-home"></i>
					<p>HOME</p>
				</a>

				
			</li>
			<li>
				<a id="myBtnlight" class="menuBox boxColor" href="./light.php" >
					<i class="far fa-lightbulb"></i>
					<p>LIGHT</p>
				</a>
			</li>
			<li>
				<a id="myBtnthermometer" class="menuBox" href="#">
					<i class="fas fa-thermometer-three-quarters"></i>
					<p>TEMPERATURE</p>
				</a>
			</li>
			<li>
				<a id="myBtntv" class="menuBox" href="#">
					<i class="fas fa-tv"></i>
					<p>TV</p>
				</a>
			</li>
			<li>
				<a id="myBtnfan" class="menuBox" href="#">
					<i class="material-icons">toys</i>
					<p>FAN</p>
				</a>
			</li>
			<li>
				<a id="myBtndoor" class="menuBox" href="#">
					<i class="fas fa-unlock-alt"></i>
					<p>DOOR</p>
				</a>
			</li>
		</ul>
	</div>
	</div>

	<div id="myTemperature" class="modal">
		<div class="modal-content">

			<span class="closeTemperature">&times;</span>
			<h2>Temperature</h2>
			<i class="fas fa-thermometer-half"></i>
			<?php
				echo "<p class='number'>".$temp."</p>";
			?>
			<p class="number1">o</p>
			<p class="number2">C</p>

		</div>
	</div>

	<div id="myModal" class="modal">
  		<div class="modal-content">
    		<span class="close">&times;</span>
    		
    	

  		</div>
	</div>

	
</body>

<script type="text/javascript">
	function setRoom(){
		var setRoom = document.getElementById("roomSelection").value;
		console.log(setRoom);
	}
</script>

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

<script>
	var modalHome = document.getElementById('myHome');
	var btnHome = document.getElementById("myBtnhome");
	var spanHome = document.getElementsByClassName("closeHome")[0];
	btnHome.onclick = function() {
    	modalHome.style.display = "block";
		}
	spanHome.onclick = function() {
    	modalHome.style.display = "none";
		}
	window.onclick = function(event) {
    	if (event.target == modalHome) {
       		modalHome.style.display = "none";
   		 }
	}
</script>
<script>
	var modal = document.getElementById('myModal');
	var btn = document.getElementById("myBtnlight");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
    	modal.style.display = "block";
		}
	span.onclick = function() {
    	modal.style.display = "none";
		}
	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
   		 }
	}
</script>
<script>
	var modalTemperature = document.getElementById('myTemperature');
	var btnTemperature = document.getElementById("myBtnthermometer");
	var spanTemperature = document.getElementsByClassName("closeTemperature")[0];
	btnTemperature.onclick = function() {
    	modalTemperature.style.display = "block";
		}
	spanTemperature.onclick = function() {
    	modalTemperature.style.display = "none";
		}
	window.onclick = function(event) {
    	if (event.target == modal) {
       		modalTemperature.style.display = "none";
   		 }
	}
</script>
<script>
	var modal = document.getElementById('myModal');
	var btn = document.getElementById("myBtntv");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
    	modal.style.display = "block";
		}
	span.onclick = function() {
    	modal.style.display = "none";
		}
	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
   		 }
	}
</script>
<script>
	var modal = document.getElementById('myModal');
	var btn = document.getElementById("myBtnfan");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
    	modal.style.display = "block";
		}
	span.onclick = function() {
    	modal.style.display = "none";
		}
	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
   		 }
	}
</script>
<script>
	var modal = document.getElementById('myModal');
	var btn = document.getElementById("myBtndoor");
	var span = document.getElementsByClassName("close")[0];
	btn.onclick = function() {
    	modal.style.display = "block";
		}
	span.onclick = function() {
    	modal.style.display = "none";
		}
	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
   		 }
	}
</script>

<script type="text/javascript">
		$(document).ready(function() {
			$('.toggle').click(function() {
				$('.inner').toggleClass('active')
				.submit();
			})
			
		})
</script>

</html>