<?php


    function deleteItems($item){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }
        $sql = "DELETE FROM items WHERE id = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $param_title);
                $param_title = $item;
                if($stmt->execute()){
                    $sql = "DELETE FROM enchere WHERE id_item = ?";
                    if($mystmt = $db->prepare($sql)){
                        $mystmt->bind_param("i", $param_title);
                            $param_title = $item;
                            if($mystmt->execute()){
                            }
                            $mystmt->close();
                        }
                        $sql = "DELETE FROM immediat WHERE id_item = ?";
                        if($mystmt = $db->prepare($sql)){
                        $mystmt->bind_param("i", $param_title);
                            $param_title = $item;
                            if($mystmt->execute()){
                            }
                            $mystmt->close();
                        }
                        $sql = "DELETE FROM nego WHERE id_item = ?";
                        if($mystmt = $db->prepare($sql)){
                        $mystmt->bind_param("i", $param_title);
                            $param_title = $item;
                            if($mystmt->execute()){
                            }
                            $mystmt->close();
                        }
                        
                        $json =  @json_encode($item);
                        print "<script>console.log($json);</script>";
                        if($_SESSION['type']===1){
                            header("Location: ../../FrontEnd/HomePage/AdminItems.php");
        
                        }else{
                            header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");

                        }
                   exit();
                }
                $stmt->close();
            }
        

            $sql = "SELECT panier FROM acheteur";
            if ($stmt = $db->prepare($sql)) {
                if ($stmt->execute()) {
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_row($result);
                    $monPanier = (explode(',', $row[0]));
                    foreach ($monPanier as $it) {
                        $sql = "SELECT id,title,email_vendor,prix,img FROM items WHERE id = ?";
                        if ($mystmt = $db->prepare($sql)) {
                            $mystmt->bind_param("i", $param_id_item);
                            $param_id_item = $it;
                            if ($mystmt->execute()) {
                                $result = mysqli_stmt_get_result($mystmt);
                                $row = mysqli_fetch_row($result);
                                $stack[] = array(
                                    $row
                                );
                            }
                            $mystmt->close();
                        }
                    }
                }
                $stmt->close();
            }

            
            $db->close();
    }
