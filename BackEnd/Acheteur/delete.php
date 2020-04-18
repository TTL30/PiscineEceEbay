<?php


    function delete($item,$email_vendor){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();

        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }
        $json =  @json_encode('dellll');
        print "<script>console.log($json);</script>";
        /* $sql = "DELETE FROM items WHERE id = ? AND email_vendor = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("is", $param_title,$param_email_vendor);
                $param_title = $item;
                $param_email_vendor = $email_vendor;
                if($stmt->execute()){
                    $sql = "DELETE FROM enchere WHERE id_item = ? AND email_vendor = ?";
                    if($mystmt = $db->prepare($sql)){
                        $mystmt->bind_param("is", $param_title,$param_email_vendor);
                            $param_title = $item;
                            $param_email_vendor = $email_vendor;
                            if($mystmt->execute()){
                            }
                            $mystmt->close();
                        }
                        $sql = "DELETE FROM immediat WHERE id_item = ? AND email_vendor = ?";
                        if($mystmt = $db->prepare($sql)){
                        $mystmt->bind_param("is", $param_title,$param_email_vendor);
                            $param_title = $item;
                            $param_email_vendor = $email_vendor;
                            if($mystmt->execute()){
                            }
                            $mystmt->close();
                        }
                        $sql = "DELETE FROM nego WHERE id_item = ? AND email_vendor = ?";
                        if($mystmt = $db->prepare($sql)){
                        $mystmt->bind_param("is", $param_title,$param_email_vendor);
                            $param_title = $item;
                            $param_email_vendor = $email_vendor;
                            if($mystmt->execute()){
                            }
                            $mystmt->close();
                        }
                        
                        $json =  @json_encode($item);
                        print "<script>console.log($json);</script>";
                   header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
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
            } */

            
            $db->close();
    }
