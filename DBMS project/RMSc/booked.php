<?php

    session_start() ;
    $conn = new mysqli('localhost', 'root', '', 'rms') ;
    if (isset($_POST['btn'])) {
        $que = "insert into booking(seat_booked, cus_id) values('".$_POST['booked']."','".$_GET['cid']."')" ;
        echo $que ;
        $res = $conn->query($que) ;
        header('location:restaurants.php?id='.$_GET['resid'].'&_id='.$_GET['cid']) ;
    }
?>