<?php
session_start();
// Include config file
require "config.php";

// Define variables and initialize with empty values
$pass = $contact = $address = $gender = $photo = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $pass = $_POST['Password'];
    if($_POST['Password'] == ""){
        $sql="SELECT `Password` FROM `admin` WHERE `Email`='" . $_SESSION['admin_email'] . "'";
        $result=mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);
        $pass = $row['Password'];
    }else{$pass = password_hash($pass, PASSWORD_BCRYPT);}
    $sql="UPDATE `admin` SET `Password`='".$pass."' WHERE `Email` = '" . $_SESSION['admin_email'] . "'";
    $result=mysqli_query($link,$sql);
    if($result){
        echo json_encode(['success' => 1, 'msg' => "Successfully Update."]);
        return (true);
    }else{
        echo json_encode(['success' => 0, 'msg' => "Updation Failed."]);
        return (false);
    }
}else{
    header("location:admin.php");
}



?>