<?php 

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'email', 'date', 'password', 'first_name', 'last_name', 'profile_picture');
    public $id;
    public $username;
    public $email;
    public $date;
    public $password;
    public $first_name;
    public $last_name;
    public $profile_picture;
    public $tmp_path;
    public $upload_directory = "images";
    public $default_image = DEFAULT_PROFILE_PICTURE;
    

    public function getProfilePicture() {
        return empty($this->profile_picture) ? $this->default_image : $this->upload_directory.DS.$this->profile_picture;
    }

    public function picture_path() {
        return $this->upload_directory.DS.$this->profile_picture;
    }

    public function user_age() {
        $dtime = new DateTime($this->date);
        $now = new DateTime();
        return date_diff($dtime, $now)->y;
    }

    public function get_user_full_name() {
        return $this->first_name." ".$this->last_name;
    }

    public static function get_selected_user_id($name) {
        global $database;
        $sql = "SELECT id, CONCAT_WS(' ', `first_name`, `last_name`) AS `name` FROM ".self::$db_table." ORDER BY id ASC";
        $result_set = $database->query($sql);
        $user_id = "";

        while($row = $result_set->fetch_assoc()){
            if($name == $row['name']) {
                $user_id = $row['id'];
            }   
       }
        return $user_id;
    }// END of verify_user function


    public static function get_all_users() {
        global $database;
        $sql = "SELECT id, CONCAT_WS(' ', `first_name`, `last_name`) AS `name` FROM ".self::$db_table." ORDER BY id ASC";
        $result_set = $database->query($sql);
        $json = [];

        while($row = $result_set->fetch_assoc()){
            $json[] = array(	
                'id' => $row['id'],
                'name' => $row['name']
        );
       }
        return json_encode($json);
    }// END of verify_user function

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * from ". self::$db_table ." where ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_query($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }// END of verify_user function

    public function set_file($file) {
        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->profile_picture = time() . "-" . basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
        }  
    }// END of set_file function

    public function saveUser() {
            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->profile_picture) || empty($this->tmp_path)) {
                $this->profile_picture = "default-profile-picture.png";
                return $this->save();
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->profile_picture;

            // if(file_exists($target_path)) {
            //     $this->errors[] = "The file {$this->profile_picture} already exists";
            //     return false;
            // }

            if(move_uploaded_file($this->tmp_path ,$target_path)) {
                if($this->save()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "The file directory dose not have premission";
                return false;
            }
    
    }// END of saveUser function


    public function update_image_from_gallery($profile_picture, $user_id) {
        global $database;

        $profile_picture = $database->escape_string($profile_picture);
        $user_id = $database->escape_string($user_id);

        $this->profile_picture = $profile_picture;
        $this->id = $user_id;

        $sql = "UPDATE " . self::$db_table . " SET profile_picture = '{$this->profile_picture}' WHERE id = {$this->id} ";
        $update_image = $database->query($sql);
    }// END of update_image_from_gallery function

    public function delete_user_and_profile_picture() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }// END of delete_profile_picture function


} // End of user class




?>