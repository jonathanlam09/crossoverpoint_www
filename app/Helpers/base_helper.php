<?php
class Helper {
    public static function encrypt($data){
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = env("ENCRYPTION_SECRET");
        $secret_iv = env("ENCRYPTION_IV");
        $key = hash("SHA256", $secret_key);    
        $iv = substr(hash("SHA256", $secret_iv), 0, 16);
        $output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function decrypt($data) 
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = env("ENCRYPTION_SECRET");
        $secret_iv = env("ENCRYPTION_IV");
        $key = hash("SHA256", $secret_key);    
        $iv = substr(hash("SHA256", $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);
        return $output;
    }

    public static function insert_encrypted_id($data){
        if(!empty($data["body"])){
            if(count($data["body"]) > 0){
                foreach($data["body"] as $row){
                    if(is_array($row)){
                        if(isset($data["ref"])){
                            $row["encrypted_id"] = self::encrypt($row[$data["ref"]]);
                        }else{
                            $row["encrypted_id"] = self::encrypt($row["id"]);
                        }
                    }else{
                        if(isset($data["ref"])){
                            $row->encrypted_id = self::encrypt($row->$data["ref"]);
                        }else{
                            $row->encrypted_id = self::encrypt($row->id);
                        }
                    }
                }
            }
        }
        return $data["body"];
    }

    public static function is_weekend($your_date) {
        $week_day = date('w', strtotime($your_date));
        //returns true if Sunday or Saturday else returns false
        return ($week_day == 0 || $week_day == 6);
    }

    public static function generateRandomPassword($length = 8) {
        $sets = array();
        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        $sets[] = '23456789';
        $sets[] = '!@#$%&*?';

        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);  
        return $password;
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateOneLetter($length = 1) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function validate_password($password) {
        $condition = True;
        $message = "Password should be at least ";

        if(strlen($password) < 8) {
            $condition = False;
            $message .= "8 characters";
        }

        if(!preg_match("#[0-9]+#", $password)) {
            $condition = False;
            if(strlen($password) < 8){
                $message .= ", 1 digit";
            }else{
                $message .= "1 digit";
            }
        }

        if(!preg_match("#[a-z]+#", $password)) {
            if(strlen($password) < 8){
                $message .= ", 1 small letter";
            }else{
                $message .= "1 small letter";
            }
        }

        if(!preg_match("#[A-Z]+#", $password)) {
            $condition = False;
            if(strlen($password) > 7 && preg_match("#[0-9]+#", $password) && !preg_match("#[a-z]+#", $password)){
                $message .= ", 1 upper letter";
            }else if(strlen($password) < 8 && !preg_match("#[0-9]+#", $password) && preg_match("#[a-z]+#", $password)){
                $message .= ", 1 upper letter";
            }else if(strlen($password) < 8 && preg_match("#[0-9]+#", $password) && !preg_match("#[a-z]+#", $password)){
                $message .= ", 1 upper letter";
            }else{
                $message .= "1 upper letter";
            }
        }

        if(!preg_match("#[\W]+#", $password)) {
            $condition = False;
            // if(preg_match("#[a-z]+#", $password)){
            //     echo "true";
            // }else{
            //     echo "false";
            // }
            if(strlen($password) > 7 && preg_match("#[0-9]+#", $password) && !preg_match("#[a-z]+#", $password)){
                $message .= ", 1 special characters";
            }else if(strlen($password) < 8 && !preg_match("#[0-9]+#", $password) && preg_match("#[a-z]+#", $password)){
                $message .= ", 1 special characters";
            }else if(strlen($password) < 8 && preg_match("#[0-9]+#", $password) && preg_match("#[a-z]+#", $password)){
                $message .= ", 1 special characters";
            }else if(strlen($password) < 8 && preg_match("#[0-9]+#", $password) && !preg_match("#[a-z]+#", $password)){
                $message .= ", 1 special characters";
            }else{
                $message .= " 1 special characters";
            }
        }
        $return = [
            "status" => $condition,
            "message" => $message
        ];
        return $return;
    }

    public static function get_client_ip()
    {
        $ipaddress = "";
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ipaddress = $_SERVER["HTTP_CLIENT_IP"];
        } else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ipaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_X_FORWARDED"])) {
            $ipaddress = $_SERVER["HTTP_X_FORWARDED"];
        } else if (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            $ipaddress = $_SERVER["HTTP_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_FORWARDED"])) {
            $ipaddress = $_SERVER["HTTP_FORWARDED"];
        } else if (isset($_SERVER["REMOTE_ADDR"])) {
            $ipaddress = $_SERVER["REMOTE_ADDR"];
        } else {
            $ipaddress = "UNKNOWN";
        }
        return $ipaddress;
    }

    public static function remove_space($val){
        return preg_replace('/\s[^\d]/', '', $val);
    }

    public static function remove_non_digit($val){
        return preg_replace('/[^\d]/', '', $val);
    }

    // public static function remove_all_symbols($val){
    //     return preg_replace('/[^A-Za-z0-9\-]/', '', $val);
    // }

    // public static function remove_all_symbols_and_words($val){
    //     return preg_replace('/[^0-9\-]/', '', $val);
    // }

    public static function remove_all_symbols_and_digits($val){
        return preg_replace('/[^A-Za-z\-]/', '', $val);
    }

    public static function validate_contact($contact){
        return preg_match("/^01[0-9]{8,9}$/", $contact);
    }

    public static function sanitize($input){
        return htmlentities($input, ENT_QUOTES, 'UTF-8');
    }
}
?>