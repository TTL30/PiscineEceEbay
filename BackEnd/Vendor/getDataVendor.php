<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'piscineeceebay');
    
    function getDBData(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM items WHERE email_vendor = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $stack = array();
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    array_push($stack, $row);
                }
            }
            $stmt->close();
        }
        $db->close();
        return $stack;
    }
?>