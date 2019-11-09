<?php require_once("admin/includes/init.php"); ?>
<?php 

if(empty($_GET['id'])) {
    redirect("inbox.php");
} 

$rmessage = Message::find_by_id($_GET['id']);
$from = User::find_by_id($rmessage->author_id);
$to = User::find_by_id($rmessage->user_id);

if(isset($_POST['reply'])) {
    $rdate = date('Y-m-d H:i:s');
    $rtitle = $_POST['rtitle'];
    $rcontent = $_POST['rcontent'];

    $reply_message = Message::newMessage($from->id, $to->id, $rtitle, $rcontent, $rdate, true);
    
    if($reply_message && $reply_message->create()) {
        redirect("inbox.php");
        $session->message("<i class='fa fa-check'></i> The Messge was successfully send");
    } else {
        redirect("inbox.php");
        $session->message("<i class='fa fa-check'></i> The Messge was successfully send");
    }
}


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
                            <form action=""  class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">To</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" value="<?php echo $from->get_user_full_name(); ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Subject</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="" name="rtitle" class="form-control" value="Re: <?php echo $rmessage->title; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Message</label>
                                    <div class="col-lg-10">
                                        <div id="myNicPanel"></div>
                                        <textarea rows="10" cols="30" class="form-control" name="rcontent"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <span class="btn green fileinput-button">
                                        <i class="fa fa-plus fa fa-white"></i>
                                        <span>Attachment</span>
                                        <input type="file" name="file[]" multiple="">
                                        </span>
                                        <button class="btn btn-send" type="submit" name="reply">Send</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                          </div>
                      </div>
                  </aside>
              </div>


<?php include("includes/inbox-footer.php"); ?>