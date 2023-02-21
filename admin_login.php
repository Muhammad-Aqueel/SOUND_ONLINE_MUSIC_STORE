<?php
session_start();
require("config.php");
if(isset($_SESSION['admin_email'])){
    header("location:admin.php");
}
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
    <!----Main Wrapper Start---->
    <div class="ms_main_wrapper ms_profile">
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
                        <li><a href="admin.php"  title="Discover">
						<span class="nav_icon">
							<span class="icon icon_discover"></span>
						</span>
						<span class="nav_text">
							discover
						</span>
						</a>
                        </li>
                        <li><a href="album.php" title="Albums">
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
                        <li><a href="songs.php"  title="Songs">
						<span class="nav_icon">
							<span class="icon icon_music"></span>
						</span>
						<span class="nav_text">
							songs
						</span>
						</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!---Main Content Start--->
        <div class="padder_top80" style="padding-top: 0px !important;">
            <!---Header--->
			
            <!----Edit Profile Wrapper Start---->
            <div class="ms_profile_wrapper">
                <div class="ms_profile_box">
                    <h1>Login / Sign In</h1>
                    <label id="lsr" style="opacity:0;color: rgb(231, 20, 219); font-size: large;">Login Fail</label>
                    <div class="ms_pro_form">
                        <form id="login_form" method="post">
                            <div class="form-group" style="position: relative;">
                                <label>Your Email *</label>
                                    <input id = "log_email" type="email" placeholder="Enter Your Email" class="form-control" name="email" required>
                                    <span class="form_icon" style="position: absolute;top: 35px;left: 96%;">
                                        <i class="fa_iconenvelope form-envelope" aria-hidden="true"></i>
                                    </span>
                            </div>
                            <div class="form-group" style="position: relative;">
                                    <label>Your Password *</label>
                                    <input id = "log_password" type="password" placeholder="Enter Password" class="form-control" name="password" required>
                                    <span id = "passicon" class="form_icon" style="position: absolute;top: 35px;left: 96%;" onclick="showpass(this.id)">
                            <i class="fa_iconlock form-lock" aria-hidden="true"></i>
                            </span>
                                </div>
                            <a href="javascript:{}" class="ms_btna" id="login_btn" onclick="login_admin()" name="login">login now</a>
                        </form>
                    </div>
                </div>
            </div>
            <!----Main div close---->
        </div>
        <!----Footer Start---->
        <?php
          include("footer.php");
        ?>
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
    <script>
        le = document.getElementById("log_email");
        lp = document.getElementById("log_password");
        le.addEventListener("keyup", ({key}) => {
            if (key === "Enter") {
                login_admin();
            }
        });
        lp.addEventListener("keyup", ({key}) => {
            if (key === "Enter") {
                login_admin();
            }
        });

        function showpass(id) {
            var iconchk = document.getElementById(id).children[0].style.backgroundImage;
            if (iconchk == 'url("./images/svg/lock.svg")' || iconchk == 'url("../images/svg/lock.svg")' || iconchk == "") {
                document.getElementById(id).children[0].style.backgroundImage = "url('./images/svg/unlock.svg')";
                document.getElementById(id).parentNode.children[1].setAttribute("type", "text");
            } else {
                document.getElementById(id).children[0].style.backgroundImage = "url('./images/svg/lock.svg')";
                document.getElementById(id).parentNode.children[1].setAttribute("type", "password");
            }
        }

        function login_admin(){
            lemail = document.getElementById('log_email').value;
            lpassword = document.getElementById('log_password').value;

            let formData = new FormData();
            formData.append('LEmail', lemail);
            formData.append('LPassword', lpassword);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_login_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById('log_email').value = "";
                        document.getElementById('log_password').value = "";
                        window.location="admin.php";
                    }else{
                        document.getElementById("lsr").innerHTML = data.msg;
                        document.getElementById("lsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("lsr").style.transition = "opacity 2s";
                            document.getElementById("lsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("lsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>