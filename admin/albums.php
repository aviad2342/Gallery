<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php");} ?>

<?php 

$albums = Album::find_user_albums($session->user_id);


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
                    Albums
                    <small>Your Albums</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-th"></i> Albums
                    </li>
                </ol>
                <p class="bg-success"><?php echo $message; ?></p>
                <a href="create_album.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New Album</a>
                <br><br>
         <div class="row">
            <?php foreach ($albums as $album) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9 text-left">
                                        <div class="huge"><?php echo $album->title; ?></div>
                                        <div><span class="glyphicon glyphicon-time"></span> Created at <?php echo $album->getDate(); ?></div>
                                    </div>
                                    <div class="col-xs-3">
                                        <i class="fa fa-image fa-5x"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="view_images.php?id=<?php echo $album->id; ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span> 
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                             </a>
                            </div>
                         </div>                                
                 <?php endforeach; ?> 
          </div>       
         </div>
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>