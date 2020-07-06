<?php include("includes/header.php"); ?>
<?php

require_once("admin/includes/init.php");

if(empty($_GET['id'])) {
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);
$user = User::find_by_id($session->user_id);
$user_full_name = $user->first_name." ".$user->last_name;

if(isset($_POST['submit'])) {
    $body = trim($_POST['body']);
    $date = date('Y-m-d H:i:s');

    $new_comment = Comment::newComment($photo->id, $user->id, $user_full_name, $date, $body);

    if($new_comment && $new_comment->save()) {
        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "no go!";
    }
} else {
    $author = "";
    $body = "";
}

$comments = Comment::find_comments_photo($photo->id);

?>

        <div class="row">
            <div class="col-lg-12">

                <!-- Title -->
                <h1 class="text-center"><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="admin/user_profile.php?id=<?php echo $photo->author_id; ?>"><?php echo $photo->author_name; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $photo->getDate(); ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-head img-rounded mx-auto d-block img-thumbnail img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>
                
                <hr>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <input type="text" name="author" class="form-control" value="<?php echo $user_full_name; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php foreach ($comments as $comment): ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="comment-avatar img-thumbnail img-circle" src="admin/<?php echo User::find_by_id($comment->author_id)->getProfilePicture(); ?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="comment-title media-heading"><?php echo $comment->author_name; ?>  
                            <small><span class="glyphicon glyphicon-time"></span> <?php echo $comment->getDate(); ?> </small>
                        </h4>
                        <?php echo $comment->body; ?> 
                    </div>
                </div>
              <?php endforeach ?> 
            </div>
        </div><!-- /.row -->
            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->

            
                 <?php //include("includes/sidebar.php"); ?>



        <!-- </div> -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
