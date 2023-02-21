<?php
session_start();
require("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $path = 'songs/';
    $path2 = 'images/covers/';

    if(isset($_POST['AlbName'])){
        $albname = trim($_POST['AlbName']);

        if($albname == ""){
            echo json_encode(['success' => 0, 'msg' => "Enter Album Name."]);
            return (false);
        }else if(strlen($albname) > 100 ){
            echo json_encode(['success' => 0, 'msg' => "Only 100 Characters allowed."]);
            return (false);
        }

        $regex = "/^[a-zA-Z 0-9]+$/";
        if(!(preg_match($regex, $albname))){
            echo json_encode(['success' => 0, 'msg' => "Enter Correct Album Name."]);
            return (false);
        }

        $sql="SELECT * FROM `album` WHERE `Name`='$albname'";

        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            echo json_encode(['success' => 0, 'msg' => "Album Already Exists."]);
            return (false);
        }

        $sql="INSERT INTO `album`(`Name`) VALUES ('$albname')";
        
        $result=mysqli_query($link,$sql);
        if($result){
            $sql="SELECT * FROM `album` ORDER BY `Album_ID` ASC";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
            <th>Album ID</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
            </tr>';
            $list ='<option value="" selected>Select Album</option>';
            foreach($result as $row){
                $list = $list . '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                $table = $table . '<tr>
                    <td>' . $row["Album_ID"] . '</td>
                    <td class="albcontentname" contenteditable>' . $row["Name"] . '</td>
                    <td id="albm' . $row["Album_ID"] . '" onclick="albmupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                    <td id="albm' . $row["Album_ID"] . '" onclick="albmdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                </tr>';
            }            
            echo json_encode(['success' => 1, 'msg' => "Album Added.", 'tbldata' => $table, 'listdata' => $list]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Ablum Entry Failed."]);
            return (false);
        }
    }

    if(isset($_POST['Valbmupdtid'])){
        $albname = trim($_POST['Valbmupdtnam']);
        $albid = trim($_POST['Valbmupdtid']);
        
        $regex = "/^[a-zA-Z 0-9]+$/";
        if(!(preg_match($regex, $albname))){
            echo json_encode(['success' => 0, 'msg' => "Enter Correct Album Name."]);
            return (false);
        }

        if(strlen($albname) > 100 ){
            echo json_encode(['success' => 0, 'msg' => "Only 100 Characters allowed."]);
            return (false);
        }

        $sql="SELECT * FROM `album` WHERE `Name`='$albname'";

        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            echo json_encode(['success' => 0, 'msg' => "Album Already Exists."]);
            return (false);
        }

        $sql="UPDATE `album` SET `Name`='$albname' WHERE `Album_ID`='$albid'";

        $result=mysqli_query($link,$sql);
        if($result){
            $sql="SELECT * FROM `album` ORDER BY `Album_ID` ASC";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
            <th>Album ID</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
            </tr>';
            $list ='<option value="" selected>Select Album</option>';
            foreach($result as $row){
                $list = $list . '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                $table = $table . '<tr>
                    <td>' . $row["Album_ID"] . '</td>
                    <td class="albcontentname" contenteditable>' . $row["Name"] . '</td>
                    <td id="albm' . $row["Album_ID"] . '" onclick="albmupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                    <td id="albm' . $row["Album_ID"] . '" onclick="albmdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                </tr>';
            }            
            echo json_encode(['success' => 1, 'msg' => "Album Name Updated.", 'tbldata' => $table, 'listdata' => $list]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Updation Failed."]);
            return (false);
        }
    }

    if(isset($_POST['Valbmdel'])){
        $albid = trim($_POST['Valbmdel']);

        $sql="DELETE FROM `album` WHERE `Album_ID`='$albid'";

        $result=mysqli_query($link,$sql);
        if($result){
            $sql="SELECT * FROM `album` ORDER BY `Album_ID` ASC";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
            <th>Album ID</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
            </tr>';
            $list ='<option value="" selected>Select Album</option>';
            foreach($result as $row){
                $list = $list . '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                $table = $table . '<tr>
                    <td>' . $row["Album_ID"] . '</td>
                    <td class="albcontentname" contenteditable>' . $row["Name"] . '</td>
                    <td id="albm' . $row["Album_ID"] . '" onclick="albmupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                    <td id="albm' . $row["Album_ID"] . '" onclick="albmdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                </tr>';
            }            
            echo json_encode(['success' => 1, 'msg' => "Album Deleted.", 'tbldata' => $table, 'listdata' => $list]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Deletion Failed."]);
            return (false);
        }
    }

    if(isset($_POST['ArtName'])){
        $artname = trim($_POST['ArtName']);

        if($artname == ""){
            echo json_encode(['success' => 0, 'msg' => "Enter Artist Name."]);
            return (false);
        }else if(strlen($artname) > 100 ){
            echo json_encode(['success' => 0, 'msg' => "Only 100 Characters allowed."]);
            return (false);
        }

        $regex = "/^[a-zA-Z 0-9]+$/";
        if(!(preg_match($regex, $artname))){
            echo json_encode(['success' => 0, 'msg' => "Enter Correct Artist Name."]);
            return (false);
        }
        
        $sql="SELECT * FROM `artist` WHERE `Name`='$artname'";

        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            echo json_encode(['success' => 0, 'msg' => "Artist Already Exists."]);
            return (false);
        }

        $sql="INSERT INTO `ARTIST`(`Name`) VALUES ('$artname')";
        
        $result=mysqli_query($link,$sql);
        if($result){
            $sql="SELECT * FROM `artist` ORDER BY `Artist_ID` ASC";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
            <th>Artist ID</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
            </tr>';
            $list = '<select name="artist" id="artist" multiple name="native-select" placeholder="Select Artist" data-silent-initial-value-set="true">';
            foreach($result as $row){
                $list .= '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                $table = $table . '<tr>
                    <td>' . $row["Artist_ID"] . '</td>
                    <td class="artcontentname" contenteditable>' . $row["Name"] . '</td>
                    <td id="art' . $row["Artist_ID"] . '" onclick="artupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                    <td id="art' . $row["Artist_ID"] . '" onclick="artdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                </tr>';
            }            
            echo json_encode(['success' => 1, 'msg' => "Artist Added.", 'tbldata' => $table, 'listdata' => $list]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Artist Entry Failed."]);
            return (false);
        }
    }

    if(isset($_POST['Vartupdtid'])){
        $artname = trim($_POST['Vartupdtnam']);
        $artid = trim($_POST['Vartupdtid']);

        $regex = "/^[a-zA-Z 0-9]+$/";
        if(!(preg_match($regex, $artname))){
            echo json_encode(['success' => 0, 'msg' => "Enter Correct Artist Name."]);
            return (false);
        }

        if(strlen($artname) > 100 ){
            echo json_encode(['success' => 0, 'msg' => "Only 100 Characters allowed."]);
            return (false);
        }

        $sql="SELECT * FROM `artist` WHERE `Name`='$artname'";

        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            echo json_encode(['success' => 0, 'msg' => "Artist Already Exists."]);
            return (false);
        }

        $sql="UPDATE `artist` SET `Name`='$artname' WHERE `Artist_ID`='$artid'";

        $result=mysqli_query($link,$sql);
        if($result){
            $sql="SELECT * FROM `artist` ORDER BY `Artist_ID` ASC";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
            <th>Album ID</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
            </tr>';
            $list = '<select name="artist" id="artist" multiple name="native-select" placeholder="Select Artist" data-silent-initial-value-set="true">';
            foreach($result as $row){
                $list .= '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                $table = $table . '<tr>
                    <td>' . $row["Artist_ID"] . '</td>
                    <td class="artcontentname" contenteditable>' . $row["Name"] . '</td>
                    <td id="albm' . $row["Artist_ID"] . '" onclick="artupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                    <td id="albm' . $row["Artist_ID"] . '" onclick="artdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                </tr>';
            }
            echo json_encode(['success' => 1, 'msg' => "Artist Name Updated.", 'tbldata' => $table, 'listdata' => $list]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Updation Failed."]);
            return (false);

        }
    }

    if(isset($_POST['Vartdel'])){
        $artid = trim($_POST['Vartdel']);

        $sql="DELETE FROM `artist` WHERE `Artist_ID`='$artid'";

        $result=mysqli_query($link,$sql);
        if($result){
            $sql="SELECT * FROM `artist` ORDER BY `Artist_ID` ASC";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
            <th>Album ID</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
            </tr>';
            $list = '<select name="artist" id="artist" multiple name="native-select" placeholder="Select Artist" data-silent-initial-value-set="true">';
            foreach($result as $row){
                $list .= '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                $table = $table . '<tr>
                    <td>' . $row["Artist_ID"] . '</td>
                    <td class="artcontentname" contenteditable>' . $row["Name"] . '</td>
                    <td id="albm' . $row["Artist_ID"] . '" onclick="artupdt(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Update</a></td>
                    <td id="albm' . $row["Artist_ID"] . '" onclick="artdel(this.id)"><a href="javascript:{};" onmouseover = "this.style.color = \'#fcffff\'" onmouseout  = "this.style.color = \'#e714db\'" style="color: rgb(231, 20, 219);">Delete</a></td>
                </tr>';
            }            
            echo json_encode(['success' => 1, 'msg' => "Artist Deleted.", 'tbldata' => $table, 'listdata' => $list]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Deletion Failed."]);
            return (false);
        }
    }

    if(isset($_POST['Usrupdt'])){
        $sql="SELECT * FROM `users`";

        $result=mysqli_query($link,$sql);
        $table = '<tr>
        <th title="User ID" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">User ID</th>
        <th title="Name" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Name</th>
        <th title="Email" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Email</th>
        <th title="Contact" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Contact</th>
        <th title="Address" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Address</th>
        <th title="Gender" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Gender</th>
        <th title="Image" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Image</th>
        <th title="Action" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Action</th>
        </tr>';

        foreach($result as $row){
            $table = $table . '<tr>
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
        echo json_encode(['tbldata' => $table]);
        return (true);
    }

    if(isset($_POST['stitle'])){
        $stitle = trim($_POST['stitle']);
     
        $lang = $_POST['lang'];
        $mmyy = $_POST['mmyy'];
        $gen = $_POST['gen'];
        if($_POST['artist_count'] > 0){
            for ($i=0; $i < $_POST['artist_count']; $i++) { 
                $artist[] = $_POST['artist' . $i];        
            }
        }else{
            $artist = "";
        }
        $album = $_POST['album'];
        
        if(isset($_FILES['vafile'])){
            // Check if video/audio file is a actual video/audio or fake video/audio
            $vafile_type = mime_content_type($_FILES["vafile"]["tmp_name"]);
            $vafile_type = explode("/",$vafile_type);
            if($vafile_type[0] == "audio" || $vafile_type[0] == "video"){
                $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'. strtolower(DB_NAME) .'" AND TABLE_NAME = "videos_songs"';
                $result = mysqli_query($link,$sql);
                $row = mysqli_fetch_assoc($result);
                $avprefix = $vafile_type[0] == "audio" ? "A" : "V";
                $pattern = '/[ ]/';
                $vafile = preg_replace($pattern, '_', $avprefix.$row['AUTO_INCREMENT'].$stitle) . "." . pathinfo($_FILES['vafile']['name'], PATHINFO_EXTENSION);
            }else{
                echo json_encode(['success' => 0, 'msg' => "Unknown Video/Audio Format."]);
                return (false);
            }
            // Allow certain file formats
            $vafile_ext = strtolower(pathinfo($_FILES['vafile']['name'],PATHINFO_EXTENSION));
            if($vafile_ext != "mp3" && $vafile_ext != "mp4") {
                echo json_encode(['success' => 0, 'msg' => "Upload MP3 or MP4 formats."]);
                return (false);
            }
            // Check file size
            if ($_FILES["vafile"]["size"] > 50000000) {
                echo json_encode(['success' => 0, 'msg' => "Song file size must be under 50MB."]);
                return (false);
            }
            move_uploaded_file($_FILES['vafile']['tmp_name'], $path . $vafile);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Song Upload Failed."]);
            return (false);
        }

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
            $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'. strtolower(DB_NAME) .'" AND TABLE_NAME = "videos_songs"';
            $result = mysqli_query($link,$sql);
            $row = mysqli_fetch_assoc($result);
            $pattern = '/[ ]/';
            $photo = preg_replace($pattern, '_', $row['AUTO_INCREMENT'].$stitle) . "." . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['photo']['tmp_name'], $path2 . $photo);
        }else{
            switch ($vafile_type[0]){
                case 'audio':
                    $photo = "audio.jpg";
                    break;
                
                case 'video':
                    $photo = "video.jpg";
                    break;
            }
        }

        $sql = "SELECT * FROM `album` WHERE `Name` = '$album'";
        $result=mysqli_query($link,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $album = $row['Album_ID'];
            $sql="INSERT INTO `videos_songs`(`Title`, `Language`, `Year`, `Genre`, `Album_ID`, `photo`, `URLs`) VALUES ('$stitle','$lang','$mmyy','$gen','$album','$photo','$vafile')";
        }else{
            $sql="INSERT INTO `videos_songs`(`Title`, `Language`, `Year`, `Genre`, `photo`, `URLs`) VALUES ('$stitle','$lang','$mmyy','$gen','$photo','$vafile')";
        }
        $result=mysqli_query($link,$sql);
        if($result){
            if($_POST['artist_count'] > 0){
                $sql = "SELECT * FROM `videos_songs` WHERE `VS_ID`=(SELECT MAX(`VS_ID`) FROM `videos_songs`)";
                $result=mysqli_query($link,$sql);
                $row = mysqli_fetch_assoc($result);
                $song_id = $row['VS_ID'];
                foreach ($artist as $value) {
                    $sql = "SELECT * FROM `artist` WHERE `Name` = '$value'";
                    $result=mysqli_query($link,$sql);
                    $row = mysqli_fetch_assoc($result);
                    if(isset($row['Artist_ID'])){
                        $artist_id = $row['Artist_ID'];
                        $sql = "INSERT INTO `song_artist`(`Artist_ID`, `VS_ID`) VALUES ($artist_id,$song_id)";
                        $result=mysqli_query($link,$sql);
                    }
                }
            }

            $sql="SELECT videos_Songs.VS_ID,videos_Songs.Title,videos_Songs.Language,videos_Songs.Year,videos_Songs.Genre,videos_Songs.photo,videos_Songs.URLs,ALBUM.Name
            FROM videos_Songs LEFT JOIN ALBUM
            ON videos_Songs.Album_ID=ALBUM.Album_ID
            ORDER BY videos_Songs.VS_ID";
            $result = mysqli_query($link,$sql);
            $table = '<tr>
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
            </tr>';
            foreach($result as $row){
                $table .= '<tr><td style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["VS_ID"] . '</td>
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
                $table .= '<td title="' . $artists . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $artists . '</td>
                <td title="' . $row["Name"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["Name"] . '</td>
                <td title="' . $row["photo"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["photo"] . '</td>
                <td title="' . $row["URLs"] . '"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">' . $row["URLs"] . '</td>
                <td title="view"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">View</td>
                <td title="edit"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Edit</td>
                <td title="delete"style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Delete</td>
                </tr>';
            }

            echo json_encode(['success' => 1, 'msg' => "Song Added.", 'tbldata' => $table]);
            return (true);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Song Entry Failed."]);
            return (false);
        }

    }
}else{
    header("location:admin.php");
}
?>