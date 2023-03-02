
<?php
    session_start() ;
    $conn = new mysqli ('localhost', 'root', '', 'rms') ;

    if (isset($_POST["sub"])) {
        $_SESSION['tid'] = uniqid() ;
        if ($_POST['pay'] == "cash")
            $pay = 1 ;
        else $pay = 0 ;
        $qq = "select * from cart where cus_id = '".$_GET['_id']. "'" ;
        $dup = "select * from orders where cus_id = '".$_GET['_id']."'" ;
        $booing = "select booking_id from booking where cus_id = ".$_GET['_id'] ;
        $pay = "insert into payment(transaction, payment_status, payment_method, res_id, cus_id) values ('".$_SESSION['tid']."', '".$pay."', '".$_POST['pay']."', '".$_GET['id']."', '".$_GET['_id']."')" ;

        $runpa = $conn->query($pay) ;
        $runbook = $conn->query($booing) ;
        $fb = $runbook->fetch_assoc();
        $chk_dup = $conn->query($dup) ;

        if ($chk_dup->num_rows == 0 ) {
            $frm = $conn->query($qq) ;
            //$srss = $frm->fetch_assoc() ;
            $total =  0 ;
            $products = array() ;
            while ($rss = $frm->fetch_assoc()) {
                $products[] = $rss["foodid"] ;
                $total += $rss["subtotal"] ;
            }

            $prod = implode(",", $products);
            $vrr;
            if ($_POST['pay'] == "cash") {
                $vrr = "Not Paid" ;
            }else $vrr = "Paid" ;
            $rr = "insert into orders(total_amount, food_id, payment_status, booking_id, cus_id, res_id) VALUES ('".$total."','".$prod."', '".$vrr."' ,'".$fb['booking_id']."', '".$_GET['_id']."','".$_GET['id']."')" ;
            if ($conn->query($rr)) {
                echo '<div class= "success" style = "padding: 1%;
                text-align: center; 
                background-color: aquamarine;"> <h3>Your order placed sucessfully.</h3></div>' ;
    
                $dele = "delete from cart where cus_id = '". $_GET['_id']. "'" ;
                $conn->query($dele) ;
            }
        } 
        else {
            $pre_q = "select total_amount, food_id from orders where cus_id = '".$_GET['_id']."'" ;
            $pre_e = $conn->query($pre_q) ;
            $pre_r = $pre_e->fetch_assoc() ;
            
            $new_q = $conn->query($qq) ;
            $tottal = 0 ;
            $prod_n = array() ;

            while ($rff = $new_q->fetch_assoc()) {
                $tottal += $rff['subtotal'] ;
                $prod_n[] = $rff['foodid'] ;
            }

            $f_pro = implode(',', $prod_n) ;

            $rrq = "update orders set total_amount= '".($pre_r['total_amount'] + $tottal)."',food_id = '".($pre_r['food_id'].','.$f_pro)."' where cus_id = '".$_GET['_id']."'" ;

            if ($conn->query($rrq)) {
                echo '<div class= "success" style = "padding: 1%;
                text-align: center; 
                background-color: aquamarine;"> <h3>Updated.</h3></div>' ;
    
                $delee = "delete from cart where cus_id = '". $_GET['_id'] . "'" ;
                $conn->query($delee) ;
            }
        }
        

        // ------------------------------------------------------------------------------- end ------------------------------------------------//


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/res.css">
</head>
<body>

    <?php
        

        $qt = "select * from restaurant where res_id = '".$_GET['id']."'" ;

        $reslt = $conn->query($qt) ;

        $row = $reslt->fetch_assoc() ;

        $_SESSION['idd'] = $_GET['id'] ;
        
    ?>

        <div class="greetings">
            <h1>Hello and Welcome to <span> <?php echo $row["res_name"] ?></span></h1>
            <div class="container">
                <ul id="contain">
                    
                    <li><a href="#orderfood">Order Food</a></li>
                    <li><a href="booksystem.php?resid=<?php echo $_GET['id']?>&cid=<?php echo $_GET['_id']?>">Book Seats</a></li>
                    <li><a href="mycart.php?id=<?php echo $_GET['id']?>&_id=<?php echo $_GET['_id']?>">My Cart</a></li>
                    <li><a href="userdashboard.php?id=<?php echo $_GET['_id']?>">Back to dashboard</a></li>
                    <li><a href="checkin.php?id=<?php echo $_GET['id']?>&_id=<?php echo $_GET['_id']?>">Check In</a></li>
    
                </ul>
            </div>
        </div>
        
        <div class="des">
                <div class="descc">
    
                    <h3>About our restaurant</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis fugiat magni officia pariatur corrupti tempore architecto, quisquam beatae! Facilis unde aliquam ducimus reiciendis ipsum dicta sit veritatis consequatur non harum. Dolorem sint fugiat maxime iste et blanditiis eligendi dignissimos ipsum?</p>
                </div>
                <div class="contact">
    
                    <h3>Contacts</h3>
                    <?php
                        $add = "select res_address from restaurant where res_id = '".$_GET['id']."'" ;
    
                        $phone = "select contact_no from res_manager where us_name =(select us_name from restaurant where res_id = '".$_GET['id']."')" ;
                        $fech = $conn->query($add) ;
                        $pho_f = $conn->query($phone) ;
    
                        $ph = $pho_f->fetch_assoc() ;
                        $ares = $fech->fetch_assoc() ;

                    ?>
                    <p>Address: <?php echo $ares['res_address'] ?><br>Phone: <?php echo $ph["contact_no"] ?> </p>
                </div>
        </div>
    
        <div class="order" id="orderfood">
    
                
           
                <?php
    
                    $qt = "select * from food where res_id = '".$_GET['id']."'" ;
    
                    $result = $conn->query($qt) ;
    
                    while ($roww = $result->fetch_assoc() ) { ?>
                        <div class="card">
                            <form method= "POST" action="mycart.php?id=<?php echo $roww['food_id']?>&r_id=<?php echo $_GET['id']?>&c_id=<?php echo $_GET['_id'] ?>" >
                                <img src="assets/<?php echo $roww["f_image"] ?>" alt="image">
                                <h3 class="foodname"><?php echo $roww["food_name"] ?></h3>
                                <p class="paragraph"> <?php echo $roww["food_desc"] ?></p>
                                <h4 class ="price">Price: <?php echo $roww["food_price"] ?></h4>
                                <input type="number" name="quantity" value="1" class="form">
                                <input type="hidden" name= "hidden_name" value="<?php echo $roww["food_name"] ?>">
                                <input type="hidden" name="hidden_price" value= "<?php echo $roww["food_price"] ?>">
                                <input type="submit" name="add_cart" value="Add to cart" class = "cartbtn">
    
                            </form>
                        </div>
                <?php
                } 
                    
                ?>
    
    
    </div>

</body>
</html>