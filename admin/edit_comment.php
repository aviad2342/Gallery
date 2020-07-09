<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

if(empty($_GET['id'])) {
    redirect("comments.php");
} 
$comment = Comment::find_by_id($_GET['id']);


if(isset($_POST['update'])) {
    if($comment) {
        $comment->date = date("Y-m-d H:i:s");
        $comment->body = $_POST['body'];

        if($comment->save()) {
            redirect("comments.php");
            $session->message("<i class='fa fa-check'></i> The album: <strong>{$album->title}</strong> was successfully updated");
        } else {
            redirect("comments.php");
            $session->message("<i class='fa fa-check'></i> The comment: <strong>{$comment->id}</strong> updat failed!!");
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
            Edit Comment
            <small>Edit Your Comment</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-comment"></i>  <a href="comments.php">Comments</a>
            </li>
            <li class="active">
            <i class="fa fa-comment"></i>  Edit Comments
            </li>
        </ol>


    <h4>Edit Comment</h4>
         <form role="form" method="post">
            <div class="form-group">
                <input type="text" name="author" class="form-control" value="<?php echo $comment->author_name; ?>" disabled>
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" rows="3"><?php echo $comment->body; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
      </form> <!-- End of form -->
   </div>
</div> <!-- /.row -->

</div> <!-- /.container-fluid -->

        </div> <!-- /#page-wrapper -->

        <!-- Photos Gallery Modal -->
        <?php include("includes/photos_gallery.php") ?>

  <?php include("includes/footer.php"); ?>