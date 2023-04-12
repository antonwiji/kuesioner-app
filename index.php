<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: kuis.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Kuesioner</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/loading.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="content">
        <div id="loading">
            <div class="spinner"></div>
        </div>
        <center>
            <a href="user.php">
                <button class="button-home possiton-button-umum">
                    <h2>Umum</h2>
                </button>
            </a>
            <a href="login.php">
                <button class="button-home possiton-button-server">
                    <h2>Admin server</h2>
                </button>
            </a>
        </center>
    </div>
    <script src="./script/loading.js"></script>
</body>

</html>