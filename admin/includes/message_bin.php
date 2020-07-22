<?php 

class MessageBin extends Db_object {

    protected static $db_table = "messages_bin";
    protected static $db_table_fields = array('user_id', 'author_id','title','content', 'date', 'is_new', 'delete_date');
    public $id;
    public $user_id;
    public $author_id;
    public $title;
    public $content;
    public $date;
    public $is_new;
    public $delete_date;

    public static function newMessageBin($user_id, $author_id, $title, $content, $date, $is_new, $delete_date) {
        if(!empty($user_id) && !empty($author_id) && !empty($title) && !empty($content) && !empty($date) && !empty($is_new) && !empty($delete_date)) {
            $message = new MessageBin();
            $message->user_id     = (int)$user_id;
            $message->author_id   = (int)$author_id;
            $message->title       = $title;
            $message->content     = $content;
            $message->date        = $date;
            $message->is_new      = (bool)$is_new;
            $message->delete_date = $delete_date;

            return $message;
        } else {
            return false;
        }
    }

    public static function find_user_messages($user_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE user_id = ".$database->escape_string($user_id)." ORDER BY date ASC";
        return self::find_by_query($sql);
    }

    public static function find_user_sent_messages($user_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE author_id = ".$database->escape_string($user_id)." ORDER BY date ASC";
        return self::find_by_query($sql);
    }

    public static function find_user_new_messages($user_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE user_id = ".$database->escape_string($user_id)." AND is_new = 0 ORDER BY date ASC";
        return self::find_by_query($sql);
    }

    public static function find_user_old_messages($user_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE user_id = ".$database->escape_string($user_id)." AND is_new = 1 ORDER BY date ASC";
        return self::find_by_query($sql);
    }

    public static function count_user_new_messages($user_id=0) {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$db_table." WHERE user_id = ".$database->escape_string($user_id)." AND is_new = 1 ORDER BY date ASC";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);  
    }

    public static function count_user_messages($user_id=0) {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$db_table." WHERE user_id = ".$database->escape_string($user_id);
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);  
    }

    public function getIsNew() {
        return ($this->is_new) ? "unread" : "";
    }

    public function getDate() {
        $dtime = new DateTime($this->date);
        return $dtime->format('F d, Y H:i');
    }

    public function getShortDate() {
        $dtime = new DateTime($this->date);
        return $dtime->format('F d, Y H:i');
    }

    public static function delete_message($id) {
        global $database;
        $sql = "DELETE FROM " . self::$db_table . " WHERE id=" . $database->escape_string($id) . " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        
    }

    public static function mark_read_message($id) {
        global $database;
        
        $sql = "UPDATE " . self::$db_table . " SET  is_new=0 WHERE id= " . $database->escape_string($id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        
    }
    

    public static function get_message_id() {
        global $database;
        return $database->insert_id();
        
    }
    



} // End of user class




?>