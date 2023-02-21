<?php 
    session_start();
    // if(isset($_SESSION['user_email'])){
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        // session_unset();
        // session_destroy();
        if(isset($_GET["url"])){
            $url = $_GET["url"];
            $vs_id = $_GET['vs_id'];
            if($url == "song_single.php"){
                header("location:$url?vs_id=".$vs_id);
            }else{
                header("location:$url");
            }
        }else{
            header("location:index.php");
        }
    // }
?>