<?php include("includes/init.php"); ?>

<?php 

if(empty($_GET['id'])) {
    redirect("../inbox.php");
}

$message = Message::find_by_id($_GET['id']);


if($message) {
    if($message->delete()){
        $session->message("<i class='fa fa-check'></i> The message was successfully deleted");
        redirect("../inbox.php");
    } else {
        $session->message("<i class='fa fa-times'></i> Failed to delete message");
        redirect("../inbox.php");
    }
} else {
    $session->message("<i class='fa fa-times'></i> Failed to delete message");
    redirect("../inbox.php");
}

?>