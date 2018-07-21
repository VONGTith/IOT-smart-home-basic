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
	
	</div>

	<div id="myHome" class="modal">
		<div class="modal-content">

			<a href="./room.php"><span class="closeHome">&times;</span></a>
			<h2>Light Control By Room</h2>
            <h2>tith</h2>
   			<div class="roomSelection">
   				<?php 

					$query = "select * from light";
					$result = mysqli_query($con,$query);

		    		$roomId = "
		    		<form action='./light.php' method='POST'>
			    			<select id='roomSelection' name='roomId' onChange='this.form.submit()'>
				    		";
					$roomId .= "<option>Select Room</option>";

				    	  while($light = mysqli_fetch_assoc($result)){
		                         $lid = $light['lid'];
		                         $roomId .= "<option value='$lid'>Room $lid</option>";
		                  }

		                  

			    		$roomId .="</select></form>";

			    	if(isset($_GET['sendRoomId'])){
			    		$Id = $_GET['sendRoomId'];
			    		$query = "select * from light where lid=$Id";
						$result =mysqli_fetch_assoc(mysqli_query($con,$query));
						$lid = $result['lid'];
						$status= $result['status'];

						$roomId .= "<p>Room $Id</p>";

								$roomId .= "<form class='ONnOFF' action='./dolight.php' method='POST' id='myDIV'>
									<input type='radio' name='status' id='lightON' value='ON' onClick='this.form.submit()'><label for='lightON' class='btn'>ON</label></input>
									<input type='radio' name='status' id='lightOFF' value='OFF' onClick='this.form.submit()'><label for='lightOFF' class='btn'>OFF</label></input>
									<input type='hidden' name='lid' value='$lid'>
								</form>";
						

						if($status == "ON"){
							$roomId .="<script>
								document.getElementById('lightON').checked = true;
			    			</script>";
			    			if($Id == 1){
			    				fwrite($port, "a");
			    			}else if($Id == 2){
			    				fwrite($port, "b");
			    			}else if($Id == 3){
			    				fwrite($port, "c");
			    			}
			    			fclose($port);

						}else if($status =="OFF"){
							$roomId .="<script>
								document.getElementById('lightOFF').checked = true;
			    			</script>";
			    			if($Id == 1){
			    				fwrite($port, "aa");
			    			}else if($Id == 2){
			    				fwrite($port, "bb");
			    			}else if($Id == 3){
			    				fwrite($port, "cc");
			    			}
			    			fclose($port);
						}
						

			    	}
			    	
					echo $roomId;
				?>

				<?php 
					if(isset($_POST['roomId'])){

						$roomId = $_POST['roomId'];
						
						header("location:light.php?sendRoomId=".$roomId);
					}
					if(isset($_POST['status'])){
						$roomId = $_POST['lid'];
						$controlLight = $_POST['status'];

						$sql="UPDATE `light` SET status='$controlLight' WHERE lid=$roomId";
						mysqli_query($con, $sql);
						header("location:light.php?sendRoomId=".$roomId);
					}

				?>

				<?php

					if(isset($_POST['setRoomId'])){
						$roomId = $_POST['setRoomId'];
						$status = $_POST['status'];
						$ampher = $_POST['ampher'];

						$sql = "INSERT INTO light(lid,status,ampher) VALUES ('$roomId','$status','$ampher')"; 
						mysqli_query($con, $sql);
						header("location:light.php?sendRoomId=".$roomId);

					}


				 ?>

   			</div>

   			<div class="tableOfprice">
    			<table class="price">
    				<tr>
    					<th></th>
						<?php
							$string="";
							$now = "2018-07-08";//date("Y-m-d");
							$lastWeek = "2018-07-01";//date('Y-m-d', strtotime('-7 days'));
							$sql="select * from daily where date<'$now' and date>='$lastWeek'";
							$result = mysqli_query($con,$sql);
							while ($row = mysqli_fetch_object($result)) {
								$date=$row->date;
								$string.="<td>";
								$string.=$date."</td>";
							}
							echo $string;
						?>
    				</tr>
    				<tr>
    					<th>KW</th>
						<?php
						$string="";
						$now = "2018-07-08";//date("Y-m-d");
						$lastWeek = "2018-07-01";//date('Y-m-d', strtotime('-7 days'));
						$sql="select * from daily where date<'$now' and date>='$lastWeek'";
						$result = mysqli_query($con,$sql);
						while($row = mysqli_fetch_object($result)){
							$string.="<td>";
							$string.=$row->kw."</td>";
						}
						echo $string;
						?>
    				</tr>
    				<tr>
    					<th>Price</th>
						<?php
						$string="";
						$now = "2018-07-08";//date("Y-m-d");
						$lastWeek = "2018-07-01";//date('Y-m-d', strtotime('-7 days'));
						$sql="select * from daily where date<'$now' and date>='$lastWeek'";
						$result = mysqli_query($con,$sql);
						while($row = mysqli_fetch_object($result)){
							$string.="<td>";
							$string.=($row->kw*800)."</td>";
						}
						echo $string;
						?>
    				</tr>
    			</table>
    		</div>
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