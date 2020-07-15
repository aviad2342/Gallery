<?php 

class File extends Db_object {

    protected static $db_table = "files";
    protected static $db_table_fields = array('album_id', 'date', 'filename', 'type', 'size');
    public $id;
    public $message_id;
    public $date;
    public $filename;
    public $type;
    public $size;
    
    public $tmp_path;
    public $upload_directory = "files";
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK         => "There is no error, the file uploaded with success",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION  => "File upload stopped by extension"
    );

    public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = time() . "-" . basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }  
    }// END of set_file function

    public function file_path() {
        return $this->upload_directory.DS.$this->filename;
    }

    public function save() {
        if($this->id) {
            $this->update();
        } else {
            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmp_path ,$target_path)) {
                if($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "The file directory dose not have premission";
                return false;
            }
        }
    }// END of save function

    public function delete_photo() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->file_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }// END of delete_photo function

    public function getDate() {
        $dtime = new DateTime($this->date);
        return $dtime->format('F d, Y H:i');
    }

    public static function find_message_file($message_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE message_id = ".$database->escape_string($message_id)." ORDER BY album_id ASC";
        return self::find_by_query($sql);
    }


}// END of Photo class 


?>