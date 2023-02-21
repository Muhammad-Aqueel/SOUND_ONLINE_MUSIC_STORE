<?php
    session_start();
    require("config.php");
    if(!isset($_GET['artist_id']))
    {header("location:artist.php");}
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
	<!----Loader---->
	<div class="ms_inner_loader">
		<div class="ms_loader">
			<div class="ms_bars">
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
			</div>
		</div>
	</div>
    <!----Main Wrapper Start---->
    <div class="ms_main_wrapper">
        <!---Header--->
        <div class="ms_header">
                <div class="ms_top_left">

                </div>
                <div class="ms_top_right">

                    <div class="ms_top_btn">
                        <?php 
                        if(!(isset($_SESSION['user_email'])))
                        {
                            echo '<a href="javascript:;" class="ms_btn reg_btn" data-toggle="modal" data-target="#myModal"><span>register</span></a>';
                            echo '<a href="./login.php?url=' . basename($_SERVER['PHP_SELF']) . '" class="ms_btn login_btn"><span>login</span></a>';
                        }else{
                            echo '<a href="javascript:;" class="ms_admin_name">Hello<span class="ms_pro_name" style="font-size: 12px;">' . $_SESSION['user_name'] .'</span></a>
                            <ul class="pro_dropdown_menu">
                                <li><a href="profile.php">Profile</a></li>

                                <li><a href="./logout.php?url=' . basename($_SERVER['PHP_SELF']) . '">Logout</a></li>
                            </ul>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <!---Side Menu Start--->
        <div class="ms_sidemenu_wrapper">
            <div class="ms_nav_close">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </div>
            <div class="ms_sidemenu_inner">
				<div class="ms_logo_inner">
					<div class="ms_logo">
						<a href="index.php"><img src="images/logo.png" alt="" class="img-fluid"/></a>
					</div>
					<div class="ms_logo_open">
						<a href="index.php"><img src="images/open_logo.png" alt="" class="img-fluid"/></a>
					</div>
				</div>
                <div class="ms_nav_wrapper">
                    <ul>
                        <li><a href="index.php"  title="Discover">
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
                        <li><a href="artist.php" class="active" title="Artists">
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
        <!----Album Single Section Start---->
        <div class="ms_album_single_wrapper ms_artist_single">
            <div class="album_single_data">
                <div class="album_single_img">
                    <?php
                    $sql = "SELECT * FROM `artist` WHERE Artist_ID = " . $_GET['artist_id'];
                    $result = mysqli_query($link,$sql);
                    $row = mysqli_fetch_assoc($result);
                    if(!(mysqli_num_rows($result) > 0)){exit();}
                    echo '<img src="images/artist/artist.jpg" alt="" class="img-fluid">
                </div>
                <div class="album_single_text">
                    <h2>' . $row['Name'] . '</h2>
                    <!--<p class="singer_name">Singer, New York</p>-->';
                    ?>
                    <div class="about_artist">
                        Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in<br> reprehenderit in voluptate velit esse cillum dolor... <a href="#">Read More</a>
                    </div>

                </div>

            </div>
            <!----Song List---->
			<div class="album_inner_list">
				<div class="album_list_wrapper">
					<ul class="album_list_name">
						<li>#</li>
						<li>Song Title</li>
						<li>Artist</li>
					</ul>
                     <?php
						$sql = "SELECT videos_songs.VS_ID,videos_Songs.Title,artist.Artist_ID,artist.Name FROM videos_songs LEFT JOIN song_artist ON videos_songs.VS_ID = song_artist.VS_ID LEFT JOIN artist ON artist.Artist_ID = song_artist.Artist_ID WHERE artist.Artist_ID =" . $_GET['artist_id'];
                        $result = mysqli_query($link,$sql);
                        $cout = 1;
                        foreach($result as $row){
                            echo "<ul>";
                            if($cout < 10){
                                echo '<li><a href="song_single.php?vs_id=' . $row['VS_ID']. '"><span class="play_no">0'.$cout++.'</span>';
                            }else{
                                echo '<li><a href="song_single.php?vs_id=' . $row['VS_ID']. '"><span class="play_no">'.$cout++.'</span>';
                            }
                            echo '<span class="play_hover"></span></a></li>
                            <li><a href="song_single.php?vs_id=' . $row['VS_ID']. '">'.$row['Title'].'</a></li>';
                            $sql_art = 'SELECT videos_songs.VS_ID,videos_Songs.Title,artist.Artist_ID,artist.Name FROM videos_songs 
                            LEFT JOIN song_artist ON videos_songs.VS_ID = song_artist.VS_ID 
                            LEFT JOIN artist ON artist.Artist_ID = song_artist.Artist_ID WHERE videos_songs.VS_ID = ' . $row["VS_ID"];
                            $result_art = mysqli_query($link,$sql_art);
                            $artists = "";
                            foreach($result_art as $row_art){
                            $artists .= $row_art['Name'] . ",";
                            }
                            if (substr($artists,-1) == ",") {
                            $artists = substr($artists,0,-1);
                            }
                            $artists = str_replace(",",", ",$artists);
                            echo '<li><a href="song_single.php?vs_id=' . $row['VS_ID']. '">' . $artists . '</a></li></ul>';
                        }
                        ?>

					</ul>
				</div>
			</div>
        </div>
        <!---Main Content Start--->
            <!----Main div close---->
        </div>
        <!----Footer Start---->
        <?php
          include("footer.php");
        ?>
            <!--main div-->
    </div>
    <!----Register Modal Start---->
    <!-- Modal -->
    <div class="ms_register_popup">
        <div id="myModal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog register_dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
						<i class="fa_icon form_close"></i>
					</button>
                    <div class="modal-body">
                        <div class="ms_register_img">
                            <img src="images/register_img.png" alt="" class="img-fluid" />
                            <h2 id="sr" style="font-size: 20px;color: white;left: 20%;position: relative;top: 30px; opacity: 0;"></h2>
                        </div>
                        <div class="ms_register_form">
                            <h2>Register / Sign Up</h2>
                            <form id="reg_form">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Your Name" class="form-control rinput" name="Name" id="Name" onkeyup="textdefault(this.id)" required>
                                    <span class="form_icon">
                                    <i class="fa_icon form-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="Enter Your Email" class="form-control rinput" name="Email" id="Email" onkeyup="textdefault(this.id)" required>
                                    <span class="form_icon">
                                    <i class="fa_icon form-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Enter Password" class="form-control rinput" name="Password" id="Password" onkeyup="textdefault(this.id)" required>
                                    <span class="form_icon" id = "passicon" onclick="showpass(this.id)">
                                    <i class="fa_iconlock form-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Confirm Password" class="form-control rinput" name="CPassword" id="CPassword" onkeyup="textdefault(this.id)" required>
                                    <span class="form_icon" id = "cpassicon" onclick="showpass(this.id)">
                                    <i class=" fa_iconlock form-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="tel" placeholder="Enter Contact Number" class="form-control rinput" name="Contact" id="Contact" onkeyup="textdefault(this.id)" required>
                                    <span class="form_icon">
                                    <i class=" fa_iconphoneB fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Your Address" class="form-control rinput" name="Address" id="Address" onkeyup="textdefault(this.id)" required>
                                    <span class="form_icon">
                                    <i class=" fa_iconaddress form-address" aria-hidden="true"></i>
                                    </span>
                                </div>
                                
                                <div id="gen" class="radios" style="display: inline-flex;color: white;margin-bottom: 10px;">
                                    <label for="radio" style="margin-right: 20px;">Gender</label>
                                    <div class="radio">
                                        <input type="radio" id="radio1" name="gender" value="male" class="rinput">
                                        <label for="radio1">
                                            <div class="checker">
                                            Male</div>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <input type="radio" id="radio2" name="gender" value="female" class="rinput">
                                        <label for="radio2">
                                            <div class="checker">
                                            Female</div>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="photo" id="photo" class="rinput">
                                </div>

                                <a href="javascript:{}" class="ms_btn" onclick="reg_user()">register now</a>
                            </form>
                            <p>Already Have An Account? <a href="login.php">login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----Language Selection Modal---->
    <div class="ms_lang_popup">
        <div id="lang_modal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
						<i class="fa_icon form_close"></i>
					</button>
                    <div class="modal-body">
                        <h1>language selection</h1>
                        <p>Please select the language(s) of the music you listen to.</p>
                        <ul class="lang_list">
                            <li>
                                <label class="lang_check_label">
							English 
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							urdu / hindi
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							punjabi
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							French
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							 German 
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							Spanish
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							Chinese
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							Japanese 
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							Arabic
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                            <li>
                                <label class="lang_check_label">
							 Italian
							<input type="checkbox" name="check"> 
							<span class="label-text"></span>
							</label>
                            </li>
                        </ul>
                        <div class="ms_lang_btn">
                            <a href="#" class="ms_btn">apply</a>
                        </div>
                    </div>
                </div>
            </div>
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
    <script>
		new InputFile({
			// options
		});

        rinput = document.querySelectorAll('.rinput');
        rinput.forEach(function(e) {
            e.addEventListener("keyup", ({key}) => {
                if (key === "Enter") {
                    reg_user();
                }
            });
        });

        function textdefault(id){
            document.getElementById(id).style.color = "#777777";
            document.getElementById(id).style.border = "";
            document.getElementById(id).style.backgroundColor = "";
        }

        function showpass(id) {
            var iconchk = document.getElementById(id).children[0].style.backgroundImage;
            if (iconchk == 'url("./images/svg/lock.svg")' || iconchk == "") {
                document.getElementById(id).children[0].style.backgroundImage = "url('./images/svg/unlock.svg')";
                document.getElementById(id).parentNode.children[0].setAttribute("type", "text");
            } else {
                document.getElementById(id).children[0].style.backgroundImage = "url('./images/svg/lock.svg')";
                document.getElementById(id).parentNode.children[0].setAttribute("type", "password");
            }
        }

        function reg_user() {
            var ok = 0;

            if(document.getElementById('Name').value == ""){
                document.getElementById('Name').style.border = "3px solid #22bed7";
                document.getElementById('Name').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('Name').style.border = "";
                document.getElementById('Name').style.backgroundColor = "";
                var name = document.getElementById('Name').value;
                regex = /^[a-zA-Z ]+$/;
                if(!regex.test(name)){
                    ok++;
                    document.getElementById('Name').style.color = "#d72222";
                }else if(name.length > 100 ){
                    ok++;
                    document.getElementById('Name').style.color = "#d72222";
                }
            }
            
            if(document.getElementById('Email').value == ""){
                document.getElementById('Email').style.border = "3px solid #22bed7";
                document.getElementById('Email').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('Email').style.border = "";
                document.getElementById('Email').style.backgroundColor = "";
                var email = document.getElementById('Email').value;
                regex = /[a-z0-9A-Z_-]+@[a-z]+\.[a-z]+$/g;
                if(!regex.test(email)){
                    ok++;
                    document.getElementById('Email').style.color = "#d72222";
                }else if(email.length > 320 ){
                    ok++;
                    document.getElementById('Email').style.color = "#d72222";
                }
            }

            if(document.getElementById('Password').value == "" || document.getElementById('CPassword').value == ""){
                document.getElementById('Password').style.border = "3px solid #22bed7";
                document.getElementById('Password').style.backgroundColor = "#bdf6ff";
                document.getElementById('CPassword').style.border = "3px solid #22bed7";
                document.getElementById('CPassword').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('Password').style.border = "";
                document.getElementById('Password').style.backgroundColor = "";
                document.getElementById('CPassword').style.border = "";
                document.getElementById('CPassword').style.backgroundColor = "";
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
            }

            if(document.getElementById('Contact').value == ""){
                document.getElementById('Contact').style.border = "3px solid #22bed7";
                document.getElementById('Contact').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('Contact').style.border = "";
                document.getElementById('Contact').style.backgroundColor = "";
                var contact = document.getElementById('Contact').value;
                regex = /^[0-9+]+$/;
                if(!regex.test(contact)){
                    ok++;
                    document.getElementById('Contact').style.color = "#d72222";
                }else if(contact.length > 16 || contact.length == 0){
                    ok++;
                    document.getElementById('Contact').style.color = "#d72222";
                }
            }
            
            if(document.getElementById('Address').value == ""){
                ok++;
                document.getElementById('Address').style.border = "3px solid #22bed7";
                document.getElementById('Address').style.backgroundColor = "#bdf6ff";
            }else{
                document.getElementById('Address').style.border = "";
                document.getElementById('Address').style.backgroundColor = "";
                var address = document.getElementById('Address').value;
                if(address.length > 255 ){
                    ok++;
                    document.getElementById('Address').style.color = "#d72222";
                }
            }

            if(document.getElementById('radio1').checked){
                document.getElementById('gen').style.border = "";
                document.getElementById('gen').style.borderRadius = "";
                document.getElementById('gen').style.padding = "";
                var gender = "male";
            }else if(document.getElementById('radio2').checked){
                document.getElementById('gen').style.border = "";
                document.getElementById('gen').style.borderRadius = "";
                document.getElementById('gen').style.padding = "";
                var gender = "female";
            }else{
                document.getElementById('gen').style.border = "3px solid #49bcd6";
                document.getElementById('gen').style.borderRadius = "5px";
                document.getElementById('gen').style.padding = "10px 10px 5px 10px";
                var gender = "";
                ok++;
            }

            if(document.getElementById('photo').files.length){
                var photo = document.getElementById('photo').files;
            }else{
                if(gender == "male"){
                    var photo = ['1_male_avatar.png'];
                }else{
                    var photo = ['0_female_avatar.png'];
                }
            }

            if(ok == 0) {
                let formData = new FormData();
                formData.append('Name', name);
                formData.append('Email', email);
                formData.append('Password', password);
                formData.append('Contact', contact);
                formData.append('Address', address);
                formData.append('gender', gender);
                formData.append('photo', photo[0]);
                let xhr = new XMLHttpRequest();
                xhr.open("POST", 'reg_user.php', true);
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
                            document.getElementById('Name').value = "";
                            document.getElementById('Email').value = "";
                            document.getElementById('Password').value = "";
                            document.getElementById('CPassword').value = "";
                            document.getElementById('Contact').value = "";
                            document.getElementById('Address').value = "";
                            document.getElementById('radio1').checked = false;
                            document.getElementById('radio2').checked = false;
                            document.querySelector('#photo').value = "";
                            document.getElementsByClassName("inf__hint")[0].innerHTML = "or drag and drop files here";
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