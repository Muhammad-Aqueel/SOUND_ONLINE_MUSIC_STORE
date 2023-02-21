<?php 
    session_start();
    // if(isset($_SESSION['admin_email'])){
        unset($_SESSION['admin_email']);
        // session_unset();
        // session_destroy();
        header("location:admin.php");
    // }
?>