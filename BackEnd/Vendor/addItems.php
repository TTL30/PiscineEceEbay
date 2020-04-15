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
                $sql = "INSERT INTO items (email_vendor, title,description,categorie,typeAchat,prix,img) VALUES (?, ?, ?, ?, ?, ?, ?)";
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
                        header("Location: ../../FrontEnd/HomePage/HomeVendeur.php");
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
