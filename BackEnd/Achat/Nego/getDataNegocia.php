<?php
  
    function getDataNegocia($item,$vendor){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT id FROM items WHERE email_vendor = ? AND id = ?";
        if($stmt = $db->prepare($sql)){

            $stmt->bind_param("si", $param_email_vendor,$param_item);
            $param_email_vendor = $vendor;
            $param_item = $item;
            if($stmt->execute()){
                $result = mysqli_stmt_get_result($stmt);
                $id_item = mysqli_fetch_row($result);
                $sql = "SELECT * FROM nego WHERE id_item = ? AND email_acheteur = ?";
                if($mystmt = $db->prepare($sql)){
                    $mystmt->bind_param("is", $param_id_item,$param_email);
                    $param_id_item = $id_item[0];
                    $param_email = $email;
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



    function getAllnegouser(){
        $json =  @json_encode("oui");
        print "<script>console.log($json);</script>";
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

                $sql = "SELECT * FROM nego WHERE email_acheteur = ?";
                if($mystmt = $db->prepare($sql)){
                    $mystmt->bind_param("s",$param_email);
                    $param_email = $email;
                    if($mystmt->execute()){
                        $result = mysqli_stmt_get_result($mystmt);
                        $stack = array();
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            $stack[] = (
                                $row
                            );      
                        }  
                    }
                    $mystmt->close();
                }
                $json =  @json_encode($stack);
                print "<script>console.log($json);</script>";
        return($stack);

    $db->close();

    }
?>