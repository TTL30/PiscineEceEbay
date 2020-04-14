<?php


    function trieItems($catagorie,$achat){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        if (strcmp($achat, $catagorie) == 0) {
            $sql = "SELECT id,title,email_vendor,prix,img FROM items ";
            if($stmt = $db->prepare($sql)){
                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);
                    $stack = array();
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
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE typeAchat = ?";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $param_achat);
                $param_achat = $achat;
                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);
                    $stack = array();
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
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE categorie = ?";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $param_categorie);
                $param_categorie = $catagorie;
                if($stmt->execute()){
                    $result = mysqli_stmt_get_result($stmt);
                    $stack = array();
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
            $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE categorie = ? AND typeAchat = ?  ";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("ss", $param_categorie,$param_achat);
                $param_categorie = $catagorie;
                $param_achat = $achat;

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