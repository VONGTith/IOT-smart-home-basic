<?php

require_once("./config.php");
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);



mysqli_querry($con,$sql);




mysqli_close($con);
?>