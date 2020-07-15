<?php 
$user_loged = User::find_by_id($session->user_id); 
$new_messages = Message::count_user_new_messages($user_loged->id);
$user_messages = Message::find_user_messages($user_loged->id);
?>

<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Home Page</a>
            </div> 

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <span class="badge badge-notify label label-success"><?php echo $new_messages; ?></span><b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                    <?php foreach ($user_messages as $user_message) : ?>
                        <li class="message-preview">
                            <a href="../read_message.php?id=<?php echo $user_message->id; ?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object message-avatar img-thumbnail img-circle" src="<?php echo User::find_by_id($user_message->author_id)->getProfilePicture(); ?>" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong><?php echo User::find_by_id($user_message->author_id)->get_user_full_name() ; ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $user_message->getDate(); ?></p>
                                        <p><?php echo substr("$user_message->content",0,25); ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?> 
                        <li class="message-footer">
                            <a href="../inbox.php">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src=<?php echo $user_loged->getProfilePicture(); ?> class="profile-image-circle img-circle"> <small><?php echo $user_loged->first_name." ".$user_loged->last_name ?></small> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="user_profile.php?id=<?php echo $user_loged->id; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="../inbox.php"><i class="fa fa-fw fa-envelope"></i> Inbox <span class="email-Badge pull-right label label-success"><?php echo $new_messages; ?></span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>