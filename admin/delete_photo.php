<?php include("includes/init.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

$comments = Comment::find_Comments_photo($_GET['id']);

if($photo) {
    if($comments) {
        foreach ($comments as $comment) {
            $comment->delete();
        }
    }
    $photo->delete_photo();
    $session->message("<i class='fa fa-check'></i> The photo: <strong>{$photo->title}</strong> was successfully deleted");
    redirect("photos.php");
} else {
    redirect("photos.php");
}

?>