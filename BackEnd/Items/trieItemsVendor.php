<?php


    function trieItemsVendor($catagorie,$achat){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        if (strcmp($achat, $catagorie) == 0) {
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE email_vendor = ? ";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $param_email);
                $param_email = $email;
                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $stack[] = array(
                            $row
                        );      
                    }
                    $json =  @json_encode($stack);
                }
                $stmt->close();
            }
        }

        else if ((strcmp($catagorie, "all") == 0)&&((strcmp($achat, "all") != 0))) {
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE typeAchat = ? AND email_vendor = ?";
            if($stmt = $db->prepare($sql)){
                $json =  @json_encode("Aille");
                $stmt->bind_param("ss", $param_achat,$param_email);
                $param_achat = $achat;
                $param_email = $email;
                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $stack[] = array(
                            $row
                        );      
                    }
                    $json =  @json_encode($stack);
                }
                $stmt->close();
            }
        }

       
        else if ((strcmp($achat,"all") == 0)&&((strcmp($catagorie,"all") != 0))) {
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE categorie = ? AND email_vendor = ?";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("ss", $param_categorie,$param_email);
                $param_categorie = $catagorie;
                $param_email = $email;
                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $stack[] = array(
                            $row
                        );      
                    }
                    $json =  @json_encode($stack);
                }
                $stmt->close();
            }
        }
        else if((strcmp($achat,"all") != 0)&&(strcmp($catagorie, "all") != 0)){
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE categorie = ? AND typeAchat = ? AND email_vendor = ? ";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("sss", $param_categorie,$param_achat,$param_email);
                $param_categorie = $catagorie;
                $param_achat = $achat;
                $param_email = $email;

                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $stack[] = array(
                            $row
                        );      
                    }
                    $json =  @json_encode($stack);
                }
                $stmt->close();
            }
        }
        return($stack);
        $db->close();

    }
?>