<?php 

class Comment extends Db_object {

    protected static $db_table = "comments";
    protected static $db_table_fields = array('photo_id', 'author_id','author_name', 'date', 'body');
    public $id;
    public $photo_id;
    public $author_id;
    public $author_name;
    public $date;
    public $body;

    public static function newComment($photo_id, $author_id, $author_name, $date, $body) {
        if(!empty($photo_id) && !empty($author_id) && !empty($author_name) && !empty($date) && !empty($body)) {
            $comment = new Comment();
            $comment->photo_id    = (int)$photo_id;
            $comment->author_id   = (int)$author_id;
            $comment->author_name = $author_name;
            $comment->date        = $date;
            $comment->body        = $body;

            return $comment;
        } else {
            return false;
        }
    }

    public static function find_comments_photo($photo_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE photo_id = ".$database->escape_string($photo_id)." ORDER BY photo_id ASC";
        return self::find_by_query($sql);
    }

    public function getDate() {
        $dtime = new DateTime($this->date);
        return $dtime->format('F d, Y H:i');
    }
    
    



} // End of user class




?>