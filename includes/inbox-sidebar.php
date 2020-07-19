<?php 
$uri = explode("/", $_SERVER['REQUEST_URI']);; 
$active_tab = $uri[count($uri)-1];
?>
<aside class="sm-side">
    <div class="user-head">
        <a class="inbox-avatar" href="javascript:;">
            <img  width="64" hieght="60" src="admin/<?php echo $user_loged->getProfilePicture(); ?>">
        </a>
        <div class="user-name">
            <h5><a href="#"><?php echo $user_loged->get_user_full_name(); ?></a></h5>
            <span><a href="#"><?php echo $user_loged->email; ?></a></span>
        </div>
    </div>
    <div class="inbox-body">
        <a href="#myModal" data-toggle="modal" title="Compose"  class="btn btn-compose">
        <i class="fa fa-pencil-alt"></i> New Message
        </a>

    <!-- Inbox Compose Modal -->
    <?php include("includes/compose-modal.php") ?>

    </div>
    <ul class="inbox-nav inbox-divider">
        <li class="<?php echo ($active_tab == "inbox.php") ? "active" : ""; ?>">
            <a href="inbox.php"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right"><?php echo Message::count_user_new_messages($user_loged->id); ?></span></a>

        </li>
        <li class="<?php echo ($active_tab == "sent_messages.php") ? "active" : ""; ?>">
            <a href="sent_messages.php"><i class="fa fa-envelope"></i> Sent Mail</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-bookmark"></i> somthing</a>
        </li>
        <li>
            <a href="#"><i class=" fa fa-external-link-alt"></i> Drafts <span class="label label-info pull-right">30</span></a>
        </li>
        <li>
            <a href="#"><i class=" fa fa-trash"></i> Trash</a>
        </li>
    </ul>
    <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
        <li> <h4>Labels</h4> </li>
        <li> <a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Work </a> </li>
        <li> <a href="#"> <i class=" fa fa-sign-blank text-success"></i> Design </a> </li>
        <li> <a href="#"> <i class=" fa fa-sign-blank text-info "></i> Family </a>
        </li><li> <a href="#"> <i class=" fa fa-sign-blank text-warning "></i> Friends </a>
        </li><li> <a href="#"> <i class=" fa fa-sign-blank text-primary "></i> Office </a>
        </li>
    </ul>
    <ul class="nav nav-pills nav-stacked labels-info ">
        <li> <h4>Buddy online</h4> </li>
        <li> <a href="#"> <i class=" fa fa-circle text-success"></i>Alireza Zare <p>I do not think</p></a>  </li>
        <li> <a href="#"> <i class=" fa fa-circle text-danger"></i>Dark Coders<p>Busy with coding</p></a> </li>
        <li> <a href="#"> <i class=" fa fa-circle text-muted "></i>Mentaalist <p>I out of control</p></a>
        </li><li> <a href="#"> <i class=" fa fa-circle text-muted "></i>H3s4m<p>I am not here</p></a>
        </li><li> <a href="#"> <i class=" fa fa-circle text-muted "></i>Dead man<p>I do not think</p></a>
        </li>
    </ul>

    <div class="inbox-body text-center">
        <div class="btn-group">
            <a class="btn mini btn-primary" href="javascript:;">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="btn-group">
            <a class="btn mini btn-success" href="javascript:;">
                <i class="fa fa-phone"></i>
            </a>
        </div>
        <div class="btn-group">
            <a class="btn mini btn-info" href="javascript:;">
                <i class="fa fa-cog"></i>
            </a>
        </div>
    </div>

</aside>