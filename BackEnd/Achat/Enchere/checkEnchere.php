<?php
  
    function checkEnchere(){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $email=$_SESSION["email"];
        $stack = array();
        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }

        $sql = "SELECT * FROM enchere";
        if($stmt = $db->prepare($sql)){
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
        parcoursEnchere($stack);
        mysqli_free_result($result);
        $db->close();
    }

    function parcoursEnchere($stack){
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($db === false){
            die("ERROR: Could not connect. " . $db->connect_error);
        }
        foreach($stack as &$it){
            $maDate = new  DateTime();date_add($maDate, date_interval_create_from_date_string("2 hours"));
            $debut = new  DateTime($it["debut"]);
            $duree = strval($it["fin"]);
            $duree .= " hours";
            $maDateFin   = date_add($debut, date_interval_create_from_date_string($duree));
            $dteDiff  = $maDate->diff($maDateFin);

            if(strcmp($dteDiff->format("%D:%H:%I:%S"),"00:00:00:00") == 0 )
            {
                $sql = "UPDATE items SET sold = 1 WHERE id = ?";
                if ($stmt = $db->prepare($sql)) {
                    $stmt->bind_param("i",$param_id_item);
                    $param_id_item = $it["id_item"];
                    if ($stmt->execute()) {
                        $json =  @json_encode("Sold");
                        print "<script>console.log($json);</script>";
                        if(strcmp($it["email_acheteur_actuel"],$it["email_acheteur_offre_auto"])===0){
                            $diff = $it["offre_auto"] - $it["offre_actuelle"];
                           $sql= "SELECT solde from acheteur where email =?";
                           if ($enrstmt = $db->prepare($sql)) {
                                 $enrstmt->bind_param("s",$param_email);
                                 $param_email = $it["email_acheteur_actuel"];
                                 if ($enrstmt->execute()) {
                                    $result = mysqli_stmt_get_result($enrstmt);
                                    $row = mysqli_fetch_row($result);
                                    $sql = "UPDATE acheteur SET solde = ? WHERE email = ?";
                                    if ($oostmt = $db->prepare($sql)) {
                                        $oostmt->bind_param("is",$param_solde,$param_email);
                                        $param_solde = $row[0] + $diff;
                                        $param_email = $it["email_acheteur_actuel"];
                                        if ($oostmt->execute()) {
                                            $json =  @json_encode("good");
                                            print "<script>console.log($json);</script>";
                                        }
                                        $oostmt->close();
                                    }
                                 }

                            $enrstmt->close();
                           }
                        }
                        



                        $sql = "INSERT INTO vente (id_item,title, email_vendor,typeAchat,prix_final,email_acheteur_final) VALUES (?,?, ?, ?, ?, ?)";
                        if ($mystmt = $db->prepare($sql)) {
                            $mystmt->bind_param("isssis",$param_id_item,$param_title,$param_email_vendor,$param_typeAchat,$param_prix,$param_email_acheteur);
                            $param_id_item = $it["id_item"];
                            $param_title = $it["title"];
                            $param_email_vendor = $it["email_vendor"];
                            $param_typeAchat = $it["typeAchat"];
                            $param_prix = $it["offre_actuelle"];
                            $param_email_acheteur = $it["email_acheteur_actuel"];
                            if ($mystmt->execute()) {
                                $json =  @json_encode("add to vente");
                                print "<script>console.log($json);</script>";
                                $sql = "DELETE FROM items WHERE title = ? AND email_vendor = ?";
                                if($lestmt = $db->prepare($sql)){
                                    $lestmt->bind_param("ss", $param_title,$param_email_vendor);
                                    $param_title = $it["title"];
                                    $param_email_vendor = $it["email_vendor"];
                                    if($lestmt->execute()){
                                        $sql = "DELETE FROM enchere WHERE title = ? AND email_vendor = ?";
                                        if($mstmt = $db->prepare($sql)){
                                            $mstmt->bind_param("ss", $param_title,$param_email_vendor);
                                            $param_title = $it["title"];
                                    $param_email_vendor = $it["email_vendor"];
                            if($mstmt->execute()){
                            }
                            $mstmt->close();
                        }else{
                            $json =  @json_encode("ouille");
                        print "<script>console.log($json);</script>";
                        }
                    //header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
                    //exit();
                }
                $lestmt->close();
            }
                            }
                            $mystmt->close();
                        }
                    }
                    else{
                        $json =  @json_encode("ailleouille");
                        print "<script>console.log($json);</script>";
                    }

            $stmt->close();
        }
            }
        }
        $db->close();


    }
?>