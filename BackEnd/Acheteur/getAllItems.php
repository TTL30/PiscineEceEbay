<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'piscineeceebay');
    
    function getAllitems(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT id,title,email_vendor,prix,img FROM items";
        if($stmt = $db->prepare($sql)){
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $stack = array();
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $stack[] = array(
                        $row
                    );      
                }   
            }
            $stmt->close();
        }
        return($stack);
        mysqli_free_result($result);
        $db->close();

    }
?>