<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("users.php");
} 
$user = User::find_by_id($_GET['id']);


if(isset($_POST['update'])) {
    if($user) {
        $user->username   = $_POST['username'];
        $user->email      = $_POST['email'];
        $user->date      = $_POST['date'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->password   = $_POST['password'];

        if(isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
            $user->set_file($_FILES['profile_picture']);
            $user->saveUser();
        } else {
            $user->save();
        }      
        redirect("users.php");
        $session->message("<i class='fa fa-check'></i> The user: <strong>{$user->first_name}  {$user->last_name}</strong> was successfully updated");
    }
}
    

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php include("includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include("includes/side_nav.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview-image')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <div id="page-wrapper">

        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit User
            <small>Update User Details</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer-alt"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-users"></i>  <a href="users.php">Users</a>
            </li>
            <li class="active">
            <i class="fa fa-user"></i>  Edit User
            </li>
        </ol>

        <div class="col-md-3">
           <a href="#" data-toggle="modal" data-target="#photo-gallery-modal"><img id="preview-image" class="img-responsive update-Profile-Picture img-thumbnail" src="<?php echo $user->getProfilePicture(); ?>" alt=""></a> 
        </div>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="col-md-6">
            <div class="form-group">
                <!-- <input id="btn_choose_image" type="button" class="btn btn-info" value="Choose Image..."> -->
                <button id="btn_choose_image" type="button" class="btn btn-info"><span class="glyphicon glyphicon-folder-open"></span>  Choose Image...</button> 
                <input id="image_picker" type="file" name="profile_picture" onchange="readURL(this);">
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $user->first_name; ?>">
                 </div> 
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $user->last_name; ?>">
                </div> 
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $user->username; ?>">
                </div> 
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        @
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $user->email; ?>">
                </div> 
            </div>
            <div class="form-group">
                <div class='input-group input-group-lg date' id='datetimepicker'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type='date' name="date" class="form-control" value="<?php echo $user->date; ?>"/> 
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="Click to show password"  onclick="revealPassword()">
                        <span id="passwordIcon" class="glyphicon glyphicon-eye-close"></span>
                    </span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password" value="<?php echo $user->password; ?>">
                </div> 
            </div>
            <div class="form-group">
            <?php if($user->id != $session->user_id) : ?>
                <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                <?php endif; ?> 
                <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
            </div>
        </div>

    </form> <!-- End of form -->

   </div>
</div> <!-- /.row -->

</div> <!-- /.container-fluid -->

        </div> <!-- /#page-wrapper -->

        <!-- Photos Gallery Modal -->
        <?php include("includes/photos_gallery.php") ?>

  <?php include("includes/footer.php"); ?>