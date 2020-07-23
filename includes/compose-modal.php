<?php 

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

if(isset($_POST['submit'])) {
    $date = date('Y-m-d H:i:s');
    $user_id = User::get_selected_user_id($_POST['user_id']);
    $title = $_POST['title'];
    $content = $_POST['content'];

    $new_message = Message::newMessage($user_id, $user_loged->id, $title, $content, $date, true);
    
    if($new_message && $new_message->save()) {
        $message_id = $new_message->get_message_id();
        if(!empty($_FILES['filepreview'])){
            $files = reArrayFiles($_FILES['filepreview']);
            foreach ($files as $file) {
                $newfile = new File();
                $newfile->message_id = $message_id;
                $newfile->date = $date;
                $newfile->set_file($file);
                $newfile->save();
            }
        //     $filesCount = count($_FILES['file']['name']);
        //     if($filesCount > 0){
        //         if($filesCount == 1) {
        //             $newfile = new File();
        //             $newfile->message_id = $message_id;
        //             $newfile->date = $date;
        //             $newfile->set_file($_FILES['file']);
        //             $newfile->save();
        //     } else {
        //         $files = reArrayFiles($_FILES['file']);
        //         foreach ($files as $file) {
        //             $newfile = new File();
        //             $newfile->message_id = $message_id;
        //             $newfile->date = $date;
        //             $newfile->set_file($file);
        //             $newfile->save();
        //         }

        //     }
        //    }
        }
        redirect("inbox.php");
        $session->message("<i class='fa fa-check'></i> The Messge was successfully send");
    } else {
        redirect("inbox.php");
        $session->message("<i class='fa fa-check'></i> The Messge was successfully send");
    }
}

?>


<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center bg-primary">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">New Message</h4>
            </div>
            <div class="modal-body">
                <form action="" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                            <!-- <div id="myNicPanel"></div> -->
                            <textarea rows="10" cols="30" class="form-control" name="content" style="width: 610px; height: 100px;"></textarea>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <span class="btn green fileinput-button" data-toggle="tooltip" data-placement="left" title="Attach file">
                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                            <input type="file" id='file' name="file[]" multiple="multiple">
                            </span>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <div class="file-loading">
                            <input id="filepreview" type="file" name="filepreview[]" data-preview-file-type="text" multiple="multiple">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-send" type="submit" name="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->