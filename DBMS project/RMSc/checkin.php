<?php
    session_start() ;
    $conn = new mysqli('localhost', 'root', '', 'rms') ;
    $var = 1 ;
    $varr = time() / 3600 % 24 .':'. time() / 60 % 60 ;
    $vt = "Deliver!" ;
    $cff = "select status from orders where cus_id = '".$_GET['_id']."'";
    $gh = $conn->query($cff) ; $lop = $gh->fetch_assoc() ;
    if ($lop['status'] == "Ready to Deliver!") {
        $chkin = "update orders set user_chk = '".$var."', time = '".$varr."', status = '".$vt."' where cus_id = '".$_GET['_id']."'" ;
        $cc = $conn->query($chkin) ;
        
    } 
    header('location: restaurants.php?id='.$_GET['id'].'&_id='.$_GET['_id']) ;

?>