

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pay.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pay your bill</h2>
        </div>
        <div class="pay-board">
            <h4>Select your payment method</h4>
            <div class="fill-form">
                <form action="restaurants.php?id=<?php echo $_GET['id']?>&_id=<?php echo $_GET['_id']?>" method="post">
                    <input type="radio" id="bkash" name="pay" value="bkash">
                    <label for="bkash">Bkash</label>
                    <input type="radio" id="rocket" name="pay" value="rocket">
                    <label for="bkash">Rocket</label>
                    <input type="radio" id="Upay" name="pay" value="upay">
                    <label for="bkash">Upay</label>
                    <input type="radio" id="cash" name="pay" value="cash">
                    <label for="bkash">Cash on</label>
                    <input type="text" name="ph-num" id="num" placeholder="Enter your phone number">
                    <input type="text" name="pin-num" id="pin" placeholder="Enter pin">
                    <input type="submit" name="sub" value="Submit">
            
                </form>
            </div>
        </div>
    </div>
</body>
</html>