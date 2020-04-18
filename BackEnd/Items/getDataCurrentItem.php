<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'piscineeceebay');
    
    function getDataCurrentItem($item,$vendor){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();


        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM items WHERE email_vendor = ? AND id = ?";
        if($stmt = $db->prepare($sql)){

            $stmt->bind_param("si", $param_email_vendor,$param_item);
            $param_email_vendor = $vendor;
            $param_item = $item;
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_row($result);
            }
            $stmt->close();
        }
        else{
            echo 'aille';
        }
    
        return($row);
        $db->close();

    }
?>