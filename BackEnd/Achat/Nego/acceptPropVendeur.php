<?php
session_start();

require_once "../../Config/config.php";


if (isset($_POST['submit'])) {
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email=$_SESSION["email"];
    $prix = $_POST['offreAcheteur'];
    $idItem =$_POST['id_item'];
    $acheteur =$_POST['email_acheteur'];
    $json =  @json_encode($acheteur);
    print "<script>console.log($json);</script>";
    $json =  @json_encode($idItem);
    print "<script>console.log($json);</script>";
  
    $sql = "SELECT * FROM nego WHERE id_item=? AND email_acheteur = ?";
    if ($ostmt = $mysqli->prepare($sql)) {
        $ostmt->bind_param("is",$param_item,$param_email_acheteur);
        $param_item =$idItem;
        $param_email_acheteur = $acheteur;
        
        if ($ostmt->execute()) {
            $result = mysqli_stmt_get_result($ostmt);
            $myrow = mysqli_fetch_row($result);
            
           
    $sql = "INSERT INTO vente (id_item,title, email_vendor,typeAchat,prix_final,email_acheteur_final) VALUES (?,?, ?, ?, ?, ?)";
    if ($encorestmt = $db->prepare($sql)) {
        $encorestmt->bind_param("isssis",$param_id_item,$param_title,$param_email_vendor,$param_typeAchat,$param_prix,$param_email_acheteur);
        $param_id_item = $myrow[1];
        $param_title = $myrow[2];
        $param_email_vendor = $myrow[3];
        $param_typeAchat = $myrow[4];
        $param_prix = $prix;
        $param_email_acheteur = $myrow[7];
        if ($encorestmt->execute()) {
            $sql = "DELETE FROM items WHERE title = ? AND email_vendor = ?";
            if($ailestmt = $db->prepare($sql)){
                $ailestmt->bind_param("ss", $param_title,$param_email_vendor);
                $param_title = $myrow[2];
                $param_email_vendor = $myrow[3];
                if($ailestmt->execute()){
                    $sql = "DELETE FROM nego WHERE id_item = ?";
                     if($mstmt = $db->prepare($sql)){
                        $mstmt->bind_param("i", $param_id_item);
                        $param_id_item = $myrow[1];
                        if($mstmt->execute()){
                            $sql = "DELETE FROM immediat WHERE id_item = ?";
                                        if($dsd = $db->prepare($sql)){
                                            $dsd->bind_param("i", $param_id_item);
                                            $param_id_item = $myrow[1];
                            if($dsd->execute()){
                    
                }
                            
                            $dsd->close();
                        }
                        }
                            $mstmt->close();
                        }
                      header("Location: {$_SERVER['HTTP_REFERER']}");
                        exit();
                }
                $ailestmt->close();
            }

                                    }
                                
                                $encorestmt -> close();
                            
                                }
                            }
                        $ostmt->close();
                    }
     
   
    $db->close();
}


?>