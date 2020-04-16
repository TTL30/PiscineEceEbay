<?php
  
    function getDataEnchere($item,$vendor){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT id FROM items WHERE email_vendor = ? AND title = ?";
        if($stmt = $db->prepare($sql)){

            $stmt->bind_param("ss", $param_email_vendor,$param_item);
            $param_email_vendor = $vendor;
            $param_item = $item;
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $id_item = mysqli_fetch_row($result);
                $sql = "SELECT * FROM enchere WHERE id_item = ?";
                if($mystmt = $db->prepare($sql)){
                    $mystmt->bind_param("i", $param_id_item);
                    $param_id_item = $id_item[0];
                    if($mystmt->execute()){
                        $result = mysqli_stmt_get_result($mystmt);
                        $stack = array();
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            $stack = (
                                $row
                            );      
                        }  
                    }
                    $mystmt->close();
                }

                
            }
            $stmt->close();
        }
        else{
            echo 'aille';
        }
        $json =  @json_encode($stack);
        print "<script>console.log($json);</script>";
        return($stack);

    $db->close();

    }
?>