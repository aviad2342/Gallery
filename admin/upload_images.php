<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

$message = "";

if(empty($_GET['id'])) {
    redirect("albums.php");
} else {
    $album_id = $_GET['id'];
    $date = date('Y-m-d H:i:s');

    if(isset($_FILES['file'])) {
        $image = new Image();
        $image->album_id = $album_id;
        $image->date = $date;
        $image->set_file($_FILES['file']);
    
        if($image->save()) {
            redirect("albums.php");
        } else {
            $message = join("<br>", $photo->errors);
        }
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

        <div id="page-wrapper">

        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
         Upload Images
            <small>Upload Image</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-dashboard"></i>  <a href="albums.php">Albums</a>
            </li>
            <li class="active">
                <i class="fa fa-upload"></i> Upload Images
            </li>
        </ol>
        <div class="row">
        <div class="col-md-6">
        <?php echo $message; ?>
        <form action="upload_images.php?id=<?php echo $album_id ?>" class="dropzone">
        </form>
        <br>
        <a class="btn btn-primary" href="albums.php">Done</a>
       </div>
      </div> <!-- /.row -->

    </div>
</div> <!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>