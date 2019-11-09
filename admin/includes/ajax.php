<?php require("init.php"); ?>
<?php 

if(isset($_POST['query'])) {
    echo User::get_all_users();
}

if(isset($_POST['data'])) {
    //$data = json_decode(stripslashes($_POST['data']));
    $data = $_POST['data'];

    foreach($data as $id){
        Message::delete_message($id);
    }
}

if(isset($_POST['read'])) {
    //$data = json_decode(stripslashes($_POST['data']));
    $data = $_POST['read'];

    foreach($data as $id){
        Message::mark_read_message($id);
    }
}


?>