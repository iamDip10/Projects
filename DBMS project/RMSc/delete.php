<?php
    session_start() ;

    $conn = new mysqli('localhost', 'root', '', 'rms') ;

    $rff = "delete from cart where foodname = '".$_GET['fid']."'" ;
    echo $rff ;
    $hg = $conn->query($rff) ;

    header('location: mycart.php?id='.$_GET['r_id'].'&_id='.$_GET['c_id']) ;

?>