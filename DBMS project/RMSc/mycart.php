
<?php
    session_start() ;
    $conn = new mysqli ('localhost', 'root', '', 'rms') ;
    if (isset($_POST["add_cart"])) {
        $name = $_POST['hidden_name'] ;
        $quan = $_POST['quantity'] ;
        $price = $_POST['hidden_price'] ;
        $food_i = $_GET['id'] ;

        /*$user_id = "select * from customer where cus_id = '".$_GET['c_id']. "'" ;

        $rt = $conn->query($user_id) ;
        $fect = $rt->fetch_assoc() ;*/

        $qu = "insert into cart(foodname, foodid, amount, quantity, subtotal, cus_id) values ('".$name."','".$food_i."','".$price."','".$quan."','".($price * $quan)."','".$_GET['c_id']."') ;" ;

        $res = $conn->query($qu) ;
        header('location: restaurants.php?id='.$_SESSION['idd']. '&_id='.$_GET['c_id']) ;

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <div class="heading">
        <h2>Shopping Cart</h2>
    </div>
    <div class="container">
        <?php
            $qry = "select * from cart" ;
            $rlt = $conn->query($qry) ; ?>

            <table>
                <tr>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub-Total</th>
                    <th>Action</th>
                </tr>
                <?php 
                    while ($rww = $rlt->fetch_assoc()) { ?>
                        <tr>
                            <td> <?php echo $rww["foodname"] ?> </td>
                            <td> <?php echo $rww["quantity"] ?> </td>
                            <td> <?php echo $rww["amount"] ?> </td>
                            <td> <?php echo $rww["subtotal"] ?> </td>
                            <td><a href="delete.php?fid=<?php echo $rww['foodname']?>&r_id=<?php echo $_GET['id']?>&c_id=<?php echo $_GET['_id']?>">Delete</a></td>
                        </tr>
                    <?php
                    }
                ?>
            </table>
    </div>
    <div class="orderbtn">
        <p>Total Amount: <?php
            $amt = "select sum(subtotal) as subtotal from cart" ;
            $re = $conn->query($amt) ;

            $ress = $re->fetch_assoc() ;

            echo $ress['subtotal'] ;
        ?></p>
        <form method= "POST" action="payment.php?id=<?php echo $_SESSION['idd'] ?>&_id=<?php echo $_GET['_id']?>">
                <input type="submit" class="btn" value="Submit" name= "submitbtn">
        </form>
    </div>
</body>
</html>