<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'piscineeceebay');
    function getDataNego(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM nego WHERE email_vendor = ? ";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $param_email_vendor);
            $param_email_vendor = $email;
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $stack = array();
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $stack[] = (
                        $row
                    );      
                }       
            }
            $stmt->close();
        }
        else{
            echo 'aille';
        }
;
        return($stack);

    $db->close();

    }
?>