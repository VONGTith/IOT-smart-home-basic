<?php
    require_once("config.php");
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    $now=date("Y-m-d");
    $n= new datetime($now);
    $sql = "SELECT `date` FROM `lastupdate`";
    $result = mysqli_fetch_object(mysqli_query($con,$sql));
    $lastupdate=$result->date;
    $last= new Datetime($lastupdate);
    $n = $n->diff($last)->format("%a");
    $usage=0;
    for($i=1;$i<=$n;$i++){
        $date = date('Y-m-d', strtotime('+'.$i.' days', strtotime($lastupdate)));

        $sql = "SELECT * FROM `lightusage` WHERE `lid`=1 and `datetime` like '$date%'";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0){
            $num = mysqli_num_rows($result);
            $n=0;
            while($n<$num){
                $r1= mysqli_fetch_object($result);
                $r2= mysqli_fetch_object($result);
                $time1= strtotime($r1->datetime);
                $time2= strtotime($r2->datetime);
                $usage +=round(abs($time2 - $time1) / 60,2);
                $n+=2;
            }
        }
        $usage=0;

        $sql = "SELECT * FROM `lightusage` WHERE `lid`=2 and `datetime` like '$date%'";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0){
            $num = mysqli_num_rows($result);
            $n=0;
            while($n<$num){
                $r1= mysqli_fetch_object($result);
                $r2= mysqli_fetch_object($result);
                $time1= strtotime($r1->datetime);
                $time2= strtotime($r2->datetime);
                $usage +=round(abs($time2 - $time1) / 60,2);
                $n+=2;
            }
        }
        $sql = "SELECT * FROM `lightusage` WHERE `lid`=3 and `datetime` like '$date%'";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) > 0){
            $num = mysqli_num_rows($result);
            $n=0;
            while($n<$num){
                $r1= mysqli_fetch_object($result);
                $r2= mysqli_fetch_object($result);
                $time1= strtotime($r1->datetime);
                $time2= strtotime($r2->datetime);
                $usage +=round(abs($time2 - $time1) / 60,2);
                $n+=2;
            }
        }
        $usage = ($usage/60)*2;
        $sql = "INSERT INTO `daily`(`id`, `date`, `kw`) VALUES ('null','$date','$usage')";
        mysqli_query($con,$sql);
        $usage=0;
    }
    $sql="UPDATE `lastupdate` SET `date`='$now'";
    mysqli_query($con,$sql);
    echo "";
    header("location:home.php");
?>