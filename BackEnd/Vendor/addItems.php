<?php

session_start();

require_once "../Config/config.php";


if (isset($_POST['Submit'])) {
    $email=$_SESSION["email"];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $typeAchat = $_POST['typeAchat'];
    $prix = $_POST['prix'];
    $img = $_POST['img'];

    $sql = "SELECT title, email_vendor FROM items WHERE email_vendor = ? AND title = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $param_email,$param_title);
        $param_email = $email;
        $param_title = $title;
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                header("Location: ../../FrontEnd/HomePage/HomeVendeur.php??");
                exit();
            } else {
                $sql = "INSERT INTO items (email_vendor,title,description,categorie,typeAchat,prix,img,sold) VALUES (?, ?, ?, ?, ?, ?, ?,0)";
                if($mystmt = $mysqli->prepare($sql)){
                    $mystmt->bind_param("sssssis", $param_email, $param_title,$param_description,$param_categorie,$param_typeAchat,$param_prix,$param_img);
                    $param_email = $email;
                    $param_title= $title;
                    $param_description = $description;
                    $param_categorie = $categorie;
                    $param_typeAchat = $typeAchat;
                    $param_prix = $prix;
                    $param_img = $img;
                    if($mystmt->execute()){
                        if(strcmp($typeAchat,"enchere")===0){
                            $lastId=$mysqli->insert_id;
                            $sql = "INSERT INTO enchere (id_item,title,email_vendor,typeAchat,offre_actuelle,email_acheteur_actuel,fin,offre_auto,email_acheteur_offre_auto) VALUES (?,?, ?, ?, ?, '',24,0,'')";
                            if($lestmt = $mysqli->prepare($sql)){
                                $lestmt->bind_param("isssi", $param_id_item,$param_title, $param__email_vendor,$param_type_achat,$param_offre_actuelle);
                                $param_id_item = $lastId;
                                $param_title= $title;
                                $param__email_vendor = $email;
                                $param_type_achat = $typeAchat;
                                $param_offre_actuelle =$prix;
                                if($lestmt->execute()){
                                    $json =  @json_encode("add to enchere");
                                    print "<script>console.log($json);</script>";
                                }
                                else{
                                    $json =  @json_encode("not add to enchere");
                                    print "<script>console.log($json);</script>";
                                }
    
                                $lestmt->close();
    
                            }
                            header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
                        }
                        else if(strcmp($typeAchat,"immediat")===0){
                            $lastId=$mysqli->insert_id;
                            $sql = "INSERT INTO immediat (id_item,title,email_vendor,typeAchat,prix,email_acheteur) VALUES (?,?, ?, ?, ?,'')";
                            if($lestmt = $mysqli->prepare($sql)){
                                $lestmt->bind_param("isssi", $param_id_item,$param_title, $param__email_vendor,$param_type_achat,$param_offre_actuelle);
                                $param_id_item = $lastId;
                                $param_title= $title;
                                $param__email_vendor = $email;
                                $param_type_achat = $typeAchat;
                                $param_offre_actuelle =$prix;
                                if($lestmt->execute()){
                                    $json =  @json_encode("add to immediat");
                                    print "<script>console.log($json);</script>";
                                }
                                else{
                                    $json =  @json_encode("not add to eimmediat");
                                    print "<script>console.log($json);</script>";
                                }
    
                                $lestmt->close();
    
                            }
                            header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
                        }
                        else if(strcmp($typeAchat,"offre")===0){
                            $lastId=$mysqli->insert_id;
                            $sql = "INSERT INTO nego (id_item,title,email_vendor,typeAchat,offre_vendeur,offre_acheteur,email_acheteur,last_offer,nb) VALUES (?,?, ?, ?, ?,0,'',0,0)";
                            if($lestmt = $mysqli->prepare($sql)){
                                $lestmt->bind_param("isssi", $param_id_item,$param_title, $param__email_vendor,$param_type_achat,$param_offre_actuelle);
                                $param_id_item = $lastId;
                                $param_title= $title;
                                $param__email_vendor = $email;
                                $param_type_achat = $typeAchat;
                                $param_offre_actuelle =$prix;
                                if($lestmt->execute()){
                                    $json =  @json_encode("add to nego");
                                    print "<script>console.log($json);</script>";
                                }
                                else{
                                    $json =  @json_encode("not add to nego");
                                    print "<script>console.log($json);</script>";
                                }
    
                                $lestmt->close();
    
                            }
                            header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
                        }
                        }
                        
                    else{
                        
                        $json =  @json_encode("aillllle");
                        print "<script>console.log($json);</script>";
                    }
                    
                    $mystmt->close();
                }
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    
    


    // Close connection
    $mysqli->close();
}
