<?php include("includes/header.php"); ?>

<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("albums.php");
} else {
    $album = Album::find_by_id($_GET['id']);

    if(isset($_POST['update'])) {
        $album->title = $_POST['title'];
        $album->description = $_POST['description'];
         
        if($album->save()) {
            redirect("albums.php");
            $session->message("<i class='fa fa-check'></i> The album: <strong>{$album->title}</strong> was successfully updated");
        } else {
            redirect("albums.php");
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
        Edit Album
            <small>Edit Your Album</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-th"></i>  <a href="albums.php">Albums</a>
            </li>
            <li class="active">
                <i class="fa fa-pencil"></i> Edit Album
            </li>
        </ol>
        <div class="row">
        <div class="col-md-6">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $album->title; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo $album->description; ?></textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="update" value="Update">
        </form>
       </div>
      </div> <!-- /.row -->
    </div>
</div> <!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>