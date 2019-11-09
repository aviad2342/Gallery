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
    redirect("comments.php");
} else {
    redirect("comments.php");
}

?>