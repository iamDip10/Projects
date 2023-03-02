<?php
    session_start() ;
    unset ($_SESSION['uname']) ;
    unset ($_SESSION['mname']) ;
    unset ($_SESSION['name']) ;
    header('location: index.html') ;
?>