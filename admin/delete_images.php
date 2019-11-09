<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("albums.php");
} else {
    $images = Image::find_album_images($_GET['id']);
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
            Delete Photos
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-th"></i>  <a href="albums.php">Albums</a>
            </li>
            <li>
                <i class="fa fa-image"></i>  <a href="view_images.php?id=<?php echo $_GET['id']; ?>">View Album</a>
            </li>
            <li class="active">
                <i class="fa fa-picture-o"></i> Delete Photos
            </li>
        </ol>
        <p class="bg-success"><?php echo $message; ?></p>

        <div class="row">
            <?php foreach ($images as $image) : ?>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel">
                            <div class="panel-heading text-center">
                            <img class="admin-photos-thumbnail" src="<?php echo $image->picture_path(); ?>" alt="">
                            </div>
                                <div class="panel-footer">
                                <a class="delete_link btn btn-danger btn-block" href="delete_image.php?id=<?php echo $image->id; ?>&album_id=<?php echo $_GET['id']; ?>"><i class="fa fa-trash"></i> Delete</a>
                                    <div class="clearfix"></div>
                                </div>
                             
                            </div>
                         </div>                                
                 <?php endforeach; ?> 
          </div> 
          <hr>
    <a class="btn btn-primary" href="view_images.php?id=<?php echo $_GET['id']; ?>">Done</a>
    </div>

</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>