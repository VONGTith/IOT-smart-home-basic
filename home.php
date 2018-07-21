<?php
	require_once("./config.php");
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
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

	$port = fopen("COM5", "w+"); 
	// sleep(1);
	usleep( 250000 );
?> 

<!DOCTYPE html>
<html>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<link rel="stylesheet" type="text/css" href="lightStyle.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<head>
	<title>iot</title>
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
	
	</div>

	<div id="myHome" class="modal">
		<div class="modal-content">

			<a href="./room.php"><span class="closeHome">&times;</span></a>
			<h2>Room</h2>
			
				<div class="homePlan">
					<img src="home.png">
				</div>

				<div class="home">
					

					<?php 

						$roomId = "
							<div class='light1'>
								<form action='./home.php' method = 'POST' >
									<input type='checkbox' name='status' id='light1' onClick='this.form.submit()'>
									<label for='light1'></label>
									<input name='updateId' value='1' type='hidden'>
								</form>
							</div>
							";

						$roomId .= "
							<div class='light2'>
								<form action='./home.php' method = 'POST' >
									<input type='checkbox' name='status' id='light2' onClick='this.form.submit()'>
									<label for='light2'></label>
									<input name='updateId' value='2' type='hidden'>
								</form>
							</div>
							";

						$roomId .= "
							<div class='light3'>
								<form action='./home.php' method = 'POST' >
									<input type='checkbox' name='status' id='light3' onClick='this.form.submit()'>
									<label for='light3'></label>
									<input name='updateId' value='3' type='hidden'>
								</form>
							</div>
							";

 						if(isset($_POST['updateId'])){
							$id = $_POST['updateId'];
							$sql = "SELECT * FROM light WHERE lid=$id";
							$data = mysqli_fetch_assoc(mysqli_query($con, $sql));
							$status = $data['status'];

							if($status == "ON"){
								$newStatus = "OFF";
								$sql="UPDATE `light` SET status='$newStatus' WHERE lid='$id'";
								mysqli_query($con, $sql);

								if($id == 1){
			    				fwrite($port, "aa");
				    			}if($id == 2){
				    				fwrite($port, "bb");
				    			}if($id == 3){
				    				fwrite($port, "cc");
				    			}
				    			fclose($port);

								
								
								
							}else if($status == "OFF"){
								$newStatus = "ON";
								$sql="UPDATE `light` SET status='$newStatus' WHERE lid='$id'";
								mysqli_query($con, $sql);
								if($id == 1){
			    				fwrite($port, "a");
				    			}if($id == 2){
				    				fwrite($port, "b");
				    			}if($id == 3){
				    				fwrite($port, "c");
				    			}
				    			fclose($port);
							}


						}

						$i = 1;

						$sql = "SELECT * FROM light";
						$query = mysqli_query($con, $sql);
						while($data = mysqli_fetch_assoc($query)){
							$lid = $data['lid'];
							$status = $data['status'];
							$id = "light".$i;

							if($status == "ON"){

								$roomId .="<script>
										document.getElementById('$id').checked = true;
			    				</script>";
			    				

								
							}else if($status == "OFF"){

								$roomId .="<script>
										document.getElementById('$id').checked = false;
			    				</script>";
			    				
							}

							$i++;

						}

						

						

						echo $roomId;

					?>


   			
		</div>
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


	<script>
    var result=0;
    // Add active class to the current button (highlight it)
    var header = document.getElementById("myDIV");
    var btns = header.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }


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

<script type="text/javascript">
		$(document).ready(function() {
			$('.toggle').click(function() {
				$('.inner').toggleClass('active')
				.submit();
			})
			
		})
</script>

</html>