<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'piscineeceebay');
function getProfilVendor()
{
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email = $_SESSION["email"];

    if ($db === false) {
        die("ERROR: Could not connect. " . $db->connect_error);
    }
    $sql = "SELECT name,last_name FROM users WHERE email = ?";
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("s", $param_email);
        $param_email = $email;

        if ($stmt->execute()) {
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_row($result);

        }
        $stmt->close();
    }
    $json =  @json_encode($row);
    print "<script>console.log($json);</script>";
    return($row);
    $db->close();
}

function getImageVendor()
{
    $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $email = $_SESSION["email"];

    if ($db === false) {
        die("ERROR: Could not connect. " . $db->connect_error);
    }
    $sql = "SELECT photoProfil,photoCouverture FROM vendeur WHERE email = ?";
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("s", $param_email);
        $param_email = $email;

        if ($stmt->execute()) {
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_row($result);
        }
        $stmt->close();
    }
    $json =  @json_encode($row);
    print "<script>console.log($json);</script>";
    return($row);
    $db->close();
}