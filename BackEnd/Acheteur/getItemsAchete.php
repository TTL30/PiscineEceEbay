<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'piscineeceebay');
    
    function getItemsAchete(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM vente WHERE email_acheteur_final = ? ";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $stack[] = (
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