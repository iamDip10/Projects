

<!-- ------------------------------------------------- PART OF HIRA ------------------------------------------- -->

<!-- Full Backend of adding chief and stuffs -->

<?php
    session_start() ;
    // connecting to database
    $conn = new mysqli('localhost', 'root', '', 'rms') ;

    // checking if the button of submit is clicked
    // here if the button of submit clicked it will set the value of isset() fucntion true
    // if not clicked then it will be not set the value of isset() function become false
    // here the 'submt' is getting by POST method of previous page through 'name' attribute 
    if (isset($_POST['submt'])) {
        // a simple query that will insert the username and password into chief table in database
        // here $_POST['uname'] and $_POST['pass'] are getting from previous page by method= 'post' and 'name' attribute
        $hi = "insert into chief(name, pass, res_id) values ('".$_POST['uname']."','".$_POST['pass']."','".$_GET['id']."')" ;
        // running the query
        //here we dont need to fetch result as the query will not return anything
        $t = $conn->query($hi) ;
        // the line below will go to main dashboard of manager
        header('location: managerdash.php?id='.$_GET['id']."&name=".$_GET['name']) ;
    }

    // End of add chief


    
    else if (isset($_POST['submiit'])) {
        $hi = "insert into employee(emp_name, pass, res_id) values ('".$_POST['uname_']."','".$_POST['pass_']."','".$_GET['id']."')" ;
        $t = $conn->query($hi) ;
        header('location: managerdash.php?id='.$_GET['id']."&name=".$_GET['name']) ;
    }
    
    else if (isset($_POST['food'])) {
        
        $hr = "insert into food(food_name, food_price, food_desc, res_id, f_image) values ('".$_POST['fname']."','".$_POST['price']."','".$_POST['descc']."','".$_GET['id']."','".$_POST['image']."')" ;
        $jj = $conn->query($hr) ;
        header('location: managerdash.php?id='.$_GET['id']."&name=".$_GET['name']) ;       

    }
    
    else if (isset($_POST['updat'])) {
        $hh = "update res_manager set manager_name = '".$_POST['m_name']."', contact_no = '".$_POST['con']."', resm_name = '".$_POST['r_name']."', man_pass = '".$_POST['u_pa']."', us_name = '".$_POST['u_na']."' where us_name = '".$_GET['name']."'" ;
        $gj = $conn->query($hh) ;
        header('location: managerdash.php?id='.$_GET['id']."&name=".$_POST['u_na'] );
    }
?>