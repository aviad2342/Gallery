<?php require("init.php"); ?>
<?php 

$user = new User();

if(isset($_POST['image_name'])) {
    $user->update_image_from_gallery($_POST['image_name'], $_POST['user_id']);
}

if(isset($_POST['photo_id'])) {
    $photo = Photo::find_by_id($_POST['photo_id']);
}

?>