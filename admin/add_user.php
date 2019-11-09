<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 
//user
$user = new User();

if(isset($_POST['create'])) {
    if($user) {
        $user->username   = $_POST['username'];
        $user->email = $_POST['email'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->password   = $_POST['password'];

        if(isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture']['name'])) {
            $user->set_file($_FILES['profile_picture']);
        }
        $user->saveUser();
        $session->message("<i class='fa fa-check'></i> The user: <strong>{$user->first_name}  {$user->last_name}</strong> was successfully added");
        redirect("users.php");

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
            Add User
            <small>Create A New User</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-users"></i>  <a href="users.php">Users</a>
            </li>
            <li class="active">
            <i class="fa fa-user"></i>  Add User
            </li>
        </ol>
        <div class="row">
        <div class="col-md-2" style="min-width: 25%;">
        <img id="preview-image" class="img-responsive update-Profile-Picture img-thumbnail" src="" alt="">
        </div>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="col-md-6">
            <div class="form-group">
            <button id="btn_choose_image" type="button" class="btn btn-info"><span class="glyphicon glyphicon-folder-open"></span>  Choose Image...</button>
                <input id="image_picker" type="file" name="profile_picture" onchange="readURL(this);">
            </div>
            <div class="form-group">
                 <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input type="text" name="username" class="form-control" placeholder="User Name">
                </div> 
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        @
                    </span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" onblur="ValidateEmail('email')" onfocus="focusFunction()">
                </div> 
                <span class="toggle"><small class="text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> invalid email address</small></span>
            </div>
            <div class="form-group">
                <div class='input-group input-group-lg date' id='datetimepicker'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type='date' name="date" class="form-control" value="1984-10-25"/> 
                </div>
            </div>
            <div class="form-group">
                <div class="form-inline">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </span>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name">
                    </div> 
                    <div class="input-group input-group-lg col-lg-offset-1">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </span>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-eye-close"></span>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div> 
            </div>
            <div class="form-group">
                <input type="submit" name="create" class="btn btn-primary pull-right" value="Submit">
            </div>
        </div>

    </form> <!-- End of form -->
    </div>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>