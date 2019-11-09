<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

$photos = Photo::find_all();


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
            Photos
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-picture-o"></i> Photos
            </li>
        </ol>
        <p class="bg-success"><?php echo $message; ?></p>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>File Name</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($photos as $photo) : ?>
                    <tr>
                        <td><img class="admin-photos-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="">
                            <div class="action_links">
                            <br>
                                <a class="btn btn-primary" href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                <a class="btn btn-warning" href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                <a class="delete_link btn btn-danger" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                            </div>
                        </td>
                        <td><?php echo $photo->id; ?></td>
                        <td><?php echo $photo->title; ?></td>
                        <td><?php echo $photo->description; ?></td>
                        <td><?php echo $photo->filename; ?></td>
                        <td>
                            <?php
                            $comments = Comment::find_Comments_photo($photo->id);
                             ?>
                             <a class="btn btn-primary" href="photo_comment.php?id=<?php echo $photo->id; ?>">Watch Comments <span class="badge badge-light"><?php echo count($comments); ?></span></a>
                        </td>
                    </tr>
                  <?php endforeach; ?> 
                </tbody>
            </table> <!-- End of table -->
        </div>

    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>