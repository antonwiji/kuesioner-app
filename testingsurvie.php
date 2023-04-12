<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit();
}

include "connection.php";

$databysurvie = query("SELECT YEAR(crated_at) as age FROM user_tb GROUP BY YEAR(crated_at);");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data Survie</title>
    <link rel="stylesheet" href="./style/loading.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <center>
        <div id="loading">
            <div class="spinner"></div>
        </div>
        <nav class="m-2" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Arsip</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-center">
            <div class="card mt-4" style="width: 18rem;">
                <div class="card-header">
                    Tahun Survie
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($databysurvie as $row) : ?>
                        <li class="list-group-item">
                            <a href="singlesurvie.php?data=<?= $row["age"] ?>">
                                <?= $row["age"] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="mt-3">
            <a href="logout.php" class="btn btn-danger">Log out</a>
        </div>
        <center>
            <script src="./script/loading.js"></script>
</body>

</html>