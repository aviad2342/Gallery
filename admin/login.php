<?php require_once("includes/header.php"); ?>

<?php 

if($session->isSignedIn()) {
    redirect("index.php");
}

if(isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check database user
    $user = User::verify_user($username, $password);

    if($user) {
        $session->login($user);
        redirect("index.php");
    } else {
        $login_error_message = "Invalid username or password";
    }

} else {
    $login_error_message = "";
    $username = "";
    $password = "";
}

//<?php echo $login_error_message; 
?>

<div class="col-md-4 col-md-offset-3">

<form id="login-id" action="" method="post">
<div class="panel-heading text-center">
    <img class="login-profile-image-img img-circle img-thumbnail img-responsive" src="<?php echo DEFAULT_PROFILE_PICTURE; ?>" alt="" id="loginProfileImage">
</div>
<div class="input-group input-group-lg">
  <span class="input-group-addon">
    <span class="glyphicon glyphicon-user"></span>
  </span>
  <input type="text" class="form-control" name="username" id="loginUserName"
    value="<?php echo htmlentities($username); ?>" placeholder="Enter username" require>
</div>
<br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">
    <span class="glyphicon glyphicon-lock"></span>
  </span>
  <input type="password" class="form-control" name="password" 
    value="<?php echo htmlentities($password); ?>" placeholder="Enter password" require>
</div> 


<h4 class="bg-danger"><?php echo $login_error_message; ?></h4>

<div class="form-group">
<input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
</div>
</form>
</div>
<?php include("includes/footer.php"); ?>