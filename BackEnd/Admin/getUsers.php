<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'piscineeceebay');
    
    function getAcheteur(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM users WHERE type = ? ";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $param_type);
            $param_type = 3;
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

    function getVendeur(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM users WHERE type = ? ";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $param_type);
            $param_type = 2;
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