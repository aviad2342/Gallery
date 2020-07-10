<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("albums.php");
} else {
    $album = Album::find_by_id($_GET['id']);
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
                View Album
                    <small>Manage Album</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-th"></i>  <a href="albums.php">Albums</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-image"></i> View Album
                    </li>
                </ol>

                <div class="text-center">
                    <!-- Title -->
                    <h1 class="album-title"><?php echo $album->title; ?></h1>
                    <p><?php echo $album->description; ?></p>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                    <hr>
                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Created At <?php echo $album->getDate(); ?></p>
                    </div>
                </div>
                
                <br>
                <div class='container well well-lg'>
                    <div class="gallery">
                    <?php foreach ($images as $image) : ?>
                        <!-- Image -->
                        <a href="<?php echo $image->picture_path(); ?>">
                            <img src="<?php echo $image->picture_path(); ?>" alt="" title=""/>
                        </a>
                        <?php endforeach; ?> 
                    </div>
                </div>
               
                    <div class="action_links pull-right">
                            <br>
                            <a class="btn btn-primary" href="edit_album.php?id=<?php echo $album->id; ?>"><i class="fa fa-pencil"></i> Edit Album</a>
                            <a class="btn btn-warning" href="add_images.php?id=<?php echo $album->id; ?>"><i class="fa fa-plus-circle"></i> Add Photos</a>
                            <a class="btn btn-danger" href="delete_images.php?id=<?php echo $album->id; ?>"><i class="fa fa-minus-circle"></i> Delete Photos</a>
                    </div> 
                              
         </div>
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>