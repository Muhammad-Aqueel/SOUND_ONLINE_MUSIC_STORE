<?php
session_start();
require("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['Song_Keyword'])){
        $keyword = $_POST['Song_Keyword'];
        $def_data_head = '<div class="col-lg-12">
                    <div class="ms_heading">
                        <h1>Songs</h1>
                    </div>
                </div>';
        $def_data = "";
        if(empty($keyword)){
            $sql="SELECT * FROM `videos_songs`";
        }else{
            $sql="SELECT * FROM `videos_songs` WHERE `Title` LIKE '%" . $keyword . "%' ";
        }
        $result = mysqli_query($link,$sql);
        foreach($result as $row){
            $def_data .= '<div class="col-lg-2 col-md-6">
                    <div class="ms_rcnt_box marger_bottom30">
                        <a href="./song_single.php?vs_id='. $row['VS_ID'] .'">
                            <div class="ms_rcnt_box_img">
                                <img src="images/covers/'. $row['photo'] . '" alt="" class="img-fluid">
                                <div class="ms_main_overlay">
                                    <div class="ms_box_overlay"></div>
                                    <div class="ms_play_icon">
                                        <img src="images/svg/play.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="ms_rcnt_box_text">
                            <h3><a href="./song_single.php?vs_id='. $row['VS_ID'] .'">'. $row['Title'] .'</a></h3>
                        </div>
                    </div>
                </div>';
        }
        echo json_encode(['success' => 1, 'result' => $def_data_head . $def_data]);
        return (true);
    }

    if(isset($_POST['Artist_Keyword'])){
        $keyword = $_POST['Artist_Keyword'];
        $def_data_head = '<div class="col-lg-12">
                    <div class="ms_heading">
                        <h1>Artists</h1>
                    </div>
                </div>';
        $def_data = "";
        if(empty($keyword)){
            $sql="SELECT * FROM artist WHERE artist.Artist_ID IN (SELECT song_artist.Artist_ID FROM song_artist)";
        }else{
            $sql="SELECT * FROM artist WHERE artist.Name LIKE '%" . $keyword . "%' AND artist.Artist_ID IN (SELECT song_artist.Artist_ID FROM song_artist)";
        }
        $result = mysqli_query($link,$sql);
        foreach($result as $row){
            $def_data .= '<div class="col-lg-2 col-md-6">
                <div class="ms_rcnt_box marger_bottom30">
                    <div class="ms_rcnt_box_img">
                    <a href="artist_single.php?artist_id='.$row['Artist_ID'].'">
                        <img src="images/music/r_music1.jpg" alt="" class="img-fluid">
                        <div class="ms_main_overlay">
                            <div class="ms_box_overlay"></div>
                            
                            <div class="ms_play_icon">
                                <img src="images/svg/play.svg" alt="">
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="ms_rcnt_box_text">
                        <h3><a href="artist_single.php?artist_id='.$row['Artist_ID'].'">'.$row['Name'].'</a></h3>
                    </div>
                </div>
            </div>';
        }
        echo json_encode(['success' => 1, 'result' => $def_data_head . $def_data]);
        return (true);
    }
}else{
    header("location:index.php");
}

?>
