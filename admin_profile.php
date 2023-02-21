<?php
    session_start();
    require("config.php");
    if(isset($_SESSION['admin_email'])){

    }else{
        header("location:./admin.php");
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
                        <li><a href="admin.php"  title="Discover">
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
        <div class="padder_top80">
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
            <!----Edit Profile Wrapper Start---->
            <div class="ms_profile_wrapper" style="padding-left: 0px;">
                <h1>Edit Profile</h1>
                <div class="ms_profile_box">
                    <div class="ms_pro_img">
                        <?php
                        $sql="SELECT * FROM `admin` WHERE `Email`='" . $_SESSION['admin_email'] . "'";
                        $result=mysqli_query($link,$sql);
                        $row = mysqli_fetch_assoc($result);
                        echo '
                    <div class="ms_pro_form">
                        <div class="form-group">
                            <label>Your Name</label>';
                            echo '<input type="text" class="form-control rinput" name="Name" id="Name" value="'.$row['Name'].'" disabled>
                        </div>
                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" class="form-control rinput" name="Email" id="Email" value="'.$row['Email'].'" disabled>
                        </div>
                        <div class="form-group">
                            <label>Your Password *</label>
                            <input type="password" placeholder="Enter Password" class="form-control rinput" name="Password" id="Password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password *</label>
                            <input type="password" placeholder="Confirm Password" class="form-control rinput" name="CPassword" id="CPassword" required>';
                            ?>
                        </div>

                        <h1 id="sr" style="opacity: 0; color: rgb(231, 20, 219); font-size: large; transition: opacity 0s ease 0s;margin-bottom: 0px;">Edit Profile</h1>
                        <div class="pro-form-btn text-center marger_top15">
                            <a href="javascript:{};" class="ms_btn" onclick="reg_user()">save</a>
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
    <script>
        rinput = document.querySelectorAll('.rinput');
        rinput.forEach(function(e) {
            e.addEventListener("keyup", ({key}) => {
                if (key === "Enter") {
                    reg_user();
                }
            });
        });

        function reg_user() {
            var ok = 0;

            var password = document.getElementById('Password').value;
            var cpassword = document.getElementById('CPassword').value;
            if (!(password == cpassword)) {
                ok++;
                document.getElementById('Password').style.border = "3px solid #22bed7";
                document.getElementById('Password').style.backgroundColor = "#bdf6ff";
                document.getElementById('CPassword').style.border = "3px solid #22bed7";
                document.getElementById('CPassword').style.backgroundColor = "#bdf6ff";
            } else if(password.length > 20 ){
                ok++;
                document.getElementById('Password').style.border = "3px solid #22bed7";
                document.getElementById('Password').style.backgroundColor = "#bdf6ff";
            }

            if(password == "" || cpassword == ""){
                ok++;
            }

            if(ok == 0) {
                let formData = new FormData();
                formData.append('Password', password);
                let xhr = new XMLHttpRequest();
                xhr.open("POST", 'pass_admin.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const data = JSON.parse(this.responseText);
                        if(data.success === 1) {
                            document.getElementById("sr").innerHTML = data.msg;
                            document.getElementById("sr").style.opacity = "1";
                            const myTimeout = setTimeout(srvis, 1500);

                            function srvis() {
                                document.getElementById("sr").style.transition = "opacity 2s";
                                document.getElementById("sr").style.opacity = "0";
                                const myTimeout = setTimeout(srhid, 1000);
                                function srhid()
                                {document.getElementById("sr").style.transition = "opacity 0s";}
                            }
                            document.getElementById('Password').value = "";
                            document.getElementById('CPassword').value = "";
                            document.querySelector('#photo').value = "";
                            document.getElementsByClassName("inf__hint")[0].innerHTML = "or drag and drop your photo here";
                        }else{
                            document.getElementById("sr").innerHTML = data.msg;
                            document.getElementById("sr").style.opacity = "1";
                            const myTimeout = setTimeout(srvis, 1500);

                            function srvis() {
                                document.getElementById("sr").style.transition = "opacity 2s";
                                document.getElementById("sr").style.opacity = "0";
                                const myTimeout = setTimeout(srhid, 1000);
                                function srhid()
                                {document.getElementById("sr").style.transition = "opacity 0s";}
                            }
                        }
                    }
                };
                xhr.send(formData);
            }
        }
    </script>
</body>

</html>