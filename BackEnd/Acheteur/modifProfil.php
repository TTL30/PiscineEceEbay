<?php

session_start();

require_once "../Config/config.php";


if (isset($_POST['submit'])) {
    $email=$_SESSION["email"];
    $addresse = $_POST['addresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $sql = "UPDATE acheteur SET addresse = ?, ville = ?, code_postal = ? WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql)) {
       
        $stmt->bind_param("ssis", $param_addresse,$param_ville,$param_code_postal,$param_email);
        $param_email = $email;
        $param_addresse = $addresse;
        $param_ville = $ville;
        $param_code_postal = $code_postal;
        if ($stmt->execute()) {
            header("Location: ../../FrontEnd/Profils/ProfilGene.php");
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
