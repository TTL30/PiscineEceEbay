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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="accueil.css" rel="stylesheet" media="all" type="text/css">
    <title>EceBay</title>
</head>

<?php
    include '../../BackEnd/Vendor/getDataVendor.php';
    $itemsToSell = getDBData();
?>

<script type="text/javascript">
    var itemsToSell = <?php echo json_encode($itemsToSell); ?>;
    console.log(itemsToSell);
    
    insertItems = function() {
        var parent = document.getElementsByClassName("row list")[0];
        itemsToSell.forEach(function(e) {
            var link = document.createElement('a');
            link.setAttribute('href', '../test/item.php' + '?item=' + e[0].title + '?vendor=' + e[0].email_vendor);
            var col = document.createElement('div');
            col.className = 'col-sm-4';
            var title = document.createElement('p');
            title.className = 'titleItem';
            var span_text = document.createTextNode(e[0].title);
            title.appendChild(span_text);
            var img = document.createElement('img');
            img.setAttribute('src', '../../BackEnd/IMG/' + e[0].img)
            var divImgTit = document.createElement('div');
            divImgTit.className = 'divImgTit';
            img.className = 'imgItem';
            var conta = document.createElement('div');
            var descri = document.createElement('span');
            descri.className = 'badge badge-success'
            var span_prix = document.createTextNode(e[0].prix + '€');
            descri.appendChild(span_prix);
            conta.className = 'conta';
            divImgTit.appendChild(img);
            conta.appendChild(title);
            conta.appendChild(divImgTit)
            conta.appendChild(descri)
            link.appendChild(conta)
            col.appendChild(link)
            parent.appendChild(col);
        });
    }
    window.onload = insertItems
</script>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background-color: whitesmoke;">
        <a class="navbar-brand" href="HomeVendeur.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="logo">
                <a href="../Profils/ProfilVendeur.php"><svg class="profil" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z" />
                        <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd" />
                    </svg></a>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Item, vendeur...." aria-label="Search">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>
    <div class="Wrapper-VM">
        <div class="vertical-menu">
            <a href="#" class="active">Accueil</a>
            
            <div class="Categorie">
                <select style="min-width : 170px">
                    <option hidden> Catégorie </option>
                    <option value="1">Feraille et Trésor</option>
                    <option value="2">Bon pour le musée</option>
                    <option value="3">Accessoire VIP</option>
                </select>
            </div>
            <div class="Achat">
                <select style="min-width : 170px">
                    <option hidden> Achat </option>
                    <option value="1"> Enchère</option>
                    <option value="2">Achat immédiat</option>
                    <option value="3">Meilleur offre</option>
                </select>
            </div>
            <div>
                <p>Hello, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b></p>
                <p>
                    <a href="../../BackEnd/Auth/logout.php" class="btn btn-danger">Sign Out of Your Account</a>
                </p>
            </div>
        </div>
    </div>
    <div class="listItems">
        <div class="row list" style="margin-left:0%">
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>