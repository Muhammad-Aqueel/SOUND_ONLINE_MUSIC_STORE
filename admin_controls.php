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
    <link rel="stylesheet" href="css/virtual-select.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <style>
        .vscomp-toggle-button{padding-left: 24px;
        font-size: 16px;
        font-weight: 550;
        line-height: 40px;
        color: #000000;
        background-color: #fff;
        border-radius: 4px;
        border: 1px solid transparent;
        font-family: 'Josefin Sans';}

        .vscomp-toggle-button:hover {
        box-shadow: 0px 0px 10px rgb(59 200 231 / 55%);
        border: 1px solid #e714db;}
    </style>
</head>
<body onresize="artist_list_width()">
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
            <div class="ms_profile_wrapper" style="top: -45px;position: relative;">
                <div class="ms_profile_box" style="width: 100%;padding: 10px 0px;background-color: transparent;">
                    <div class="container mt-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                            <a class="nav-link active border-bottom-0 border-top border-right border-left" data-toggle="tab" href="#songtab" onclick="artist_list_width_active()">Song</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link border-bottom-0 border-top border-right border-left" data-toggle="tab" href="#albumtab">Album</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link border-bottom-0 border-top border-right border-left" data-toggle="tab" href="#artisttab">Artist</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link border-bottom-0 border-top border-right border-left" data-toggle="tab" href="#userstab">Users</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="songtab" class="container tab-pane active"><br>
                            <h1>ADD SONG</h1>
                            <label id="ssr" style="opacity:0;color: rgb(231, 20, 219); font-size: large;">_</label>
                            <div class="ms_pro_form">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <input id="stitle" type="text" onkeyup="textdefault(this.id)" placeholder="Enter Song Title" class="form-control songinput">
                                </div>
                                <div class="form-group">
                                    <label>Language *</label>
                                    <select name="lang" id="lang" class="form-control songinput">
                                        <option value="" selected>Select Language</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="English">English</option>
                                        <option value="French">French</option>
                                        <option value="German">German</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Punjabi">Punjabi</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="UrduHindi">Urdu / Hindi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="month" id="mmyy" name="mmyy" class="form-control songinput">
                                </div>
                                <div class="form-group">
                                    <label>Genre *</label>
                                    <select name="gen" id="gen" class="form-control songinput">
                                        <option value="" selected>Select Genre</option>
                                        <option value="Classical">Classical</option>
                                        <option value="Dance">Dance</option>
                                        <option value="Folk">Folk</option>
                                        <option value="Hip Hop">Hip Hop</option>
                                        <option value="Indie">Indie</option>
                                        <option value="Jazz">Jazz</option>
                                        <option value="Pop">Pop</option>
                                        <option value="Rock">Rock</option>
                                        <option value="Romantic">Romantic</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Artist</label><br>
                                    <div id="ARTEXP">
                                        <select name="artist" id="artist" multiple name="native-select" placeholder="Select Artist" data-silent-initial-value-set="true">
                                            <?php
                                                $sql="SELECT * FROM `artist`";
                                                $result = mysqli_query($link,$sql);
                                                foreach($result as $row){
                                                echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Album</label>
                                    <select name="album" id="album" class="form-control songinput">
                                        <option value="" selected>Select Album</option>
                                        <?php
                                            $sql="SELECT * FROM `album`";
                                            $result = mysqli_query($link,$sql);
                                            foreach($result as $row){
                                            echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Cover</label>
                                    <input type="file" name="photo" id="photo" class="songinput">
                                </div>
                                <div class="form-group">
                                    <label>Song File *</label>
                                    <input type="file" name="vafile" id="vafile" class="songinput" onchange = "vafiledefault()">
                                </div>
                                <div class="pro-form-btn text-center marger_top15">
                                    <a href="javascript:{};" class="ms_btn" onclick="add_song()">save</a>
                                    <a href="javascript:{};" class="ms_btn" onclick="clear_song()">clear</a>
                                </div>
                                <br>
                                <table id = "tblsong" class="table table-dark table-striped m-auto" style="table-layout:fixed;">
                                    <tr>
                                        <th title="song Id" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Song ID</th>
                                        <th title="Title" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Title</th>
                                        <th title="Language" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Language</th>
                                        <th title="Year" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Year</th>
                                        <th title="Genre" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Genre</th>
                                        <th title="Artist" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Artist</th>
                                        <th title="Album" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Album</th>
                                        <th title="Cover" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Cover</th>
                                        <th title="File" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">File</th>
                                        <th title="Action" colspan="3" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Actions</th>
                                    </tr>
                                    
                                    <?php
                                    $sql="SELECT videos_Songs.VS_ID,videos_Songs.Title,videos_Songs.Language,videos_Songs.Year,videos_Songs.Genre,videos_Songs.photo,videos_Songs.URLs, ALBUM.Name
                                    FROM videos_Songs LEFT JOIN ALBUM
                                    ON videos_Songs.Album_ID=ALBUM.Album_ID
                                    ORDER BY videos_Songs.VS_ID";

                                    $result = mysqli_query($link,$sql);
                                    foreach($result as $row){

                                        echo '<tr><td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["VS_ID"] . '</td>
                                        <td title="' . $row["Title"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Title"] . '</td>
                                        <td title="' . $row["Language"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Language"] . '</td>
                                        <td title="' . $row["Year"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Year"] . '</td>
                                        <td title="' . $row["Genre"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Genre"] . '</td>';

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
                                        echo '<td title="' . $artists . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $artists . '</td>
                                        <td title="' . $row["Name"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Name"] . '</td>
                                        <td title="' . $row["photo"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["photo"] . '</td>
                                        <td title="' . $row["URLs"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["URLs"] . '</td>
                                        <td title="view"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">View</td>
                                        <td title="edit"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Edit</td>
                                        <td title="delete"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Delete</td>
                                        </tr>';
                                    }
                                        ?>
                                    
                                </table>
                            </div>
                            </div>
                            <div id="albumtab" class="container tab-pane fade"><br>
                            <h1>ADD ALBUM</h1>
                            <label id="alsr" style="opacity:0;color: rgb(231, 20, 219); font-size: large;">_</label>
                            <div class="ms_pro_form">
                                <div class="form-group">
                                    <label>Album Name *</label>
                                    <input id="albname" type="text" placeholder="Enter Album Name" class="form-control albinput">
                                </div>
                                <div class="pro-form-btn text-center marger_top15">
                                    <a href="#" class="ms_btn" onclick="add_album()">save</a>
                                </div>
                                <br>
                                <table id = "tblalbm" class="table table-dark table-striped m-auto">
                                    <tr>
                                        <th>Album ID</th>
                                        <th>Name</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                    <?php
                                    $sql="SELECT * FROM `album` ORDER BY `Album_ID` ASC";

                                    $result = mysqli_query($link,$sql);
                                    foreach($result as $row){
                                        echo '<tr>
                                            <td>' . $row["Album_ID"] . '</td>
                                            <td class="albcontentname" contenteditable>' . $row["Name"] . '</td>
                                            <td id="albm' . $row["Album_ID"] . '" onclick="albmupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                                            <td id="albm' . $row["Album_ID"] . '" onclick="albmdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                                        </tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                            </div>
                            <div id="artisttab" class="container tab-pane fade"><br>
                            <h1>ADD ATRIST</h1>
                            <label id="arsr" style="opacity:0;color: rgb(231, 20, 219); font-size: large;">_</label>
                            <div class="ms_pro_form">
                                <div class="form-group">
                                    <label>Artist Name *</label>
                                    <input id="artname" type="text" placeholder="Enter Artist Name" class="form-control artinput">
                                </div>
                                <div class="pro-form-btn text-center marger_top15">
                                    <a href="#" class="ms_btn" onclick="add_artist()">save</a>
                                </div>
                                <br>
                                <table id = "tblart" class="table table-dark table-striped m-auto">
                                    <tr>
                                        <th>Artist ID</th>
                                        <th>Name</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                    <?php
                                    $sql="SELECT * FROM `artist` ORDER BY `Artist_ID` ASC";

                                    $result = mysqli_query($link,$sql);
                                    foreach($result as $row){
                                        echo '<tr>
                                            <td>' . $row["Artist_ID"] . '</td>
                                            <td class="artcontentname" contenteditable>' . $row["Name"] . '</td>
                                            <td id="art' . $row["Artist_ID"] . '" onclick="artupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                                            <td id="art' . $row["Artist_ID"] . '" onclick="artdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                                        </tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                            </div>
                            <div id="userstab" class="container tab-pane fade"><br>
                            <h1>USERS DETAILS</h1>
                                <div class="ms_pro_form">
                                    <table id="tblusr" class="table table-dark table-striped m-auto" style="table-layout:fixed;">
                                        <tr>
                                            <th title="User ID" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">User ID</th>
                                            <th title="Name" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Name</th>
                                            <th title="Email" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Email</th>
                                            <th title="Contact" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Contact</th>
                                            <th title="Address" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Address</th>
                                            <th title="Gender" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Gender</th>
                                            <th title="Image" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Image</th>
                                            <th title="Action" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Action</th>
                                        </tr>
                                        <?php
                                        $sql="SELECT * FROM `users`";

                                        $result = mysqli_query($link,$sql);
                                        foreach($result as $row){
                                            echo '<tr>
                                                <td>' . $row["User_ID"] . '</td>
                                                <td title="' . $row["Name"] . '" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Name"] . '</td>
                                                <td title="' . $row["Email"] . '" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Email"] . '</td>
                                                <td title="' . $row["Contact"] . '" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Contact"] . '</td>
                                                <td title="' . $row["Address"] . '" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Address"] . '</td>
                                                <td title="' . $row["Gender"] . '" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;text-transform: capitalize;">' . $row["Gender"] . '</td>
                                                <td><img src="./images/users/' . $row["photo"] . '" style="width: 20%;"></td>
                                                <td id="usr' . $row["User_ID"] . '" onclick="" title="Delete" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                                            </tr>';
                                        }
                                        ?>
                                    </table>
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
        <!----Login Popup Start---->
        <div id="myModal1" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog login_dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
						<i class="fa_icon form_close"></i>
					</button>
                    <div class="modal-body">
                        <div class="ms_register_img">
                            <img src="images/register_img.png" alt="" class="img-fluid" />
                        </div>
                        <div class="ms_register_form">
                            <h2>login / Sign in</h2>
                            <div class="form-group">
                                <input type="text" placeholder="Enter Your Email" class="form-control">
                                <span class="form_icon">
							<i class="fa_icon form-envelope" aria-hidden="true"></i>
						</span>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Enter Password" class="form-control">
                                <span class="form_icon">
						<i class="fa_icon form-lock" aria-hidden="true"></i>
						</span>
                            </div>
                            <div class="remember_checkbox">
                                <label>Keep me signed in
							<input type="checkbox">
							<span class="checkmark"></span>
						</label>
                            </div>
                            <a href="#" class="ms_btn">login now</a>
                            <div class="popup_forgot">
                                <a href="#">Forgot Password ?</a>
                            </div>
                            <p>Don't Have An Account? <a href="#myModal" data-toggle="modal" class="ms_modal1 hideCurrentModel">register here</a></p>
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
	<!----Queue Clear Model ---->
	<div class="ms_clear_modal">
		<div id="clear_modal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
						<i class="fa_icon form_close"></i>
					</button>
                    <div class="modal-body">
						<h1>Are you sure you want to clear your queue?</h1>
						<div class="clr_modal_btn">
							<a href="#">clear all</a>
							<a href="#">cancel</a>
						</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<!----Queue Save Modal---->
	<div class="ms_save_modal">
		<div id="save_modal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
						<i class="fa_icon form_close"></i>
					</button>
                    <div class="modal-body">
						<h1>Log in to start sharing your music!</h1>
						<div class="save_modal_btn">
							<a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i> continue with google </a>
							<a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i> continue with facebook</a>
						</div>
						<div class="ms_save_email">
							<h3>or use your email</h3>
							<div class="save_input_group">
								<input type="text" placeholder="Enter Your Name" class="form-control">
							</div>
							<div class="save_input_group">
                                <input type="password" placeholder="Enter Password" class="form-control">
                            </div>
							<button class="save_btn">Log in</button>
						</div>
						<div class="ms_dnt_have">
						    <span>Dont't have an account ?</span>
							<a href="javascript:;" class="hideCurrentModel" data-toggle="modal" data-target="#myModal">Register Now</a>
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
    <script src="js/virtual-select.min.js"></script>
    <script>
        new InputFile({
			// options
		});

        VirtualSelect.init({ 
            ele: '#artist',
            allowNewOption: true
        });

        songinput = document.querySelectorAll('.songinput');
        songinput.forEach(function(e) {
            e.addEventListener("keyup", ({key}) => {
                if (key === "Enter") {
                    add_song();
                }
            });
        });
        songinput = document.querySelectorAll('.songinput');
        songinput.forEach(function(e) {
            e.addEventListener("keyup", ({key}) => {
                if (key === "Escape") {
                    clear_song();
                }
            });
        });
        albinput = document.querySelectorAll('.albinput');
        albinput.forEach(function(e) {
            e.addEventListener("keyup", ({key}) => {
                if (key === "Enter") {
                    add_album();
                }
            });
        });
        artinput = document.querySelectorAll('.artinput');
        artinput.forEach(function(e) {
            e.addEventListener("keyup", ({key}) => {
                if (key === "Enter") {
                    add_artist();
                }
            });
        });
        var albcontentname = document.querySelectorAll('.albcontentname');
        albcontentname.forEach(el => el.addEventListener('keypress', event => {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        }));
        var artcontentname = document.querySelectorAll('.artcontentname');
        artcontentname.forEach(el => el.addEventListener('keypress', event => {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        }));
        
        $(document).ready(function(){
            b = document.getElementById("album").clientWidth;
            document.getElementById("album").parentNode.parentNode.children[4].children[2].children[0].children[0].style.width = b+"px";
        });

        function artist_list_width() {
            b = document.getElementById("album").offsetWidth;
            document.getElementById("album").parentNode.parentNode.children[4].children[2].children[0].children[0].style.width = b+"px";
        }

        function artist_list_width_active(){
            setTimeout(artist_list_width, 250);
        }

        function clear_song(){
            document.getElementById("stitle").value = "";
            document.getElementById("lang").value = "";
            document.getElementById("mmyy").value = "";
            document.getElementById("gen").value = "";
            document.querySelector('#artist').reset();
            document.getElementById("album").value = "";
            document.getElementById("photo").value = "";
            document.getElementById("vafile").value = "";
            document.getElementsByClassName("inf__hint")[0].innerHTML = "or drag and drop files here";document.getElementsByClassName("inf__hint")[1].innerHTML = "or drag and drop files here";
            document.getElementsByClassName('inf__drop-area')[1].style.border = "1px dashed #c4c4c4";
            document.getElementsByClassName('inf__btn')[1].style.border = "1px solid #c4c4c4";
            document.getElementById('gen').style.border = "";
            document.getElementById('gen').style.backgroundColor = "";
            document.getElementById('lang').style.border = "";
            document.getElementById('lang').style.backgroundColor = "";
            document.getElementById('stitle').style.border = "";
            document.getElementById('stitle').style.backgroundColor = "";
        }

        function textdefault(id){
            document.getElementById(id).style.color = "#777777";
            document.getElementById(id).style.border = "";
            document.getElementById(id).style.backgroundColor = "";
        }

        function vafiledefault() {
            document.getElementsByClassName('inf__drop-area')[1].style.border = "1px dashed #c4c4c4";
            document.getElementsByClassName('inf__btn')[1].style.border = "1px solid #c4c4c4";
        }
        
        function add_song(){
            var ok = 0;

            if(document.getElementById('stitle').value == ""){
                document.getElementById('stitle').style.border = "3px solid #22bed7";
                document.getElementById('stitle').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('stitle').style.border = "";
                document.getElementById('stitle').style.backgroundColor = "";
                var name = document.getElementById('stitle').value;
                regex = /^[0-9a-zA-Z ]+$/;
                if(!regex.test(name)){
                    ok++;
                    document.getElementById('stitle').style.color = "#d72222";
                }else if(name.length > 100 ){
                    ok++;
                    document.getElementById('stitle').style.color = "#d72222";
                }
            }

            if(document.getElementById('lang').value == ""){
                document.getElementById('lang').style.border = "3px solid #22bed7";
                document.getElementById('lang').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('lang').style.border = "";
                document.getElementById('lang').style.backgroundColor = "";
            }

            if(document.getElementById('gen').value == ""){
                document.getElementById('gen').style.border = "3px solid #22bed7";
                document.getElementById('gen').style.backgroundColor = "#bdf6ff";
                ok++;
            }else{
                document.getElementById('gen').style.border = "";
                document.getElementById('gen').style.backgroundColor = "";
            }

            if(document.getElementById('photo').files.length){
                var photo = document.getElementById('photo').files;
            }else{
                var photo = "";
            }

            if(document.getElementById('vafile').value == ""){
                document.getElementsByClassName('inf__drop-area')[1].style.border = "2px dashed #22bed7";
                document.getElementsByClassName('inf__btn')[1].style.border = "1px solid #22bed7";
                ok++;
            }else{
                document.getElementsByClassName('inf__drop-area')[1].style.border = "1px dashed #c4c4c4";
                document.getElementsByClassName('inf__btn')[1].style.border = "1px solid #c4c4c4";
                var vafile = document.getElementById('vafile').files;
            }

            if(ok == 0) {
                stitle = document.getElementById("stitle").value;
                lang = document.getElementById("lang").value;
                mmyy = document.getElementById("mmyy").value;
                gen = document.getElementById("gen").value;
                artist = document.querySelector('#artist').value;
                album = document.getElementById("album").value;

                let formData = new FormData();
                formData.append('stitle', stitle);
                formData.append('lang', lang);
                formData.append('mmyy', mmyy);
                formData.append('gen', gen);
                formData.append('artist_count', artist.length);                   
                for (let index = 0; index < artist.length; index++) {
                    formData.append('artist'+index, artist[index]);                   
                }
                formData.append('album', album);
                formData.append('photo', photo[0]);
                formData.append('vafile', vafile[0]);
                let xhr = new XMLHttpRequest();
                xhr.open("POST", 'admin_data_process.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const data = JSON.parse(this.responseText);
                        if(data.success === 1) {
                            document.getElementById("ssr").innerHTML = data.msg;
                            document.getElementById("tblsong").innerHTML = data.tbldata;
                            document.getElementById("ssr").style.opacity = "1";
                            const myTimeout = setTimeout(srvis, 1500);

                            function srvis() {
                                document.getElementById("ssr").style.transition = "opacity 2s";
                                document.getElementById("ssr").style.opacity = "0";
                                const myTimeout = setTimeout(srhid, 1000);
                                function srhid()
                                {document.getElementById("ssr").style.transition = "opacity 0s";}
                            }
                            clear_song();
                        }else{
                            document.getElementById("ssr").innerHTML = data.msg;
                            document.getElementById("ssr").style.opacity = "1";
                            const myTimeout = setTimeout(srvis, 1500);

                            function srvis() {
                                document.getElementById("ssr").style.transition = "opacity 2s";
                                document.getElementById("ssr").style.opacity = "0";
                                const myTimeout = setTimeout(srhid, 1000);
                                function srhid()
                                {document.getElementById("ssr").style.transition = "opacity 0s";}
                            }
                        }
                    }
                };
                xhr.send(formData);
            }
        }

        function add_album(){
            albname = document.getElementById('albname').value;

            let formData = new FormData();
            formData.append('AlbName', albname);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById("alsr").innerHTML = data.msg;
                        document.getElementById("tblalbm").innerHTML = data.tbldata;
                        document.getElementById("album").innerHTML = data.listdata;
                        var albcontentname = document.querySelectorAll('.albcontentname');
                        albcontentname.forEach(el => el.addEventListener('keypress', event => {
                            if (event.key === "Enter") {
                                event.preventDefault();
                            }
                        }));
                        document.getElementById("alsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("alsr").style.transition = "opacity 2s";
                            document.getElementById("alsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("alsr").style.transition = "opacity 0s";}
                        }
                        document.getElementById('albname').value = "";
                    }else{
                        document.getElementById("alsr").innerHTML = data.msg;
                        document.getElementById("alsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("alsr").style.transition = "opacity 2s";
                            document.getElementById("alsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("alsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }

        function albmupdt(id){
            valbmupdtid = document.getElementById(id).parentNode.children[0].innerHTML;
            valbmupdtnam = document.getElementById(id).parentNode.children[1].innerHTML;

            let formData = new FormData();
            formData.append('Valbmupdtid', valbmupdtid);
            formData.append('Valbmupdtnam', valbmupdtnam);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById("alsr").innerHTML = data.msg;
                        document.getElementById("tblalbm").innerHTML = data.tbldata;
                        document.getElementById("album").innerHTML = data.listdata;
                        var albcontentname = document.querySelectorAll('.albcontentname');
                        albcontentname.forEach(el => el.addEventListener('keypress', event => {
                            if (event.key === "Enter") {
                                event.preventDefault();
                            }
                        }));
                        document.getElementById("alsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("alsr").style.transition = "opacity 2s";
                            document.getElementById("alsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("alsr").style.transition = "opacity 0s";}
                        }
                    }else{
                        document.getElementById("alsr").innerHTML = data.msg;
                        document.getElementById("alsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("alsr").style.transition = "opacity 2s";
                            document.getElementById("alsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("alsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }

        function albmdel(id){
            valbmdel = document.getElementById(id).parentNode.children[0].innerHTML;

            let formData = new FormData();
            formData.append('Valbmdel', valbmdel);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById("alsr").innerHTML = data.msg;
                        document.getElementById("tblalbm").innerHTML = data.tbldata;
                        document.getElementById("album").innerHTML = data.listdata;
                        var albcontentname = document.querySelectorAll('.albcontentname');
                        albcontentname.forEach(el => el.addEventListener('keypress', event => {
                            if (event.key === "Enter") {
                                event.preventDefault();
                            }
                        }));
                        document.getElementById("alsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("alsr").style.transition = "opacity 2s";
                            document.getElementById("alsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("alsr").style.transition = "opacity 0s";}
                        }
                    }else{
                        document.getElementById("alsr").innerHTML = data.msg;
                        document.getElementById("alsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("alsr").style.transition = "opacity 2s";
                            document.getElementById("alsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("alsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }

        function add_artist(){
            artname = document.getElementById('artname').value;

            let formData = new FormData();
            formData.append('ArtName', artname);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById("arsr").innerHTML = data.msg;
                        document.getElementById("tblart").innerHTML = data.tbldata;
                        document.getElementById("ARTEXP").innerHTML = data.listdata;
                        VirtualSelect.init({ 
                        ele: '#artist',
                        allowNewOption: true
                        });
                        var artcontentname = document.querySelectorAll('.artcontentname');
                        artcontentname.forEach(el => el.addEventListener('keypress', event => {
                            if (event.key === "Enter") {
                                event.preventDefault();
                            }
                        }));

                        document.getElementById("arsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("arsr").style.transition = "opacity 2s";
                            document.getElementById("arsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("arsr").style.transition = "opacity 0s";}
                        }
                        document.getElementById('artname').value = "";
                    }else{
                        document.getElementById("arsr").innerHTML = data.msg;
                        document.getElementById("arsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("arsr").style.transition = "opacity 2s";
                            document.getElementById("arsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("arsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }

        function artupdt(id){
            vartupdtid = document.getElementById(id).parentNode.children[0].innerHTML;
            vartupdtnam = document.getElementById(id).parentNode.children[1].innerHTML;

            let formData = new FormData();
            formData.append('Vartupdtid', vartupdtid);
            formData.append('Vartupdtnam', vartupdtnam);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById("arsr").innerHTML = data.msg;
                        document.getElementById("tblart").innerHTML = data.tbldata;
                        document.getElementById("ARTEXP").innerHTML = data.listdata;
                        VirtualSelect.init({ 
                        ele: '#artist',
                        allowNewOption: true
                        });
                        var artcontentname = document.querySelectorAll('.artcontentname');
                        artcontentname.forEach(el => el.addEventListener('keypress', event => {
                            if (event.key === "Enter") {
                                event.preventDefault();
                            }
                        }));
                        document.getElementById("arsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("arsr").style.transition = "opacity 2s";
                            document.getElementById("arsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("arsr").style.transition = "opacity 0s";}
                        }
                    }else{
                        document.getElementById("arsr").innerHTML = data.msg;
                        document.getElementById("arsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("arsr").style.transition = "opacity 2s";
                            document.getElementById("arsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("arsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }

        function artdel(id){
            vartdel = document.getElementById(id).parentNode.children[0].innerHTML;

            let formData = new FormData();
            formData.append('Vartdel', vartdel);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    if(data.success === 1) {
                        document.getElementById("arsr").innerHTML = data.msg;
                        document.getElementById("tblart").innerHTML = data.tbldata;
                        document.getElementById("ARTEXP").innerHTML = data.listdata;
                        VirtualSelect.init({ 
                        ele: '#artist',
                        allowNewOption: true
                        });
                        var artcontentname = document.querySelectorAll('.artcontentname');
                        artcontentname.forEach(el => el.addEventListener('keypress', event => {
                            if (event.key === "Enter") {
                                event.preventDefault();
                            }
                        }));
                        document.getElementById("arsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("arsr").style.transition = "opacity 2s";
                            document.getElementById("arsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("arsr").style.transition = "opacity 0s";}
                        }
                    }else{
                        document.getElementById("arsr").innerHTML = data.msg;
                        document.getElementById("arsr").style.opacity = "1";
                        const myTimeout = setTimeout(srvis, 1500);

                        function srvis() {
                            document.getElementById("arsr").style.transition = "opacity 2s";
                            document.getElementById("arsr").style.opacity = "0";
                            const myTimeout = setTimeout(srhid, 1000);
                            function srhid()
                            {document.getElementById("arsr").style.transition = "opacity 0s";}
                        }
                    }
                }
            };
            xhr.send(formData);
        }

        setInterval(usrupdt, 10000);
        function usrupdt(){
            let formData = new FormData();
            formData.append('Usrupdt', "USERTABLEUPDATING");
            let xhr = new XMLHttpRequest();
            xhr.open("POST", 'admin_data_process.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const data = JSON.parse(this.responseText);
                    document.getElementById("tblusr").innerHTML = data.tbldata;
                    console.log(data.tbldata);
                }
            };
            xhr.send(formData);
        }

    </script>
</body>

</html>