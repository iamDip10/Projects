<?php
    session_start() ;
    $conn = new mysqli('localhost', 'root', '', 'rms') ;

    $chk = "select assign from chief where name = '".$_GET['name']."'" ;
    $rg = $conn->query($chk)->fetch_assoc() ;

    if ($rg['assign'] == 0) {
        
        $rr = "Cooking..." ;
        $ord = "update orders set status = '".$rr."' where order_id = '".$_GET['oid']."'" ;
        $gh = $conn->query($ord) ;
        $vb = 1; 
        $chf = "update chief set assign = '".$vb."' where name = '".$_GET['name']."'" ;
        $hj = $conn->query($chf) ;
    }
    else if ($rg['assign'] == 1) {

        $oop = "select user_chk from orders where order_id = '".$_GET['oid']."'" ;
        $lk = $conn->query($oop) ;
        $lopp = $lk->fetch_assoc() ;
        $rt ;
        
        if ($lopp['user_chk'] == 1) {
            $rt = "Deliver!" ;
        }else $rt = "Ready to Deliver!" ;
        
        $orh = "update orders set status = '".$rt."' where order_id = '".$_GET['oid']."'" ;
        $gh = $conn->query($orh) ;
        $vbb = 0; 
        $ac = "Active" ;
        $chff = "update chief set assign = '".$vbb."', active_status = '".$ac."' where name = '".$_GET['name']."'" ;
        $hj = $conn->query($chff) ;
    }

    header('location: chief.php?name='.$_GET['name'].'&res_id='.$_GET['res_id']) ;
?>