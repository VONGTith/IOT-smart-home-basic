<?php 

	
	require_once("./config.php");
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="roomStyle.css">
<head>
	<title></title>
</head>
<body>

	<?php 

		$query = "select * from light";
		$result = mysqli_query($con,$query);

    		$roomId = "
    		<form action='./onORoffLight.php' method='POST'>
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

				$roomId .= "Room $Id";

						$roomId .= "<form action='./onORoffLight.php' method='POST'><input type='radio' name='status' id='lightON' value='ON' onClick='this.form.submit()'>ON
							<input type='radio' name='status' id='lightOFF' value='OFF' onClick='this.form.submit()'>OFF
							<input type='hidden' name='lid' value='$lid'>
							</form>";
				

				if($status == "ON"){
					$roomId .="<script>
						document.getElementById('lightON').checked = true;
	    			</script>";
				}else if($status =="OFF"){
					$roomId .="<script>
						document.getElementById('lightOFF').checked = true;
	    			</script>";
				}
				

	    	}
	    	
			echo $roomId;

			?>

			<?php 
				if(isset($_POST['roomId'])){

					$roomId = $_POST['roomId'];
					
					header("location:onORoffLight.php?sendRoomId=".$roomId);
				}
				if(isset($_POST['status'])){
					$roomId = $_POST['lid'];
					$controlLight = $_POST['status'];

					$sql="UPDATE `light` SET status='$controlLight' WHERE lid=$roomId";
					mysqli_query($con, $sql);
					header("location:onORoffLight.php?sendRoomId=".$roomId);
				}

			?>

</body>

<script type="text/javascript">



</script>


</html>