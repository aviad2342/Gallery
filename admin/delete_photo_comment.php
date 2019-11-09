<?php include("includes/init.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    $comment->delete();
    $session->message("<i class='fa fa-check'></i> The comment was successfully deleted");
    redirect("photo_comment.php?id={$comment->photo_id}");
} else {
    redirect("comments.php");
}

?>