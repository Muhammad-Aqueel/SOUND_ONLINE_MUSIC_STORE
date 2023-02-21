<?php
// Include config file
require "config.php";
 
// Define variables and initialize with empty values
$name = $email = $pass = $contact = $address = $gender = $photo = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $path = 'images/users/';

    $name = trim($_POST['Name']);

    $email = trim($_POST['Email']);
    $sql="SELECT * FROM `users` WHERE `Email`='$email'";
    $result=mysqli_query($link,$sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => 0, 'msg' => "Email Already Exists."]);
        return (false);
    }
    
    $pass = $_POST['Password'];
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    // password_verify($password, $hashed_password);
    
    $contact = trim($_POST['Contact']);
    
    $address = trim($_POST['Address']);

    $gender = $_POST['gender'];

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
        $photo = preg_replace($pattern, '_', $email) . "." . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    }else{
        $photo = $_POST['photo'];
    }
    
    $sql="INSERT INTO `users`(`Name`, `Email`, `Password`, `Contact`, `Address`, `Gender`, `photo`) VALUES ('$name','$email','$pass','$contact','$address','$gender','$photo')";
    
    $result=mysqli_query($link,$sql);
    if($result){
        if(isset($_FILES['photo'])){
            move_uploaded_file($_FILES['photo']['tmp_name'], $path . $photo);
        }
        echo json_encode(['success' => 1, 'msg' => "Successfully Registered."]);
        return (true);
    }else{
        echo json_encode(['success' => 0, 'msg' => "Registeration Failed."]);
        return (false);
    }
    
}else{
    header("location:index.php");
}
?>