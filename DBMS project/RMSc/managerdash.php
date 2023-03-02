
<!-- ------------------------------------------------- PART OF HIRA ------------------------------------------- -->

<!-- The backend -->

<?php 

    session_start() ;
    
    if (isset($_SESSION['mname'])) {

    $conn = new mysqli('localhost', 'root', '', 'rms') ;
    // fetching all records from manager in main database
    $r = "select * from res_manager where res_id = ". $_GET['id'] ;
    // ruuning the above query that returns a boolean value and storing it $qq
    $qq = $conn->query($r) ;
    // getting the result in array form where each column name of database represents an array index. for example $ffd['manager_name'] will give the value of manager name of database
    $ffd = $qq->fetch_assoc() ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/mand.css">
</head>
<body>

    
    
    <div class="container">
        <div class="navbar">
            <div class="img">

                <img src="assets/logof.png" alt="">
            </div>
            <ul>
                <!-- -------- -->
                <li><a href="#orders">Pending Orders</a></li>  
                
                <li><a href="#" onclick="activee()">Add your chief</a></li> 
                <li><a href="#" onclick="addfood()">Add foods</a></li> 
                <li><a href="#" onclick="update()">Update Your Profile</a></li> 
                <li><a href="logout.php">Logout</a></li> <

            </ul>
        </div>
        <div class="contens" >
            <!-- pending order page -->
            <div class="ord" id="orders">
                <div class="upper">
                    <h2>Hello <?php echo $ffd["manager_name"] ?></h2>
                    <!-- The below buttons are used to see the chiefs and workers information of the restaurant. Only manager can access it -->
                    <button type="button" id="cheif" onclick="getchief()">Available Cheifs</button> 
                    <button type="button" id="workers" onclick="getWorkers()">Check-In Customers</button>
                    <!-- ------------------------------------------------------------------------------------------------------- -->
                </div>
                <?php 
                    // Backend of fetching order
                    // fetching all orders placed by different customer from orders table in database by the below command
                    $df = "select * from orders where res_id = '".$_GET['id']."' order by cus_id asc" ;
                    // ruuning the above query that returns a boolean value and storing it $fech
                    $fech = $conn->query($df) ; ?> <!-- close Backend -->

                <table id="tablee">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Amount</th>
                        <th>Food ID</th>
                        <th>Payment Status</th>
                        <th>Booking ID</th>
                        <th>Customer ID</th>
                        <th>Action</th>
                    </tr>
                <?php 
                    // Start Backend
                    // using a loop to show all the orders from database 
                    while ($hira = $fech->fetch_assoc()) {?>

                    <!-- Part of asif -->
                        <tr>
                            <td> <?php echo $hira["order_id"] ?> </td>
                            <td> <?php echo $hira["total_amount"] ?> </td>
                            <td> <?php 
                                $arr = explode(",", $hira['food_id']) ;
                                $var = 0 ;
                                $arr_ = array();
                                while ($var < count($arr)) {
                                    $qry = "select food_name from food where food_id='".$arr[$var]."'" ;
                                    $exe = $conn->query($qry) ;
                                    $res = $exe->fetch_assoc() ;

                                    $arr_[] = $res['food_name'] ;
                                    $var++ ;
                                    //echo $qry ;
                                }

                                echo implode(', ', $arr_) ;
                                ?>

                            </td>
                            
                            <td> <?php echo $hira["payment_status"] ?> </td>
                            <td> <?php echo $hira["booking_id"] ?> </td>
                            <td> <?php echo $hira["cus_id"] ?> </td>
                            <!-- 
                                go to assign.php
                             -->
                            <td> <a id="assi" href="assign.php?id=<?php echo $_GET['id']?>&oid=<?php echo $hira['order_id']?>"><?php echo $hira['status']?></a></td>

                        </tr>
                    <?php
                    }
                ?>
                </table>
            </div> 
            <!-- End of asif part -->

            
            <!-- -----------------------------------------------------part of Hira----------------------------------------------------------- -->
            <!-- Chief registration page -->
            <!-- the below div is for adding chief that can only done by a manager. Here chief will not be able to register himself. Only manager can add a cheif -->
            <div class="addcheif" id="acheif">
                <h2>Add Your <span>Chief</span></h2>
                <!-- Here below when the "submit" button is pressed then it will go to the link that is mention in "action" field of the form below
                here it will go  to "addchief.php" page 
                => for backend mainly 3 things need: 1. method (GET or POST) 2. action (for going to another page) 3. name(passing the value from one page to another) -->
                <form action="addchief.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>" method="post" >
                        <input type="text" placeholder="Username" name="uname">
                        <input type="password" placeholder="Password" name="pass">
                        <!-- below the name is using for passing the value of button and set to the addchief.php page -->
                        <button type="submit" name="submt" value="submit">Submit</button>
                </form>
            </div>
            <!-- Stuff registration page -->
            <!-- the below div is for adding "stuffs" that can only done by a manager. Here stuffs will not be able to register himself. Only manager can add a stuffs -->
            <div class="addstuff" id="astuffs">
                <h2>Add Your <span>Stuff</span></h2>
                <form action="addchief.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>" method="post" >
                        <input type="text" placeholder="Username" name="uname_">
                        <input type="password" placeholder="Password" name="pass_">
                        <button type="submit" name="submiit" value="submit">Submit</button>
                </form>
            </div>

            <div class="addfood" id="addfood">
                <h2>Add <span>Food</span></h2>
                <form action="addchief.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>" method="post" >
                        <input type="text" placeholder="Food name" name="fname">
                        <input type="text" placeholder="Describtion" name="descc">
                        <input type="text" placeholder="Food price" name="price">
                        <input type="text" placeholder="image" name="image">
                        <button type="submit" name="food" value="submit">Submit</button>
                </form>
            </div>

            <div class="updateMan" id="update">
                <h2>Update Profile</h2>
                <form action="addchief.php?id=<?php echo $_GET['id']?>&name=<?php echo $_GET['name']?>" method="post" >
                        <input type="text" placeholder="Manager name" name="m_name">
                        <input type="text" placeholder="Restaurant name" name="r_name">
                        <input type="text" placeholder="Contact number" name="con">
                        <input type="text" placeholder="Username" name="u_na">
                        <input type="password" placeholder="Update password" name="u_pa">
                        <button type="submit" name="updat" value="submit">Submit</button>
                </form>
            </div>

            <div class="chief" id="chif">
                <h2>Available Chief</h2>
                <div class="list">
                    <?php
                        $chff = "select * from chief" ;
                        $runchf = $conn->query($chff) ; ?>
                        <div class="table">
                            <table>
                                    <tr>
                                        <th>Name</th>
                                        <th>Available Status</th>
                                    </tr>
    
                                    <?php
                                    while ($feth = $runchf->fetch_assoc()) {?>
                                
                                    <tr>
                                        <td><?php echo $feth['name']?></td>
                                        <td><?php echo $feth['active_status']?></td>
                                    </tr>
                                
                            <?php
                            }
                        ?>
                                    
                        </table>

                        </div>
                </div>
            </div>

            <div class="employees" id="employee">
                <h2>Checked-In Customer</h2>
                <div class="list">
                    <?php
                        $chff = "select cus_name, cus_id from customer where cus_id = (select cus_id from orders where user_chk = '1')" ;
                        $runchf = $conn->query($chff) ; ?>
                        <div class="table">
                            <table>
                                    <tr>
                                        <th>Name</th>
                                        <th>Arrival time</th>
                                    </tr>
    
                                    <?php
                                    while ($feth = $runchf->fetch_assoc()) { ?>
                                    
                                    <tr>
                                        <td><?php echo $feth['cus_name']?></td>
                                        <td><?php 
                                            $tt = "select time from orders where cus_id = '".$feth['cus_id']."'" ;
                                            $lk = $conn->query($tt) ;
                                            $llk = $lk->fetch_assoc() ;

                                            echo $llk['time'] ;
                                        ?></td>
                                    </tr>
                                
                            <?php
                                    }}else {
                                        header('location: index.html') ;
                                    }
                        ?>
                                    
                        </table>

                        </div>
                </div>
            </div>


            
        </div> <!-- Contens -->

    </div>
    <!-- This is the javascript code for frontend popup feature -->
    <script>
        // declaring variables 
        // getElementById is used for storing the content of the corresponding id
        //blur variable is storing the content of main pending order page
        let blur = document.getElementById("orders") ;
        // chief variable is storing the content of chief registration page
        let chief = document.getElementById("acheif") ;
        // stuff variable is storing the content of stuff registration page 
        let stuff = document.getElementById("astuffs") ;

        let food = document.getElementById("addfood") ;

        let up = document.getElementById("update") ;

        let chf = document.getElementById("chif") ;

        let ckj = document.getElementById("employee") ;

        let k = document.getElementById("assi") ;
        // by using the variables we will implement the popup feature.
        
        // when the manager will press the "Add your chief" button this function will execute
        // our main job is when the popup container will arrive the background will be blur
        

        // same above work to do when adding stuffs
        
        function activee() {
            blur.classList.add ("blur") ;
            chief.classList.add("active") ;
        }

        function addfood() {
            blur.classList.add ('blur') ;
            food.classList.add('active') ;
        }

        function update() {
            blur.classList.add ('blur') ;
            up.classList.add('active') ;
        }

        function getchief() {
            blur.classList.add('blur') ;
            chf.classList.add('active') ;
        }

        function getWorkers() {
            blur.classList.add("blur") ;
            ckj.classList.add("active") ;
        }


       
    </script>
</body>
</html>