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
    <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <title>EceBay</title>
</head>


<?php
include '../../BackEnd/Vendor/getDataVendor.php';
include '../../BackEnd/Items/trieItemsVendor.php';
include '../../BackEnd/Achat/Enchere/checkEnchere.php';
$url = $_SERVER['REQUEST_URI'];
$myUrl = explode("?", $url);
if (!empty($myUrl[1])) {
    $macategorie = explode("=", explode("&", parse_url($url)["query"])[0])[1];
    $monTypeAchat = explode("=", explode("&", parse_url($url)["query"])[1])[1];
    $itemsToSell = trieItemsVendor($macategorie, $monTypeAchat);
} else {
    $itemsToSell = getDBData();
}
    $date = new  DateTime();
    $dteStart = new DateTime();
    $dteEnd   = date_add($date, date_interval_create_from_date_string('0 days'));
    $dteDiff  = $dteStart->diff($dteEnd);    
    $json =  @json_encode($dteDiff->format("%D:%H:%I:%S"));
    print "<script>console.log($json);</script>";
    if(strcmp($dteDiff->format("%D:%H:%I:%S"),"00:00:00:00") == 0 )
    {
        $json =  @json_encode("oui");
        print "<script>console.log($json);</script>";
    }

    checkEnchere();
?>

<script type="text/javascript">
    var itemsToSell = <?php echo json_encode($itemsToSell); ?>;
    console.log(itemsToSell);

    insertItems = function() {
        var parent = document.getElementsByClassName("row list")[0];
        itemsToSell.forEach(function(e) {
            var link = document.createElement('a');
            link.setAttribute('href', '../Items/FicheItems.php' + '?item=' + e[0].title + '?vendor=' + e[0].email_vendor);
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
            <div class="container">
                      <div class="logo dropleft">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" >

                            <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                                </svg></a>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu" style="text-align:center">
                        <a class="dropdown-item" href="../Panier/itemVenduVendor.php">Mes Ventes</a>
                        <a class="dropdown-item" href="../Panier/negociation.php">Mes NEGOS</a>

                            <a class="dropdown-item" href="../Profils/ProfilVendeur.php">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                        </div>
                    </div>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Item, vendeur...." aria-label="Search">
                    <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
                </div>
        </div>
    </nav>  
    <div class="Wrapper-VM">
        <div class="vertical-menu">
            <a href="#" class="active">Vos Items</a>
            <form>
                <div class="Categorie">
                    <select style="min-width : 170px" name="categorie">
                        <option value="all" hidden> Catégorie </option>
                        <option value="Feraille_et_Tresor">Feraille et Trésor</option>
                        <option value="Bon_pour_le_musee">Bon pour le musée</option>
                        <option value="Accesoires_VIP">Accessoire VIP</option>
                    </select>
                </div>
                <div class="Achat">
                    <select style="min-width : 170px" name="Achat">
                        <option value="all" hidden> Achat </option>
                        <option value="enchere"> Enchère</option>
                        <option value="immediat">Achat immédiat</option>
                        <option value="offre">Meilleur offre</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10% ">Valider</button>
            </form>
        </div>
    </div>

    <div class="listItems">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="monalert">
            <strong>Attention!</strong> Vous avez deja ajouté cet item.
                <button type="button" class="close" aria-label="Close" onclick="window.location.href='/FrontEnd/HomePage/HomeVendeur.php'">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <script>
            if (window.location.href === "http://piscineeceebay.loc/FrontEnd/HomePage/HomeVendeur.php??") {
                document.getElementById('monalert').style.display = "block";
            } else {
                document.getElementById('monalert').style.display = "none";
            }

            function showDiv(divId, element)
            {
                document.getElementById(divId).style.display = element.value == 'enchere' ? 'block' : 'none';
            }
        </script>
        <div class="row list" style="margin-left:0%">
        </div>
        <div class="col-sm-4">
            <div style="height : 200px;text-align : center;border-radius: 5px;">
                <a data-toggle="modal" data-target="#ModalAjout">
                    <i class="fas fa-plus-square fa-7x"></i>
                </a>
            </div>
        </div>

        <div class="modal fade" id="ModalAjout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../../BackEnd/Vendor/addItems.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Title">Intitulé:</label>
                                <input type="text" class="form-control" placeholder="Entrer l'intitulé de votre item" name="title" required="">
                            </div>
                            <div class="form-group">
                                <label for="Description">Description:</label>
                                <textarea class="form-control" name="description" rows="1" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Categorie">Catégorie:</label>
                                <select class="form-control" name="categorie" required="">
                                    <option value="Feraille_et_Tresor">Feraille et Trésor</option>
                                    <option value="Bon_pour_le_musee">Bon pour le musée</option>
                                    <option value="Accesoires_VIP">Accessoire VIP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Type Achat">Type d'achat:</label>
                                <select class="form-control" name="typeAchat" required="" onchange="showDiv('hidden_div', this)">
                                    <option value="enchere">Enchère (24 heures)</option>
                                    <option value="immediat">Achat immédiat</option>
                                    <option value="offre">Meilleur offre</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="Price">Prix:</label>
                                <div class="input-group-text">
                                    <input type="number" class="form-control" name="prix" required="">
                                    <div class="€">
                                        <span>€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Photo">Image:</label>
                                <input type="file" class="form-control-file" name="img" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="Submit">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


</body>

</html>