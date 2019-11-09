<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("albums.php");
} else {
    $user = User::find_by_id($_GET['id']);
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

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    User Profile
                    <small>View User Details</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-users"></i>  <a href="users.php">Users</a>
                    </li>
                    <li class="active">
                    <i class="fa fa-user"></i>  User Profile
                    </li>
                </ol>

                <div class="row">
                    <div class="col-lg-4 col-lg-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                <img class="profile-image-img img-circle img-thumbnail img-responsive" src="<?php echo $user->getProfilePicture(); ?>" alt="">
                                <h3><?php echo $user->first_name . " " .$user->last_name; ?></h3>
                             </div>
                            <div class="panel-body">
                                <h3><label for=""><span class="glyphicon glyphicon-user"></span> UserName:</label> <?php echo $user->username; ?></h3>
                                <h3><label for=""><span class="glyphicon glyphicon-envelope"></span> Email:</label> <?php echo $user->email; ?></h3>
                                <h3><label for=""><span class="glyphicon glyphicon-user"></span> Age:</label> <?php echo $user->user_age(); ?></h3>
                             </div> 
                            <div class="panel-footer">
                            <h3><label for=""><span class="glyphicon glyphicon-th"></span> Albums:</label> <?php echo Album::countRecords($user->id); ?></h3>
                             </div>
                        </div>
                    </div>
                </div>

             </div>

         </div> <!-- /.row -->

     </div> <!-- /.container-fluid -->

</div><!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>