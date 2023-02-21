<?php
session_start();
// Include config file
require "config.php";
 
// Define variables and initialize with empty values
$pass = $contact = $address = $gender = $photo = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $path = 'images/users/';

    $pass = $_POST['Password'];
    if($_POST['Password'] == ""){
        $sql="SELECT `Password` FROM `users` WHERE `Email`='" . $_SESSION['user_email'] . "'";
        $result=mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);
        $pass = $row['Password'];
    }else{$pass = password_hash($pass, PASSWORD_BCRYPT);}

    if(isset($_FILES['photo'])){
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check == false) {
            echo json_encode(['success' => 0, 'msg' => "Only Image File Allowed."]);
            return (false);
        }

        // Check file size
        if ($_FILES["photo"]["size"] > 1000000) {
            echo json_encode(['success' => 0, 'msg' => "Image size must be under 1MB."]);
            return (false);
        }

        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo json_encode(['success' => 0, 'msg' => "Unknown Image Format."]);
            return (false);
        }
        // $photo = $_FILES['photo']['name'];
        $pattern = '/[@.]/';
        $photo = preg_replace($pattern, '_', $_SESSION['user_email']) . "." . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $sql="SELECT photo FROM `users` WHERE `Email`='" . $_SESSION['user_email'] . "'";
        $result=mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row['photo'] != "0_female_avatar.png" || $row['photo'] != "1_male_avatar.png")
            {unlink($path . $row['photo']);}
    }else{
        if($_POST['photo'] == ""){
            $sql="SELECT photo FROM `users` WHERE `Email`='" . $_SESSION['user_email'] . "'";
            $result=mysqli_query($link,$sql);
            $row = mysqli_fetch_assoc($result);
            $photo = $row['photo'];
        }
    }
   
    $sql="UPDATE `users` SET `Password`='".$pass."',`photo`='". $photo ."' WHERE `Email` = '" . $_SESSION['user_email'] . "'";
    
    $result=mysqli_query($link,$sql);
    if($result){
        if(isset($_FILES['photo'])){
            move_uploaded_file($_FILES['photo']['tmp_name'], $path . $photo);
        }
        $photo = '<img id = "profile_pic" src="images/users/'. $photo .'" alt="" class="img-fluid">';
        echo json_encode(['success' => 1, 'msg' => "Successfully Update.", 'photo' => $photo]);
        return (true);
    }else{
        echo json_encode(['success' => 0, 'msg' => "Updation Failed."]);
        return (false);
    }
    
}else{
    header("location:index.php");
}

?>