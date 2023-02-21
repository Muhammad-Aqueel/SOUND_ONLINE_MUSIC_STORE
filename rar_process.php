<?php
session_start();
require("config.php");

function fnt_rating($vsid,$link){
    $sqlc = "SELECT `Rate` FROM `ratings` WHERE `VS_ID` = " . $vsid;
    $resultc=mysqli_query($link,$sqlc);
    $t_rating = 0;
    foreach($resultc as $rowc){
        $t_rating += $rowc['Rate'];
        $t_rating = ($t_rating/(mysqli_num_rows($resultc)*5))*5;
    }

    return ($t_rating);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['aRate'])){
        $rate = $_POST['aRate'];
        $comment = $_POST['aComment'];
        $email = $_SESSION['user_email'];
        $vsid = $_POST['avsid'];
        $sql = "SELECT `User_ID` FROM `users` WHERE `Email`= '$email'";
        $result=mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);
        $usid = $row['User_ID'];
        $sql = "SELECT * FROM `ratings` WHERE `User_ID` = $usid AND `VS_ID` = $vsid";
        $result = mysqli_query($link,$sql);

        if($rate == "" && $comment == ""){
            $usid = $row['User_ID'];
            $sql = "DELETE FROM `ratings` WHERE `User_ID`= $usid AND `VS_ID` = $vsid";
            $result=mysqli_query($link,$sql);
            $t_rating = fnt_rating($vsid,$link);
            echo json_encode(['success' => 1, 't_rating' => $t_rating]);
            return (true); 
        }
       
        if(mysqli_num_rows($result) > 0){
            // Update
            $usid = $row['User_ID'];
            if($rate == ""){
                $sql = "UPDATE `ratings` SET `Rate`= NULL,`Review`='$comment' WHERE `User_ID`=$usid AND `VS_ID`=$vsid";
            }else{
                $sql = "UPDATE `ratings` SET `Rate`=$rate,`Review`='$comment' WHERE `User_ID`=$usid AND `VS_ID`=$vsid";
            }
            $result = mysqli_query($link,$sql);
            if($result){
                $t_rating = fnt_rating($vsid,$link);
                echo json_encode(['success' => 1, 't_rating' => $t_rating]);
                return (true);
            }
        }else{         
            // Add
            $usid = $row['User_ID'];
            if($rate == ""){
                $sql = "INSERT INTO `ratings`(`User_ID`, `VS_ID`,`Rate`, `Review`) VALUES ($usid,$vsid,NULL,'$comment')";
            }else{
                $sql = "INSERT INTO `ratings`(`User_ID`, `VS_ID`, `Rate`, `Review`) VALUES ($usid,$vsid,$rate,'$comment')";
            }
            $result = mysqli_query($link,$sql);
            if($result){
                $t_rating = fnt_rating($vsid,$link);
                echo json_encode(['success' => 1, 't_rating' => $t_rating]);
                return (true);
            }else{
                $t_rating = fnt_rating($vsid,$link);
                echo json_encode(['success' => 1, 't_rating' => $t_rating]);
                return (true);
            }
        }
    }
}else{
    header("location:index.php");
}
?>