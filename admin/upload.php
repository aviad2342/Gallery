<?php include("includes/header.php"); ?>

<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

$message = "";

$user = User::find_by_id($session->user_id);
$user_full_name = $user->first_name." ".$user->last_name;

if(isset($_POST['submit'])) {
    $date = date('Y-m-d H:i:s');
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->author_id = $user->id;
    $photo->author_name = $user_full_name;
    $photo->date = $date;
    $photo->description = $_POST['description'];
    $photo->set_file($_FILES['profile_picture']);

    if($photo->save()) {
        redirect("photos.php");
        $session->message("<i class='fa fa-check'></i> The photo: <strong>{$photo->title}</strong> was successfully deleted");
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
            Upload
            <small>Upload Image</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer-alt"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-upload"></i> Uploade
            </li>
        </ol>
        <div class="row">
        <div class="col-md-3">
            <img id="preview-image" class="img-responsive update-Profile-Picture img-thumbnail" src="" alt="">
        </div>
        <div class="col-md-6">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <input id="btn_choose_image" type="button" class="btn btn-info" value="Choose Image..."> 
                <input id="image_picker" type="file" name="profile_picture" onchange="readURL(this);">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="submit">
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