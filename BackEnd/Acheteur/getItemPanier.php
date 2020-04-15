<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'piscineeceebay');
function getItemPanier()
{
    
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email = $_SESSION["email"];
    $stack = array();


    if ($db === false) {
        die("ERROR: Could not connect. " . $db->connect_error);
    }
    $sql = "SELECT panier FROM acheteur WHERE email = ?";
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("s", $param_email);
        $param_email = $email;

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
                        if($row === null)
                        {
                            
                            $test = array_search($it,$monPanier);
                            if($test !== false)
                            {
                                array_splice($monPanier,$test,1);
                            }
                            $panierMaj = implode(',',$monPanier);
                            $sql = "UPDATE acheteur SET panier = ? WHERE email = ? ";
                            if($mySstmt = $db->prepare($sql)){
                                $mySstmt->bind_param("ss", $param_paniermaj,$param_email);
                                    $param_paniermaj = $panierMaj;
                                    $param_email = $email;
                                    $mySstmt->execute();
                                    $mySstmt->close();
                                }
                        }else{
                            $stack[] = array(
                                $row
                            );
                        }
                       
                       
                    }
                    $mystmt->close();
                }
            }
        }
        $stmt->close();
    }
    return($stack);
    $db->close();
}
