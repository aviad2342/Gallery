<?php 

if(isset($_POST['submit'])) {
    $date = date('Y-m-d H:i:s');
    $user_id = User::get_selected_user_id($_POST['user_id']);
    $title = $_POST['title'];
    $content = $_POST['content'];

    $new_message = Message::newMessage($user_id, $user_loged->id, $title, $content, $date, true);
    
    if($new_message && $new_message->save()) {
        redirect("inbox.php");
        $session->message("<i class='fa fa-check'></i> The Messge was successfully send");
    } else {
        $session->message("<i class='fa fa-check'></i> The Messge was successfully send");
    }
}

?>


<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">New Message</h4>
            </div>
            <div class="modal-body">
                <form action="inbox.php" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">To</label>
                        <div class="col-lg-10">
                            <input type="text" name="user_id"  id="user_name" class="form-control typeahead" data-provide="typeahead">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Subject</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="" name="title" id="inputPassword1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Message</label>
                        <div class="col-lg-10">
                            <div id="myNicPanel"></div>
                            <textarea rows="10" cols="30" class="form-control" name="content" style="width: 470px; height: 100px;"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <span class="btn green fileinput-button">
                            <i class="fa fa-plus fa fa-white"></i>
                            <span>Attachment</span>
                            <input type="file" name="files[]" multiple="">
                            </span>
                            <button class="btn btn-send" type="submit" name="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->