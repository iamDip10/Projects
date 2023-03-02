<?php

    session_start() ;
    if (isset($_POST['reg_page'])) {
        $name = $_POST['name'] ;
        $phone_number = $_POST['phnumber'] ;
        $address = $_POST['cusaddr'] ;
        $password = $_POST['pass'] ;
        $una = $_POST['u_name'] ;
        
        $conn = new mysqli ('localhost', 'root', '', 'rms') ;
        if ($conn->connect_error) {
            die ('connection failed : ' .$conn->connect_error) ;
        }else{
            
            $sql = "insert into customer(cus_name, phone_number, cus_id, cus_address, cus_password)
            values ('".$name."','".$phone_number."','".$id."','".$address."','".$password."')" ;

            if ($conn->query ($sql) == TRUE) {
                header ("location: login.html") ;
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close() ;
        }
    }

    if (isset($_POST['reg_page_m'])) {
        $res_name = $_POST['name_r'] ;
        $man_name = $_POST['name_e'] ;
        $res_add = $_POST['name_add'] ;
        $rating = 5.0 ;
        $desc =  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti enim, veniam laborum dolores unde, expedita sit nam perspiciatis eaque veritatis, voluptatibus accusantium. Voluptatibus ullam accusantium, tempore corrupti nulla dolorem animi!" ;
        $con = $_POST['contact'] ;
        $password = $_POST['pass_m'] ;
        $im = "download.jpg" ;
        $idd = 0 ;
        $uname = $_POST['uname'] ;
        
        $conn = new mysqli ('localhost', 'root', '', 'rms') ;
        if ($conn->connect_error) {
            die ('connection failed : ' .$conn->connect_error) ;
        }else{
            
            
            $sqll = "insert into res_manager(manager_name, contact_no, resm_name, man_pass, res_id, us_name)
            values('".$man_name."','".$con."','".$res_name."','".$password."','".$idd."','".$uname."')" ;
            $resltt= $conn->query($sqll) ;
            
            if ($resltt ==TRUE) {

                $ql = "insert into restaurant(res_name, us_name, res_address, rating, descc, image) values('".$res_name."','".$uname."','".$res_add."','".$rating."','".$desc."','".$im."')" ;
                $t = $conn->query($ql) or die ($conn->error) ;
                
                $rrg = "select res_id from restaurant where us_name = '".$uname."'" ;
                $runH = $conn->query($rrg) ;
                $getH = $runH->fetch_assoc() ;

                $qlH = "update res_manager set res_id = '".$getH['res_id']."' where us_name = '".$uname."'";
                $tt = $conn->query($qlH) ;
                header ("location: login.html") ;
            }
            else echo '<span>Duplicate user found!</span>' ;

            $conn->close() ;
        }
    }
    

    //LOGIN

    if (isset($_POST['log_page'])) {
        $user = $_POST['name'] ;
        $pass = $_POST['pass'] ;
        

        $conn = new mysqli ('localhost', 'root', '', 'rms') ;
        if ($conn->connect_error) {
            die ('connection failed : ' .$conn->connect_error) ;
        }else{
            $query = "select * from customer where cus_name ='".$user."' and cus_password ='".$pass."'" ;
            $stm = $conn->query ($query);
            $rres = $stm->fetch_assoc() ;

            if ($stm->num_rows > 0) {
                $_SESSION['uname'] = $rres['cus_id'] ;
                header ("location: userdashboard.php?id=".$rres['cus_id']) ;
                $conn->close() ;
            }
            else {
                echo "logout";
            }
        }
    }

    if (isset($_POST['log_page_m'])) {
        $userr = $_POST['name_m'] ;
        $passs = $_POST['pass_m'] ;
        

        $conn = new mysqli ('localhost', 'root', '', 'rms') ;
        if ($conn->connect_error) {
            die ('connection failed : ' .$conn->connect_error) ;
        }else{
            $query = "select * from res_manager where us_name ='".$userr."' and man_pass ='".$passs."'" ;
            $stm = $conn->query ($query);
            $res = $stm->fetch_assoc() ;

            if ($stm->num_rows > 0) {
                $_SESSION['mname'] = $userr ;
                header ("location: managerdash.php?id=".$res['res_id']."&name=".$userr) ;
                $conn->close() ;
            }
            else {
                echo $stm->num_rows ;
            }
        }
    }

    if (isset($_POST['log_page_c'])) {
        
        $conn = new mysqli ('localhost', 'root', '', 'rms') ;
        if ($conn->connect_error) {
            die ('connection failed : ' .$conn->connect_error) ;
        }else{
            $quer = "select * from chief where name ='".$_POST['name_c']."' and pass ='".$_POST['pass_c']."'" ;
            
            $stmo = $conn->query ($quer);
            $resp = $stmo->fetch_assoc() ;
            $ff = "select us_name from res_manager where res_id = '".$resp['res_id']."'" ;
            $jk = $conn->query($ff) ;
            $fop = $jk->fetch_assoc() ;
            if ($stmo->num_rows > 0) {
                $_SESSION['name'] = $resp['name'] ;
                header ("location: chief.php?name=".$resp['name']."&res_id=".$resp['res_id']."&mname=".$fop['us_name']) ;
                $conn->close() ;
            }
            else {
                echo $stm->num_rows ;
            }
        }
    }


    
?>