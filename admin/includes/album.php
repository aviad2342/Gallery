<?php 

class Album extends Db_object {

    protected static $db_table = "albums";
    protected static $db_table_fields = array('author_id', 'author_name', 'date', 'title', 'description');
    public $id;
    public $author_id;
    public $author_name;
    public $date;
    public $title;
    public $description;
   

    public function getDate() {
        $dtime = new DateTime($this->date);
        return $dtime->format('F d, Y H:i');
    }

    public static function find_user_albums($author_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE author_id = ".$database->escape_string($author_id)." ORDER BY author_id ASC";
        return self::find_by_query($sql);
    }

    public static function countRecords($author_id=0) {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$db_table." WHERE author_id = ".$database->escape_string($author_id);
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);  
    }


}// END of Photo class 


?>