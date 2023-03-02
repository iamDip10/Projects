<?php 
session_start() ;
    if (isset($_SESSION['name'])) {

        
        $conn = new mysqli('localhost', 'root', '', 'rms') ;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chief.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="head">
            <h2>Pending Orders</h2>
            <a href="logout.php">Logout</a>
        </div>
        <div class="orders">
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Foods</th>
                    <th>Action</th>
                </tr>
                <tbody>
                    <?php
                        $v = "Ready to Deliver!" ;
                        $t = "Deliver!" ;
                        $qr = "select * from orders where res_id = '".$_GET['res_id']."' and status != '".$v."'" ;
                        $fg = $conn->query($qr) ;
                        while ($rg = $fg->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $rg['order_id'] ?></td>
                                <td><?php 
                                    $arr = explode(",", $rg['food_id']) ;
                                    $var = 0 ;
                                    $arr_ = array();
                                    while ($var < count($arr)) {
                                        $qry = "select food_name from food where food_id='".$arr[$var]."'" ;
                                        $exe = $conn->query($qry) ;
                                        $res = $exe->fetch_assoc() ;
    
                                        $arr_[] = $res['food_name'] ;
                                        $var++ ;
                                    }
    
                                    echo implode(', ', $arr_) ;
                                ?></td>
                                <td>
                                    <?php 
                                        $kk = "select assign from chief where name = '".$_GET['name']."'" ;
                                        $t = $conn->query($kk) ;
                                        $h = $t->fetch_assoc() ;
                                        if ($_GET['name'] == $rg['chief_name']) {
                                            if ($h['assign'] == 0) {?>
                                            <a id="btn" href="postchief.php?name=<?php echo $rg['chief_name']?>&oid=<?php echo $rg['order_id']?>&res_id=<?php echo $_GET['res_id']?>"><?php  echo "Start" ; } else {?></a>

                                        
                                            <a id= "btn" href="postchief.php?name=<?php echo $rg['chief_name']?>&oid=<?php echo $rg['order_id']?>&res_id=<?php echo $_GET['res_id']?>"><?php echo "Done" ;}?> </a>

                                    <?php
                                        }
                                        else if ($rg['chief_name'] == "null") {
                                            echo "Pending" ;
                                        }else {
                                            echo "Working chief ". $rg["chief_name"] ;
                                        }
                                        ?>

                                
                                    </td>
                                
                            </tr>

                        <?php 
                        } }else {
                            header('location: index.html') ;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var butn = document.getElementById("btn") ;
        console.log(butn.innerHTML.localeCompare ("Start"));       
        if (butn.innerHTML.localeCompare ("Start") == 1) {
            console.log(butn.innerHTML) ;
            butn.style.backgroundColor = "Orange" ;
            butn.style.color = "White" ;
        }else if (butn.innerHTML.localeCompare ("Done") == 1) {
            console.log(butn.innerHTML) ;
            butn.style.backgroundColor = "Green" ;
            butn.style.color = "White" ;
        }

    </script>
</body>
</html>