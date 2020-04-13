<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../Auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>
<?php
include '../../BackEnd/Vendor/getDataVendor.php';
$itemsToSell = getDBData();
foreach ($itemsToSell as &$value) {
    echo $value['title'];
    echo $value['email_vendor'];
}
?>

<script type="text/javascript">
    var users = <?php echo json_encode($itemsToSell); ?>;
    // console.log(users);
    // users.forEach(element => {
    //     console.log(element.title);
    // })
    // let listItems = users.map((d) =>
    //     <div>
    //         <p>{d.title}</p>
    //     </div>
    // )

    insert_divs = function() {
        var parent = document.getElementsByClassName("panel-body")[0];
        var installments = ['Installment 1', 'Installment 2', 'Installment 3', 'Installment 4', 'Installment 5'];

        users.forEach(function(e) {

            var sp = document.createElement('span');
            var img = document.createElement('img');
            var installment = document.createElement('div');

            var span_text = document.createTextNode(e.title);
            sp.appendChild(span_text);

            img.setAttribute('src', 'https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_cancel_48px-128.png')
            installment.classList.add('panel-more1');

            installment.appendChild(img);
            installment.appendChild(sp);

            parent.appendChild(installment);

        });



    }

    window.onload = insert_divs
</script>

<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</h1>

    </div>
    <div id="listContainer">
    <div>
        <ul class="list-group">
            <li>
                <div class="panel-body panel panel-default" style="height: 70px;">
                    <div class="panel-info">
                        <p><strong>Shailendra Kushwah</strong></p>

                    </div>

               </div>
            </li>
        </ul>
    </div>
</div>
    <p>
        <a href="../../BackEnd/Auth/logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>

</html>