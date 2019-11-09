<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<?php include("includes/inbox-header.php"); ?>

<?php 
$messages = Message::find_user_messages($user_loged->id);
$count = count($messages);
?>

 <div class="mail-box">
                    <!-- Inbox Sidebar -->
                    <?php include("includes/inbox-sidebar.php") ?>

                  <aside class="lg-side">
                  <!-- Navigation -->
                        <?php include("includes/inbox-navigation.php") ?>
                          <table id="myTable" class="table table-inbox table-hover">
                            <tbody>
                            <?php foreach ($messages as $message) : ?>
                              <tr class="<?php echo $message->getIsNew(); ?>" >
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" name="marked" class="mail-checkbox" data="<?php echo $message->id; ?>">
                                  </td>
                                  <td onclick="readMessage(<?php echo $message->id; ?>);" class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td onclick="readMessage(<?php echo $message->id; ?>);" class="view-message  dont-show"><?php echo substr($message->title,0,20); ?></td>
                                  <td onclick="readMessage(<?php echo $message->id; ?>);" class="view-message "><?php echo substr("$message->content",0,25); ?></td>
                                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td onclick="readMessage(<?php echo $message->id; ?>);" class="view-message  text-right"><?php echo $message->getShortDate(); ?></td>
                              </tr>
                              <?php endforeach; ?> 
                          </tbody>
                          </table>
                      </div>
                  </aside>
              </div>


<?php include("includes/inbox-footer.php"); ?>