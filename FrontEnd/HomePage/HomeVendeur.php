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

    checkEnchere();
    ?>


<script type="text/javascript">
    var itemsToSell = <?php echo json_encode($itemsToSell); ?>;
    console.log(itemsToSell);

    insertItems = function() {
        var parent = document.getElementsByClassName("row list")[0];
        var Kt="";
        var TA="";
        if(itemsToSell.length===0){
            console.log("Vide");
            var vide=document.createElement('div');
            vide.className='jumbotron'
            vide.style="margin:auto; margin-top:10%"
            var txt = document.createElement('h3');
            txt.innerHTML="Vous n'avez aucun objet en vente";
            txt.className='my-4';
            var decr = document.createElement('p');
            decr.innerHTML='Ajoutez des objets en cliquant sur le bouton <strong>+</strong>';
            decr.className='lead';
            vide.appendChild(txt);
            vide.appendChild(decr);
            parent.appendChild(vide);            
        }else{

        
        itemsToSell.forEach(function(e) {

            if(e[0].categorie.localeCompare("Feraille_et_Tresor")==0){
                Kt = "Trésor";
            }
            else if(e[0].categorie.localeCompare("Bon_pour_le_musee")==0){
                Kt = "Musée";
            }
            else if(e[0].categorie.localeCompare("Accesoires_VIP")==0){
                Kt = "VIP";
            }

            if(e[0].typeAchat.localeCompare("enchere")==0){
                TA = "Enchère";
            }
            else if(e[0].typeAchat.localeCompare("immediat")==0){
                TA = "Achat Immediat";
            }
            else if(e[0].typeAchat.localeCompare("offre")==0){
                TA = "Meilleure offre";
            }

            var link = document.createElement('a');
            link.setAttribute('href', '../Items/FicheItemsVend.php' + '?item=' + e[0].id + '?vendor=' + e[0].email_vendor);
            link.className='linkItem';
            var col = document.createElement('div');
            col.className = 'col-sm-4';
            col.id='cont'
            var title = document.createElement('p');
            title.className = 'titleItem';
            var span_text = document.createTextNode(e[0].title);
            title.appendChild(span_text);
            var img = document.createElement('img');
            img.setAttribute('src', '../../BackEnd/IMG/ITEM/' + e[0].img)
            var divImgTit = document.createElement('div');
            divImgTit.className = 'divImgTit';
            img.className = 'imgItem';
            var conta = document.createElement('div');

            var detail = document.createElement('div');
            detail.className="row";
            detail.style=('margin:0px;margin-top:1%')

            var categorie1= document.createElement('div');
            categorie1.className="col-sm-4";
            var categorie= document.createElement('div');
            categorie.className="col-sm-12";
            categorie.style=('text-align:center')
            categorie1.appendChild(categorie);

            var prix1= document.createElement('div');
            prix1.className="col-sm-3";
            var prix= document.createElement('div');
            prix.className="col-sm-12";
            prix.style=('text-align:center')
            prix1.appendChild(prix)


            var offre1= document.createElement('div');
            offre1.className="col-sm-5";
            var offre= document.createElement('div');
            offre.className="col-sm-12";
            offre.style=('text-align:center')
            offre1.appendChild(offre)


            var prixItm =document.createTextNode(e[0].prix + '€');
            prix.appendChild(prixItm)
            prix.style=('text-align:center; background-color:#F35C56;border-radius:5px;padding:10px;color:white')


            var catItem =document.createTextNode(Kt);
            categorie.appendChild(catItem);
            categorie.style=('text-align:center; background-color:#A4B4BE;border-radius:5px;padding:10px;color:white')

            var tyAitem =document.createTextNode(TA);
            offre.appendChild(tyAitem)
            offre.style=('text-align:center; background-color:#98BBDA;border-radius:5px;padding:10px;color:white')

            detail.appendChild(categorie1)
            detail.appendChild(prix1)
            detail.appendChild(offre1)

             
            conta.className = 'conta';
            divImgTit.appendChild(img);
            conta.appendChild(title);
            conta.appendChild(divImgTit)
            conta.appendChild(detail)
            link.appendChild(conta)
            col.appendChild(link)
            parent.appendChild(col);
        });}
    }
    window.onload = insertItems
</script>
<script>

function achat2(){
    if(document.getElementById('achat1').value == "enchere") {
        document.getElementById('immed').disabled =true;
        document.getElementById('offer').disabled =true
     }
     if(document.getElementById('achat1').value == "offre") {
        document.getElementById('immed').disabled =false;
        document.getElementById('offer').disabled =true
     }
     if(document.getElementById('achat1').value == "immediat") {
        document.getElementById('immed').disabled =true;
        document.getElementById('offer').disabled =false;
     }
}
</script>




    <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
            <a class="navbar-brand" href="HomeVendeur.php" style="width:170px;text-align:center"> <img src="logo.png" alt="" width="65" height="30"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav class="nav" >
                    <a id="lien" class="nav-link" href="../Panier/itemVenduVendor.php">Ventes</a>
                    <a id="lien" class="nav-link" href="../Panier/negociation.php">Offres</a>
                </nav>
                <div class="container">
                    <div class="logo dropleft">
                        <button class="btn btn-sm dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" style="background-color:#f1404b" >

                            <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                                </svg></a>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu" style="text-align:center">
                            <a class="dropdown-item" href="../Profils/ProfilVendeur.php">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>    
        <div class="Wrapper-VM">
            <div class="vertical-menu">
                <a href="#" class="active"><strong>Mes objets</strong></a>
                <form>
                    <div class="Categorie">
                        <label style="color:white">Appliquer des filtres:</label>
                        <select style="min-width : 170px;margin-top:10%" name="categorie">
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
                    <button type="submit" class="btn" style="margin-top:10%;background-color:rgba(241,149,155,0.8);color:white">Valider</button>
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
               </script>
          <div class="row list" style="margin-left:0%">
            </div>
            <div class="col-sm-4">
                <div style="height : 350px;text-align : center;border-radius: 5px;margin-top:5%">
                    <a data-toggle="modal" data-target="#ModalAjout">
                        <i class="fas fa-plus-square fa-7x" id="add" style="color:green; margin-top:20%"></i>
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
                                <select class="form-control" name="typeAchat" required="" onchange="achat2()" id="achat1">
                                    <option value="immediat">Achat immédiat</option>
                                    <option value="offre">Meilleur offre</option>
                                    <option value="enchere">Enchère (24 heures)</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Type Achat 2">Type d'achat secondaire:</label>
                                <select class="form-control" name="typeAchat2" required="">
                                    <option value="aucun" >Aucun</option>
                                    <option value="immediat" id = "immed">Achat immédiat</option>
                                    <option value="offre" id = "offer">Meilleur offre</option>
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
        <footer class="footer mt-auto py-3" id="pied">
            <div class="container" style="text-align:center" >
                <span class="text-muted">Nous contacter <a href="#"> eceebay@sav.fr </a></span>
            </div>
            <div class="container" style="text-align:center" >
                <span class="text-muted"><a href="#"> Besoin d'aide ?</a></span>
            </div>
        </footer>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    </body>

</html>