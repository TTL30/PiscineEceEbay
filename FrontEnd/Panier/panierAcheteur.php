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
include '../../BackEnd/Achat/Nego/getDataNegocia.php';

$itemsPanier = getItemPanier();

$mesBanq = getAdresseAcheteur();
if ($mesBanq[4] === 0) {
    $solde = " Ajouter vos informations bancaires dans votre profil afin de profiter pleinement de EbayEce!";
} else {
    $solde = $mesBanq[3];
}

$tot=0;

foreach($itemsPanier as &$it){
    $tot += $it[0][3];
    
}



?>


<script>
    var mesdata = <?php echo json_encode($mesBanq); ?>;
    if (mesdata[4] === 0) {
        $(document).ready(function() {
            $("#lit").css('display', 'none')
        });
    } else {
        $(document).ready(function() {
            $("#all").css('display', 'none')
        });
    }

</script>




<script type="text/javascript">
    var itemsPanier = <?php echo json_encode($itemsPanier); ?>;
    console.log(itemsPanier);
    insertItems = function() {
        var parent = document.getElementsByClassName("row list")[0];
        var Total = document.getElementsByClassName("tableM")[0];
        var Kt="";
        var TA="";
        if(itemsPanier.length===0){
            console.log("Vide");
            var vide=document.createElement('div');
            vide.className='jumbotron'
            vide.style="margin:auto; margin-top:10%"
            var txt = document.createElement('h3');
            txt.innerHTML="Votre panier est vide ajouter des objets en vous rendant à l'accueil.";
            txt.className='my-4';
            vide.appendChild(txt);
            parent.appendChild(vide);            
        }else{
        itemsPanier.forEach(function(e) {
            document.cookie = "item ="+e[0][0];

            var pani = document.createElement('tr');
            var titre = document.createElement('td');
            titre.innerHTML = e[0][1];
            titre.style='color:whitesmoke'
            var prix = document.createElement('td');
            prix.innerHTML=e[0][3]+'€';
            prix.style='color:#04F00A'
            pani.appendChild(titre);
            pani.appendChild(prix);
            Total.appendChild(pani);


            if(e[0][6].localeCompare("Feraille_et_Tresor")==0){
                Kt = "Trésor";
            }
            else if(e[0][6].localeCompare("Bon_pour_le_musee")==0){
                Kt = "Musée";
            }
            else if(e[0][6].localeCompare("Accesoires_VIP")==0){
                Kt = "VIP";
            }

            if(e[0][5].localeCompare("enchere")==0){
                TA = "Enchère";
            }
            else if(e[0][5].localeCompare("immediat")==0){
                TA = "Achat Immediat";
            }
            else if(e[0][5].localeCompare("offre")==0){
                TA = "Meilleure offre";
               
            }

            var link = document.createElement('a');
            link.setAttribute('href', '../Items/AchatItems.php' + '?item=' + e[0][0] + '?vendor=' + e[0][2]);
            link.className='linkItem';
            var col = document.createElement('div');
            col.className = 'col-sm-4';
            col.id='cont'
            var title = document.createElement('p');
            title.className = 'titleItem';
            var span_text = document.createTextNode(e[0][1]);
            title.appendChild(span_text);
            var img = document.createElement('img');
            img.setAttribute('src', '../../BackEnd/IMG/ITEM/' + e[0][4])
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


            var prixItm =document.createTextNode(e[0][3] + '€');
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

        })};

      
    }
    window.onload = insertItems
</script>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                           background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
            <a class="navbar-brand" href="../HomePage/HomeAcheteur.php" style="width:170px;text-align:center"> 
                <img src="logo.png" alt="" width="65" height="30"> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav class="nav">
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

            <div>
                <p style="margin-top:20%;color:white">Votre solde actuel est de: <b><?php echo $solde ?>€</b></p>
                <p style="margin-top:20%;color:white">Votre panier est calculé par rapport au prix initial du produit</b></p>
                <table class="table">
                    <tbody class="tableM">
                
                    </tbody>
                </table>
                <hr class="my-1" style="background-color: red;height:5px">
                <tr>
                    <td><p style="color : white">Cout total Panier:</p></td>
                    <td><h4 style="color : white"><?php echo $tot ?>€</h4></td>
                </tr>
          </div>
         </div>
      </div>
          

    <div class="listItems">
        <div class="alert alert-warning" role="alert" style="margin-top:20%;text-align:center" id="all">
            Merci de remplir vos coordonées bancaires ainsi que d'accepter la clause afin de pouvoir profiter de votre panier.
        </div>
        <div class="row list" style="margin-left:0%" id="lit">
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