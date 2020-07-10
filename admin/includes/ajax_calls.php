<?php require("init.php"); ?>
<?php 

$user = new User();

if(isset($_POST['image_name'])) {
    $user->update_image_from_gallery($_POST['image_name'], $_POST['user_id']);
}

if(isset($_POST['photo_id'])) {
    $photo = Photo::find_by_id($_POST['photo_id']);
}

if(isset($_GET['username'])) {
    $user = User::find_by_username($_GET['username']);
    if(empty($user)){
        print DEFAULT_PROFILE_PICTURE;
    } else {
        print $user->getProfilePicture();
    }
    
}

?>