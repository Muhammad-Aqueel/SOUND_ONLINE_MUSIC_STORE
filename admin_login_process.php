<?php
session_start();
require("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION['admin_email'])){
        
    }else{
        $admin_email = $_POST['LEmail'];
        $admin_password = $_POST['LPassword'];
        
        $sql="SELECT * FROM `admin` WHERE `Email`='$admin_email'";
        
        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($admin_password, $row['Password'])){
                $_SESSION['admin_email']=$admin_email;
                $_SESSION['admin_name']=substr($row['Name'],0,1);
                echo json_encode(['success' => 1, 'msg' => "Login Successful"]);
                return (true);
            }else{
                echo json_encode(['success' => 0, 'msg' => "Login Fail"]);
                unset($_POST['LEmail']);
                unset($_POST['LPassword']);
                return (false);
            }
        }else{
            echo json_encode(['success' => 0, 'msg' => "Login Fail"]);
            unset($_POST['LEmail']);
            unset($_POST['LPassword']);
            return (false);
        }
    }
}else{
    header("location:admin.php");
}
?>