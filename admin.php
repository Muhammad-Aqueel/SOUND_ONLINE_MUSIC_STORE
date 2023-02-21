<?php
    session_start();
    require("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<!-- Begin Head -->

<head>
    <title>Sound - Music Store</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Music">
    <meta name="keywords" content="">
    <meta name="author" content="kamleshyadav">
    <meta name="MobileOptimized" content="320">
    <!--Start Style -->
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="js/plugins/swiper/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="js/plugins/nice_select/nice-select.css">
    <link rel="stylesheet" type="text/css" href="js/plugins/player/volume.css">
	<link rel="stylesheet" type="text/css" href="js/plugins/scroll/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
</head>

<body>
	<!----Loader Start---->
	<div class="ms_loader">
		<div class="wrap">
		  <img src="images/loader.gif" alt="">
		</div>
	</div>
    <!----Main Wrapper Start---->
    <div class="ms_main_wrapper">
        <!---Side Menu Start--->
        <div class="ms_sidemenu_wrapper">
            <div class="ms_nav_close">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </div>
            <div class="ms_sidemenu_inner">
                <div class="ms_logo_inner">
                    <div class="ms_logo">
                        <a href="admin.php"><img src="images/logo.png" alt="" class="img-fluid"/></a>
                    </div>
                    <div class="ms_logo_open">
                        <a href="admin.php"><img src="images/open_logo.png" alt="" class="img-fluid"/></a>
                    </div>
                </div>
                <div class="ms_nav_wrapper">
                    <ul>
                        <li><a href="admin.php" class="active" title="Discover">
						<span class="nav_icon">
							<span class="icon icon_discover"></span>
						</span>
						<span class="nav_text">
							discover
						</span>
						</a>
                        </li>
                        <?php
                        if((isset($_SESSION['admin_email']))){
                            echo '<li><a href="admin_controls.php" title="Data">
                            <span class="nav_icon">
                                <span class="icon icon_c_playlist"></span>
                            </span>
                            <span class="nav_text">
                                data
                            </span>
                            </a>
                            </li>';
                        }else{
                            echo '<li><a href="album.php" title="Albums">
                            <span class="nav_icon">
                                <span class="icon icon_albums"></span>
                            </span>
                            <span class="nav_text">
                                albums
                            </span>
                            </a>
                            </li>
                            <li><a href="artist.php" title="Artists">
                            <span class="nav_icon">
                                <span class="icon icon_artists"></span>
                            </span>
                            <span class="nav_text">
                                artists
                            </span>
                            </a>
                            </li>
                            <li><a href="genres.php" title="Genres">
                            <span class="nav_icon">
                                <span class="icon icon_genres"></span>
                            </span>
                            <span class="nav_text">
                                genres
                            </span>
                            </a>
                            </li>
                            <li><a href="songs.php" title="Songs">
                            <span class="nav_icon">
                                <span class="icon icon_music"></span>
                            </span>
                            <span class="nav_text">
                                songs
                            </span>
                            </a>
                            </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!---Main Content Start--->
        <div class="ms_content_wrapper padder_top80">
            <!---Header--->
            <div class="ms_header">
                <div class="ms_top_left">

                </div>
                <div class="ms_top_right">
                    <div class="ms_top_btn">
                        <?php if(!(isset($_SESSION['admin_email'])))
                        {
                            echo '<a href="./admin_login.php" class="ms_btn login_btn"><span>login</span></a>';
                        }else{
                            echo '<a href="javascript:;" class="ms_admin_name">Hello<span class="ms_pro_name" style="font-size: 12px;">' . $_SESSION['admin_name'] .'</span></a>
                            <ul class="pro_dropdown_menu">
                                <li><a href="admin_profile.php">Profile</a></li>
                                
                                <li><a href="./admin_logout.php">Logout</a></li>
                            </ul>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!---Banner--->
            <div class="ms-banner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="ms_banner_img">
                                <img src="images/banner.png" alt="" class="img-fluid">
                            </div>
                            <div class="ms_banner_text">
                                <h1>This Month’s</h1>
                                <h1 class="ms_color">Record Breaking Albums !</h1>
                                <p>Dream your moments, Until I Met You, Gimme Some Courage, Dark Alley, One More Of A Stranger, Endless Things, The Heartbeat Stops, Walking Promises, Desired Games and many more...</p>
                                <div class="ms_banner_btn">
                                    <a href="songs.php" class="ms_btn">Listen Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Recently Played Music--->
            <div class="ms_rcnt_slider">
                <div class="ms_heading">
                    <h1>Songs</h1>
                    <span class="veiw_all"><a href="songs.php">view more</a></span>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $sql = "SELECT * FROM `videos_songs`";
                        $result = mysqli_query($link,$sql);
                        foreach ($result as $row){
                        echo '<div class="swiper-slide">
                            <div class="ms_rcnt_box">
                            <a href="./song_single.php?vs_id='. $row['VS_ID'] .'">
                                <div class="ms_rcnt_box_img">
                                    <img src="images/covers/'.$row['photo'].'" alt="">
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                       
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div>
                                    </div>
                                </div></a>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="song_single.php?vs_id='.$row['VS_ID'].'">'.$row['Title'].'</a></h3>
                                    <!--<p>Ava Cornish & Brian Hill</p>-->
                                </div>
                            </div>
                        </div>';}
                        ?>
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next slider_nav_next"></div>
                <div class="swiper-button-prev slider_nav_prev"></div>
            </div>
            <!---Weekly Top 15--->
            <div class="ms_weekly_wrapper">
                <div class="ms_weekly_inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ms_heading">
                                <h1>top 15 Songs</h1>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 padding_right40">
                        <?php
                                    $sql = "SELECT * FROM `videos_songs`";
                                    $result = mysqli_query($link,$sql);
                                    $cout = 1;
                                    foreach ($result as $row){
                                        echo '<div class="ms_weekly_box"><div class="weekly_left">';
                                        if($cout < 10){
                                            echo '<span class="w_top_no">0' . $cout++ . '</span>';
                                        }else{
                                            echo '<span class="w_top_no">' . $cout++ . '</span>';
                                        }
                                        echo '<div class="w_top_song">
                                            <div class="w_tp_song_img">
                                                <img src="images/covers/'.$row['photo'].'" alt="">
                                                <div class="ms_song_overlay">
                                                </div><a href="song_single.php?vs_id=' . $row['VS_ID'] . '">
                                                <div class="ms_play_icon">
                                                    <img src="images/svg/play.svg" alt="">
                                                </div></a>
                                            </div>
                                            <div class="w_tp_song_name">
                                                <h3><a href="song_single.php?vs_id=' . $row['VS_ID'] . '">' . $row['Title'] . '</a></h3>';
                                        $sql_art = 'SELECT videos_songs.VS_ID,videos_Songs.Title,artist.Artist_ID,artist.Name FROM videos_songs 
                                        LEFT JOIN song_artist ON videos_songs.VS_ID = song_artist.VS_ID 
                                        LEFT JOIN artist ON artist.Artist_ID = song_artist.Artist_ID WHERE videos_songs.VS_ID = ' . $row["VS_ID"];
                                        $result_art = mysqli_query($link,$sql_art);
                                        $artists = "";
                                        foreach($result_art as $row_art){
                                            $artists .= '<a href="artist_single.php?artist_id='. $row_art['Artist_ID'].'">' . $row_art['Name'] . "</a>,";
                                        }
                                        if (substr($artists,-1) == ",") {
                                            $artists = substr($artists,0,-1);
                                        }
                                        $artists = str_replace(",",", ",$artists);
                                        echo '<p class="singer_name">'.$artists.'</p>';
                                                // <p>Ava Cornish</p>
                                                echo '</div>
                                                </div>
                                            </div></div>';
                                    }
                                    ?>
                            <div class="ms_divider"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Featured Artists Music--->
            <div class="ms_featured_slider padder_top20">
                <div class="ms_heading">
                    <h1>Featured Artists</h1>
                </div>
                <div class="ms_relative_inner">
                    <div class="ms_feature_slider swiper-container">
                        <div class="swiper-wrapper">
                        <?php
                            $sql = "SELECT * FROM artist WHERE artist.Artist_ID IN (SELECT song_artist.Artist_ID FROM song_artist)";
                            $result = mysqli_query($link,$sql);
                            foreach ($result as $row){
                                $rnd_num = rand(0,1);
                                if($rnd_num == 1){
                            echo '<div class="swiper-slide">
                                <div class="ms_rcnt_box">
                                    <div class="ms_rcnt_box_img">
                                    <a href="artist_single.php?artist_id='.$row['Artist_ID'].'">
                                        <img src="images/artist/artist.jpg" alt="">
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
                        }
                        ?>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next1 slider_nav_next"></div>
                    <div class="swiper-button-prev1 slider_nav_prev"></div>
                </div>
            </div>
            <!----Featured Albumn Section Start---->
            <div class="ms_fea_album_slider padder_top10 ">
                <div class="ms_heading">
                    <h1>Featured Albums</h1>
                </div>
                <div class="ms_album_slider swiper-container">
                    <div class="swiper-wrapper">
                            <?php
                            $sql = "SELECT * FROM album WHERE album.Album_ID IN (SELECT videos_songs.Album_ID FROM videos_songs)";
                            $result = mysqli_query($link,$sql);
                            foreach ($result as $row){
                                $rnd_num = rand(0,1);
                                if($rnd_num == 1){
                                    echo '<div class="swiper-slide">
                                        <div class="ms_rcnt_box">
                                            <a href="./album_single.php?album_id='. $row['Album_ID'] .'">
                                                <div class="ms_rcnt_box_img">
                                                    <img src="images/album/album.jpg" alt="">
                                                    <div class="ms_main_overlay">
                                                        <div class="ms_box_overlay"></div>
                                                        <!-- <div class="ms_more_icon">
                                                            <img src="images/svg/more.svg" alt="">
                                                        </div>
                                                        <ul class="more_option">
                                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_fav"></span></span>Add To Favourites</a></li>
                                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_queue"></span></span>Add To Queue</a></li>
                                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_dwn"></span></span>Download Now</a></li>
                                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_playlst"></span></span>Add To Playlist</a></li>
                                                            <li><a href="#"><span class="opt_icon"><span class="icon icon_share"></span></span>Share</a></li>
                                                        </ul> -->
                                                        <div class="ms_play_icon">
                                                            <img src="images/svg/play.svg" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="ms_rcnt_box_text">
                                                <h3><a href="album_single.php?album_id='.$row['Album_ID'].'">'.$row['Name'].'</a></h3>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            ?>
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next3 slider_nav_next"></div>
                <div class="swiper-button-prev3 slider_nav_prev"></div>
            </div>
            <!----Top Genres Section Start---->
            <div class="ms_genres_wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ms_heading">
                            <h1>Top Genres</h1>
                            <span class="veiw_all"><a href="genres.php">view more</a></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <img src="images/genrs/img1.jpg" alt="" class="img-fluid" />
                            <div class="ms_main_overlay"><a href="genres_single.php">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <img src="images/svg/play.svg" alt="">
                                </div></a>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="genres_single.php">romantic</a></span>
                                    <span class="ovrly_text2"><a href="genres_single.php">view song</a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="#">romantic</a></span>
                                    <span class="ovrly_text2"><a href="#">view song</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ms_genres_box">
                                    <img src="images/genrs/img2.jpg" alt="" class="img-fluid" />
                                    <div class="ms_main_overlay"><a href="genres_single.php#classical">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div></a>
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="genres_single.php#classical">Classical</a></span>
                                        </div>
                                    </div>
                                    <div class="ms_box_overlay_on">
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="#">Classical</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="ms_genres_box">
                                    <img src="images/genrs/img3.jpg" alt="" class="img-fluid" />
                                    <div class="ms_main_overlay"><a href="genres_single.php#hip_hop">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div></a>
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="genres_single.php#hip_hop">hip hop</a></span>
                                        </div>
                                    </div>
                                    <div class="ms_box_overlay_on">
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="#">hip hop</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="ms_genres_box">
                                    <img src="images/genrs/img5.jpg" alt="" class="img-fluid" />
                                    <div class="ms_main_overlay"><a href="genres_single.php#dancing">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div></a>
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="genres_single.php#dancing">dancing</a></span>
                                        </div>
                                    </div>
                                    <div class="ms_box_overlay_on">
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="#">dancing</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ms_genres_box">
                                    <img src="images/genrs/img6.jpg" alt="" class="img-fluid" />
                                    <div class="ms_main_overlay"><a href="genres_single.php#dancing">
                                        <div class="ms_box_overlay"></div>
                                        <div class="ms_play_icon">
                                            <img src="images/svg/play.svg" alt="">
                                        </div></a>
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="genres_single.php#dancing">EDM</a></span>
                                        </div>
                                    </div>
                                    <div class="ms_box_overlay_on">
                                        <div class="ovrly_text_div">
                                            <span class="ovrly_text1"><a href="#">EDM</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ms_genres_box">
                            <img src="images/genrs/img4.jpg" alt="" class="img-fluid" />
                            <div class="ms_main_overlay"><a href="genres_single.php#rock">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <img src="images/svg/play.svg" alt="">
                                </div></a>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="genres_single.php#rock">rock</a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="#">rock</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!----Main div close---->
        </div>
        <!----Footer Start---->
        <?php
          include("footer.php");
        ?>

            <!--main div-->
        </div>
    </div>
		
    <!--Main js file Style-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plugins/swiper/js/swiper.min.js"></script>
    <script type="text/javascript" src="js/plugins/player/jplayer.playlist.min.js"></script>
    <script type="text/javascript" src="js/plugins/player/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="js/plugins/player/audio-player.js"></script>
    <script type="text/javascript" src="js/plugins/player/volume.js"></script>
    <script type="text/javascript" src="js/plugins/nice_select/jquery.nice-select.min.js"></script>
	<script type="text/javascript" src="js/plugins/scroll/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/file_input.js"></script>
</body>
</html>