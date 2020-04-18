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

        <title>EceBay</title>
        <link href="accueil.css" rel="stylesheet" media="all" type="text/css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>

    </head>



    <?php
    include '../../BackEnd/Acheteur/getDataAcheteur.php';
    include '../../BackEnd/Acheteur/getItemPanier.php';
    $itemsPanier = getItemPanier();

    $mesBanq = getAdresseAcheteur();
    if ($mesBanq[4] === 0) {
        $solde = " Ajouter vos informations bancaires dans votre profil afin de profiter pleinement de EbayEce!";
    } else {
        $solde = $mesBanq[3];
    }

    ?>


    <script type="text/javascript">
        var itemsPanier = <?php echo json_encode($itemsPanier); ?>;
        console.log(itemsPanier);
        insertItems = function() {
            var parent = document.getElementsByClassName("row list")[0];
            itemsPanier.forEach(function(e) {
                var link = document.createElement('a');
                link.setAttribute('href', '../Items/AchatItems.php' + '?item=' + e[0][1] + '?vendor=' + e[0][2]);
                var col = document.createElement('div');
                col.className = 'col-sm-4';
                var title = document.createElement('p');
                title.className = 'titleItem';
                var span_text = document.createTextNode(e[0][1]);
                title.appendChild(span_text);
                var img = document.createElement('img');
                img.setAttribute('src', '../../BackEnd/IMG/' + e[0][4])
                var divImgTit = document.createElement('div');
                divImgTit.className = 'divImgTit';
                img.className = 'imgItem';
                var conta = document.createElement('div');
                var descri = document.createElement('span');
                descri.className = 'badge badge-success'
                var span_prix = document.createTextNode(e[0][3] + '€');
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

        <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
            <a class="navbar-brand" href="../HomePage/HomeAcheteur.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav class="nav" style="margin-left:6%">
                    <a id="lien" class="nav-link" href="../Panier/mesAchats.php">Mes achats</a>
                    <a id="lien" class="nav-link active" href="../Panier/panierAcheteur.php"><i class="fas fa-shopping-cart"></i></a>
                </nav>
                <div class="container">
                    <div class="logo dropleft">
                        <button class="btn btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"  style="background-color:#f1404b" >

                            <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                                </svg></a>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu" style="text-align:center">
                            <a class="dropdown-item" href="../Profils/ProfilGene.php">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav> 

        <div class="Wrapper-VM">
            <div class="vertical-menu">
                <a href="#" class="active" style="color:white"><strong>Mon Panier</strong></a>

                <div style="color:white">
                    <p>Hello, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b></p>
                    <p>Votre solde actuel est de: <b><?php echo $solde ?>€</b></p>

                </div>
            </div>
        </div>
        <div class="listItems">
            <div class="row list" style="margin-left:0%">
            </div>
        </div>

        <footer class="footer mt-auto py-3" id="pied">
            <div class="container" style="text-align:center" >
                <span class="text-muted">Nous contacter <a href="#"> eceebay@sav.fr </a></span>
            </div>
            <div class="container" style="text-align:center" >
                <span class="text-muted"><a href="#"> Besoin d'aide ?</a></span>
            </div>
        </footer>

    </body>

</html>