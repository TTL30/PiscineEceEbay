<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.j s"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.j s"> </script>
    <title>EceBay</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>

    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <link href="InscriptionConnexion.css" rel="stylesheet" media="all" type="text/css">
</head>

<?php
     $myUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<body class="text-center">
    <div class="formulaire">
        <form class="form-signin" action="../../BackEnd/Auth/register.php" method="POST">
            <img class="mb-4" src="logo.png" alt="" width="200" height="200">
            <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>
            <h5> Veuillez renseigner les champs suivants</h5>
            <?php
                if (strpos($myUrl, "register=email") == true) {
                    echo "<span>Email deja utilise</span>";
                }
            ?>
            <label for="inputNom" class="sr-only">Nom</label>
            <input type="nom" id="inputNom" class="form-control" placeholder="Nom" required="" autofocus="" name="name">
            <label for="inputPrenom" class="sr-only">Prénom</label>
            <input type="prenom" id="inputPrenom" class="form-control" placeholder="Prénom" required="" name="last_name">
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="email">
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="" name="password">
            <div class="Type">
                <select size="1" class="mr-sm-2" name="type">
                    <option value="1">Je suis Administrateur</option>
                    <option value="2">Je suis ici pour vendre !</option>
                    <option value="3" selected>Je suis ici pour acheter !</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputAddress">Adresse</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="37 Quai de Grenelle">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Ville</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip">Code Postal</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit">Inscription</button>
            <button class="btn btn-primary btn-lg " type="reset" value="BouttonReset" name="ResetChamps"> Vider les champs</button>

        </form>
    </div>
    <p class="mt-5 mb-3 text-muted">© 2020 -- MARZE Oscar TEIXEIRA Tiago</p>

</body>

</html>