<?php include("includes/inbox-header.php"); ?>

<?php 
$messages = Message::find_user_sent_messages($user_loged->id);
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
                                  <td onclick="readMessage(<?php echo $message->id; ?>);" class="view-message  dont-show"><?php echo User::find_by_id($message->user_id)->get_user_full_name(); ?></td>
                                  <td onclick="" class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td onclick="readMessage(<?php echo $message->id; ?>);" class="view-message "><?php echo substr($message->title,0,20); ?></td>
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