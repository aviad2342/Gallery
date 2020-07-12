<?php require_once("admin/includes/init.php"); ?>
<?php 

if(empty($_GET['id'])) {
    redirect("inbox.php");
} 

$message = Message::find_by_id($_GET['id']);

$message->is_new = false;
$message->update();

$from_user = User::find_by_id($message->author_id);
$to_user = User::find_by_id($message->user_id);



?>

<?php include("includes/inbox-header.php"); ?>

 <div class="mail-box">
                    <!-- Inbox Sidebar -->
                    <?php include("includes/inbox-sidebar.php") ?>

                  <aside class="lg-side">
                  <!-- Navigation -->
                        <?php include("includes/inbox-navigation.php") ?>
                        <hr>
                          <div class="row">
                            <div class="col-md-12">
                                <section>
                                    <h3><?php echo $message->title; ?></h3>
                                </section>
                                <hr>
                                <div class="mini all">
                                    <header>
                                        <section>
                                            <small><strong>Date:</strong>  <?php echo $message->getDate(); ?></small>
                                            <br>
                                            <small><strong>From:</strong> <?php echo $from_user->get_user_full_name(). "<".$from_user->email.">"; ?></small>
                                            <br>
                                            <small><strong>To:</strong> <?php echo $to_user->get_user_full_name(); ?></small>
                                        </section>
                                    </header>
                                    <hr>
                                </div>
                                <div>
                                    <body>
                                        <section>
                                            <p><?php echo $message->content; ?></p>
                                        </section>
                                    </body>
                                </div>
                                <hr>
                                <div class="footer">
                                    <section>
                                        <footer>
                                            <a href="inbox.php" class="btn btn-info"><i class="fa fa-undo"></i> Back</a>
                                            <a href="admin/delete_message.php?id=<?php echo $message->id; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                            <a href="reply_message.php?id=<?php echo $message->id; ?>" class="btn btn-info"><i class="fa fa-share"></i> Reply</a>
                                        </footer>
                                    </section>
                                </div>
                            </div>
                          </div>
                      </div>
                  </aside>
              </div>


<?php include("includes/inbox-footer.php"); ?>