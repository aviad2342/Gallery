<?php include("includes/init.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if($user) {
    $user->delete_user_and_profile_picture();
    $session->message("<i class='fa fa-check'></i> The user: <strong>{$user->first_name}  {$user->last_name}</strong> was successfully deleted");
    redirect("users.php");
} else {
    $session->message("<i class='fa fa-times'></i> Failed to delete user: <strong>{$user->first_name}  {$user->last_name}</strong>");
    redirect("users.php");
}

?>