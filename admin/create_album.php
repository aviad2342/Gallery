<?php include("includes/header.php"); ?>

<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

$message = "";

$user = User::find_by_id($session->user_id);
$user_full_name = $user->first_name." ".$user->last_name;
$date = date('Y-m-d H:i:s');

if(isset($_POST['submit'])) {
    $album = new Album();
    $album->title = $_POST['title'];
    $album->author_id = $user->id;
    $album->author_name = $user_full_name;
    $album->date = $date;
    $album->description = $_POST['description'];

    //$album->save();
    
    if($album->save()) {
        redirect("upload_images.php?id={$album->id}");
    } else {
        $message = join("<br>", $photo->errors);
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
            Create Album
            <small>Upload Image</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer-alt"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-th"></i>  <a href="albums.php">Albums</a>
            </li>
            <li class="active">
                <i class="fa fa-upload"></i> Create Album
            </li>
        </ol>
        <div class="row">
        <div class="col-md-6">
        <?php echo $message; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Continue">
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