<?php 

class File extends Db_object {

    protected static $db_table = "files";
    protected static $db_table_fields = array('message_id', 'date', 'filename', 'type', 'size');
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
            $this->errors[] = "There was no file uploaded";
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

    public function delete_file() {
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

    public static function find_attach_file($message_id=0) {
        global $database;
        $sql = "SELECT * FROM ".self::$db_table." WHERE message_id = ".$database->escape_string($message_id)." ORDER BY date ASC";
        return self::find_by_query($sql);
    }

    public function file_type_view() {
        $ext = pathinfo($this->file_path(), PATHINFO_EXTENSION);
        switch ($ext) {
            case "doc":
              echo '<i class="fas fa-file-word text-primary"></i>';
              break;
            case "docx":
              echo '<i class="fas fa-file-word text-primary"></i>';
              break;  
            case "xls":
              echo '<i class="fas fa-file-excel text-success"></i>';
              break;
            case "xlsx":
              echo '<i class="fas fa-file-excel text-success"></i>';
              break;  
            case "ppt":
              echo '<i class="fas fa-file-powerpoint text-danger"></i>';
              break;
            case "pptx":
              echo '<i class="fas fa-file-powerpoint text-danger"></i>';
              break;  
            case "jpg":
              echo '<i class="fas fa-file-image text-warning"></i>';
              break;
            case "JPG":
              echo '<i class="fas fa-file-image text-warning"></i>';
              break;
            case "JPEG":
              echo '<i class="fas fa-file-image text-warning"></i>';
              break;  
            case "GIF":
              echo '<i class="fas fa-file-image text-warning"></i>';
              break;
            case "PNG":
              echo '<i class="fas fa-file-image text-warning"></i>';
              break;      
            case "pdf":
              echo '<i class="fas fa-file-pdf text-danger"></i>';
              break;
            case "zip":
              echo '<i class="fas fa-file-archive text-muted"></i>';
              break;
            case "rar":
              echo '<i class="fas fa-file-archive text-muted"></i>';
              break;
            case "tar":
              echo '<i class="fas fa-file-archive text-muted"></i>';
              break;
            case "gzip":
              echo '<i class="fas fa-file-archive text-muted"></i>';
              break;
            case "gz":
              echo '<i class="fas fa-file-archive text-muted"></i>';
              break;
            case "7z":
              echo '<i class="fas fa-file-archive text-muted"></i>';
              break; 
            case "htm":
              echo '<i class="fas fa-file-code text-info"></i>';
              break;
            case "php":
              echo '<i class="fas fa-file-code text-info"></i>';
              break;
            case "js":
              echo '<i class="fas fa-file-code text-info"></i>';
              break;
            case "css":
              echo '<i class="fas fa-file-code text-info"></i>';
              break;
            case "html":
              echo '<i class="fas fa-file-code text-info"></i>';
              break;       
            case "txt":
              echo '<i class="fas fa-file-text text-info"></i>';
              break;
            case "ini":
              echo '<i class="fas fa-file-text text-info"></i>';
              break;
            case "md":
              echo '<i class="fas fa-file-text text-info"></i>';
              break;    
            case "mov":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "avi":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "mpg":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "mkv":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "mp4":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "3gp":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "webm":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;
            case "wmv":
              echo '<i class="fas fa-file-movie-o text-warning"></i>';
              break;        
            case "mp3":
              echo '<i class="fas fa-file-audio text-warning"></i>';
              break;
            case "wav":
              echo '<i class="fas fa-file-audio text-warning"></i>';
              break;   
            default:
              echo '<i class="fas fa-file text-warning"></i>';
          }
    }


}// END of Photo class 


?>