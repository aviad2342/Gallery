<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

$comments = Comment::find_all();


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
            Comments
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-comment"></i> Comments
            </li>
        </ol>
        <?php if(!empty($message)) : ?>
            <p class="bg-success"><?php echo $message; ?></p>
        <?php endif; ?> 
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td><?php echo $comment->id; ?></td>  
                        <td><?php echo $comment->author_name; ?>
                            <div class="action_links">
                                <br>
                                <?php if($comment->author_id === $session->user_id) : ?>
                                    <a class="btn btn-warning" href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a>
                                <?php endif; ?> 
                                <a class="btn btn-danger" href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                            </div>
                        </td>
                        <td><?php echo $comment->getDate(); ?></td>
                        <td><?php echo $comment->body; ?></td>
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