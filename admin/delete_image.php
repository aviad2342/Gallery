<?php include("includes/init.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id']) || empty($_GET['album_id'])) {
    redirect("albums.php");
}

$image = Image::find_by_id($_GET['id']);


if($image->delete_photo()) {
    $session->message("<i class='fa fa-check'></i> The image was successfully deleted");
    redirect("delete_images.php?id={$_GET['album_id']}");
} else {
    $session->message("<i class='fa fa-times'></i> Failed to delete image");
    redirect("delete_images.php?id={$_GET['album_id']}");
}

?>