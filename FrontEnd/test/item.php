<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../Auth/login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="accueil.css" rel="stylesheet" media="all" type="text/css">

    <title>EceBay</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>


<script type="text/javascript">
    var url = window.location.search.split('?item=');
    var splitedUrl = url[1].split('?vendor=')
    var myItem = splitedUrl[0];
    var myVendor = splitedUrl[1];
    console.log(myItem)
    console.log(myVendor)

    function passCookie(callback) {

        $(document).ready(function() {
            document.cookie = (("vendor=" + myVendor) + '; Path=http://piscineeceebay.loc/FrontEnd/test/item.php?item=' + myItem + '?vendor=' + myVendor + ';');
            document.cookie = (("item=" + myItem) + '; Path=http://piscineeceebay.loc/FrontEnd/test/item.php?item=' + myItem + '?vendor=' + myVendor + ';');
            callback();
        });
    }

    function senCookie() {
        <?php
        include '../../BackEnd/Items/getDataCurrentItem.php';
        $infoItem = getDataCurrentItem($_COOKIE["item"], $_COOKIE["vendor"]);
        ?>
        $(document).ready(function() {
            if (document.URL.indexOf("#") == -1) {
                url = document.URL + "#";
                location = "#";
                location.reload(true);
            }
        });
    }
    var myitem = <?php echo json_encode($infoItem); ?>;
    console.log(myitem);
    passCookie(senCookie)
</script>



<body>

    <p style="margin-top: 100px"><?php echo $infoItem[1] ?></p>
    <img src="../../../BackEnd/IMG/<?php echo $infoItem[6] ?>" alt="">

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>