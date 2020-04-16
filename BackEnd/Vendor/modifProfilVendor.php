<?php

session_start();

require_once "../Config/config.php";


if (isset($_POST['submit'])) {
    $email=$_SESSION["email"];
    $photoProfil = $_POST['photoProfil'];
    $photoCouv = $_POST['photoCouv'];
    $sql = "UPDATE vendeur SET photoProfil = ?, photoCouverture = ? WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql)) {
       
        $stmt->bind_param("sss", $param_photo_profil,$param_photo_couv,$param_email);
        $param_email = $email;
        $param_photo_profil = $photoProfil;
        $param_photo_couv = $photoCouv;
        if ($stmt->execute()) {
            header("Location: ../../FrontEnd/Profils/ProfilVendeur.php");
            exit();
        } else {
            $json =  @json_encode("aille");
            print "<script>console.log($json);</script>";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
