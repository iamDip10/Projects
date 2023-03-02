<!-- -----------------------------------------------------------------PART OF HIRA-------------------------------- -->

<!-- full backend -->
<!-- This page is mainly checking the AVALABILTY of chief and ASSIGNING TASK to the available chief -->
<?php
    session_start() ;
    $conn = new mysqli('localhost', 'root', '', 'rms') ;
    // a simple query of checking the active status of chief
    $chk = "select active_status from chief where name = '".$_GET['name']."'" ;
    $f = $conn->query($chk) ; // running the query
    $g = $f->fetch_assoc() ; // fetching the result
    // the line below is to check the active status of a chief
    if ($g['active_status'] == "Active") {
        // if a chief is active then he can be assinged for a task
        //so we will indicate it by a text "working on order 'order_number'"
        $av = "Working on order ".$_GET['id'] ;
        //updating the active status of the chief in database
        $r = "update chief set active_status = '".$av."', order_no = '".$_GET['id']."' where name = '".$_GET['name']."'" ; //query
        $t = $conn->query($r) ; //running query
        // as the order has been ready for process so delete it from order table on database
        $gg = "Working.." ;
        $ee = "update orders set chief_name = '".$_GET['name']."', status = '".$gg."' where order_id = '".$_GET['id']."'" ; // query
        $ress = $conn->query($ee) ; //running query

        header('location: managerdash.php?id='.$_GET['mid']) ;
    }
    else echo '<script>alert("Wroking on an order")</script>'

    

?>