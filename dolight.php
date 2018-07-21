<?php
    require_once("config.php");
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $lid = $_POST["lid"];
    $Status = $_POST["status"];
    if(isset($_POST['roomId'])){

        $roomId = $_POST['roomId'];
        
        header("location:light.php?sendRoomId=".$roomId);
    }
    if(isset($_POST['status'])){
        $roomId = $_POST['lid'];
        $controlLight = $_POST['status'];
        $now = date("Y-m-d H:i:s");

        $sql="UPDATE `light` SET status='$controlLight' WHERE lid=$roomId";
        mysqli_query($con, $sql);
        $sql="INSERT INTO `lightusage`(`usageid`, `datetime`, `status`, `lid`) VALUES ('','$now','$controlLight','$roomId')";
        mysqli_query($con, $sql);
        mysqli_close($con);
        header("location:light.php?sendRoomId=".$roomId);
    }
?>