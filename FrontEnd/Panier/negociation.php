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
</head>



<?php
include '../../BackEnd/Achat/Nego/getDataNego.php';
$itemNego = getDataNego();
?>

<script type="text/javascript">
    var itemsPanier = <?php echo json_encode($itemNego); ?>;
    console.log(itemsPanier);
    var etat = "";
  

    var acheteur = "";
    var total = 0;
    insertItems = function() {

        var parent = document.getElementsByClassName("list")[0];
        itemsPanier.forEach(function(e) {
            if(e["email_acheteur"] != ""){

            
            var tr = document.createElement('tr');
            tr.id= e["id"]+"tr"

            var vente = document.createElement('th');
            vente.setAttribute('scope', 'row');
            vente.innerHTML = e["id"];
            var iditem = document.createElement('td');
            iditem.innerHTML = e["id_item"];
            var title = document.createElement('td');
            title.innerHTML = e["title"];
            var etat = document.createElement('td');
            etat.id=e["id"]+"state"

            var offre = document.createElement('td');
            var forA = document.createElement('form');
            forA.className = 'form-inline';
            forA.action = '../../BackEnd/Achat/Nego/acceptPropVendeur.php';
            forA.method = 'POST';
            forA.id = e["id"]+'formA';
            forA.onsubmit=function(){alert("Felicitations vous avez conclu une transaction retrouvez la dans vos ventes");};

            var det = document.createElement('div');
            det.className = 'form-group mx-sm-1 mb-2';
            var iditemform1 = document.createElement('input');
            iditemform1.type = 'number';
            iditemform1.name = 'id_item';
            iditemform1.value = e["id_item"];
            iditemform1.style = 'display:none';

            var emailachet3 = document.createElement('input');
            emailachet3.type = 'text';
            emailachet3.name = 'email_acheteur';
            emailachet3.value = e.email_acheteur;
            emailachet3.style = 'display:none';

            var achtoffre = document.createElement('input');
            achtoffre.className = 'form-control';
            achtoffre.type = 'number';
            achtoffre.name = 'offreAcheteur';
            achtoffre.readOnly = 'yes';
            achtoffre.value = e.offre_acheteur;
            achtoffre.style=('max-width:80px')

            var subaccept = document.createElement('button');
            subaccept.type = 'submit';
            subaccept.name = 'submit';
            subaccept.className = "btn btn-primary mb-2";
            subaccept.innerHTML = "Accepter";

            det.appendChild(iditemform1);
            det.appendChild(emailachet3)
            det.appendChild(achtoffre);
            forA.appendChild(det);
            forA.appendChild(subaccept);
            offre.appendChild(forA);

            var prop = document.createElement('td');
            var forB = document.createElement('form');
            forB.className = 'form-inline';
            forB.action = '../../BackEnd/Achat/Nego/contrePropositionVendeur.php';
            forB.method = 'POST';
            forB.id = e["id"]+"formB";
            forB.onsubmit=function(){alert("Vous avez fait une contre proposition de "+Veneuroffre.value+"€");};

            var detB = document.createElement('div');
            detB.className = 'form-group mx-sm-3 mb-2';

            var iditemform2 = document.createElement('input');
            iditemform2.type = 'number';
            iditemform2.name = 'id_item';
            iditemform2.value = e.id_item;
            iditemform2.style = 'display:none';

            var emailachet2 = document.createElement('input');
            emailachet2.type = 'text';
            emailachet2.name = 'email_acheteur';
            emailachet2.value = e["email_acheteur"];
            emailachet2.style = 'display:none';

            var Veneuroffre = document.createElement('input');
            Veneuroffre.className = 'form-control';
            Veneuroffre.type = 'number';
            Veneuroffre.name = 'offreVendeur';
            Veneuroffre.style=('max-width:80px');
            Veneuroffre.required= true;

            var subaccept2 = document.createElement('button');
            subaccept2.type = 'submit';
            subaccept2.name = 'submit';
            subaccept2.className = "btn btn-primary mb-2";
            subaccept2.innerHTML = "Contre"

            if (e['last_offer'] == 0) {
                $(document).ready(function() {
                    $("#"+e["id"]+"formA"+" :input").prop("disabled", true);
                    $("#"+e["id"]+"formB"+" :input").prop("disabled", true);
                    $("#"+e["id"]+"tr"+"").css("background-color","yellow");
                    $("#"+e["id"]+"state"+"").html("en attente de l'acheteur");
                });
            }else{
                $(document).ready(function() {
                    $("#"+e["id"]+"tr"+"").css("background-color","green");
                    $("#"+e["id"]+"state"+"").html("en attente de votre reponse");

                });
            }

            detB.appendChild(iditemform2);
            detB.appendChild(emailachet2);
            detB.appendChild(Veneuroffre);
            forB.appendChild(detB);
            forB.appendChild(subaccept2);
            prop.appendChild(forB);



            tr.appendChild(vente)
            tr.appendChild(iditem)
            tr.appendChild(title)
            tr.appendChild(offre)
            tr.appendChild(prop)
            tr.appendChild(etat);
            parent.appendChild(tr);

            // document.getElementById('argent').innerHTML = "Vous deja avez gagné <strong>" + total + "€</strong>"

        }});
    }
    window.onload = insertItems
</script>

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background-color: whitesmoke;">
        <a class="navbar-brand" href="../HomePage/HomeVendeur.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container">
                <div class="logo dropleft">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">

                        <a href="../Profils/ProfilVendeur.php"><svg class="dropdown toggle" width="2em" height="2em" viewBox="0 0 16 16" fill="black" xmlns="http://www.w3.org/2000/svg" style="padding-right: 5px;margin-right: 0px">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z" />
                                <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd" />
                            </svg></a>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" style="text-align:center">
                        <a class="dropdown-item" href="itemVenduVendor.php">Mes Ventes</a>
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
            <a href="#" class="active">Mes Ventes</a>

            <div>
                <p>Hello, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b></p>
                <!-- <p id="argent"></p> -->
            </div>
        </div>
    </div>
    <div class="listItems">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">n° de vente</th>
                    <th scope="col">Id item</th>
                    <th scope="col">Intitulé</th>
                    <th scope="col">offre Acheteur</th>
                    <th scope="col">Contre Proposition</th>
                    <th scope="col">Etat</th>
                </tr>
            </thead>
            <tbody class="list" >


            </tbody>
        </table>
    </div>



</body>

</html>