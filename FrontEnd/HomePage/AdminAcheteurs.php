<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../Auth/login.php");
    exit();
}
?>



<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>EceBay</title>
        <link href="Admin.css" rel="stylesheet" media="all" type="text/css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/6569843510.js" crossorigin="anonymous"></script>

    </head>

    <?php
    include '../../BackEnd/Admin/getUsers.php';
    $Acheteurs = getAcheteur();


    ?>

    <script type="text/javascript">
        var Acheteurs = <?php echo json_encode($Acheteurs); ?>;
        console.log(Acheteurs);
        var acheteur = "";
        var total = 0;
        insertItems = function() {
            var parent = document.getElementsByClassName("list")[0];
            Acheteurs.forEach(function(e) {
                var tr = document.createElement('tr');
            
                var vente = document.createElement('th');
                vente.setAttribute('scope','row');
                vente.innerHTML = e["id"];
                var title = document.createElement('td');
                title.innerHTML=e["email"];
                var achat = document.createElement('td');
                achat.innerHTML=e["name"];
                var prix = document.createElement('td');
                prix.innerHTML=e["last_name"];
                var dateCrea = document.createElement('td');
                dateCrea.innerHTML=e["created_at"];
                tr.appendChild(vente)
                tr.appendChild(title)
                tr.appendChild(achat)
                tr.appendChild(prix)
                tr.appendChild(dateCrea)
                parent.appendChild(tr);

            });
        }
        window.onload = insertItems  
    </script>
    <body>
        <div class="container">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="border-bottom: 1px solid grey; background: rgb(221,223,230);
                                                                               background: linear-gradient(320deg, rgba(221,223,230,1) 0%, rgba(241,149,155,1) 46%, rgba(37,44,65,1) 100%);">
                <a class="navbar-brand" href="HomeAdmin.php"> <img src="logo.png" alt="" width="60" height="30"> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="btn-top" style="margin-left:6%">
                        <nav class="nav" >
                            <a id="lien" class="nav-link" href="AdminItems.php">Liste des items</a>
                            <a id="lien" class="nav-link active" href="AdminAcheteurs.php">Liste des acheteurs</a>
                            <a id="lien" class="nav-link" href="AdminVendeurs.php">Liste des vendeurs</a>
                        </nav>
                    </div>
                    <div class="container">
                        <div class="logo dropleft">
                            <a href="../../BackEnd/Auth/logout.php" class="btn btn-sm btn-outline-danger">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="Wrapper-VM">
            <div class="vertical-menu">
                <a href="HomeAdmin.php" class="active"><strong style="color:white">Acheteurs</strong></a>
            </div>
        </div>
        <div class="listItems">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date Creation du compte</th>
                    </tr>
                </thead>
                <tbody class="list">

                </tbody>
            </table>
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

</html>