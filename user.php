<?php
session_start();
include "connection.php";
if (isset($_SESSION['login'])) {
    header("Location: kuis.php");
    exit();
}
$alert = '';
$fetchSex = query("SELECT label from data_utility WHERE tag = 'sex'");
$fetchPendidikan = query("SELECT label from data_utility WHERE tag = 'pendidikan'");

if (isset($_POST['btn-save'])) {
    $name = $_POST['nama'];
    $jamSurvie = $_POST['jam_survie'];
    $usia = $_POST['usia'];
    $sex = $_POST['sex'];
    $pendidikan = $_POST['pendidikan'];
    $jnsLayanan = $_POST['jns_layanan'];

    $query = "INSERT INTO user_tb (nama, usia, sex, pendidikan, jenis_layanan, jam_survie, crated_at) VALUES ('$name', '$usia', '$sex', '$pendidikan', '$jnsLayanan', '$jamSurvie', NOW())";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $alert = '<div class="alert alert-success" role="alert">
        Data Berhasil di buat
    </div>';
        $_SESSION["login"] = true;
        header("Location: kuis.php");
    } else {
        $alert = '<div class="alert alert-danger" role="alert">
        Data Gagal di buat
      </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/loading.css">
    <title>Kuesioner Application</title>
</head>

<body>
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <div class="content user">
        <div class="content-user">
            <form method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="text-size-costume">
                            Tanggal Survei : <?= date('d/m/Y') ?>
                        </h5>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-size-costume">
                                    Jam survei :
                                </p>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jam_survie" id="flexRadioDefault1" value="08.00-12.00" required>
                                    <label class="form-check-label text-size-costume" for="flexRadioDefault1">
                                        08.00-12.00
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jam_survie" id="flexRadioDefault2" value="13.00-16.00" required>
                                    <label class="form-check-label text-size-costume" for="flexRadioDefault2">
                                        13.00-16.00
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form">
                    <?= $alert ?>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="usia" class="col-sm-2 col-form-label">Usia</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="usia" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sex" class="col-sm-2 col-form-label">jenis kelamin</label>
                        <div class="col-sm-6">
                            <select class="form-select" aria-label="Default select example" name="sex" required>
                                <option value="" selected>Open this select menu</option>
                                <?php
                                foreach ($fetchSex as $row) :
                                ?>
                                    <option value="<?php $row["label"] ?>"><?= $row["label"] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                        <div class="col-sm-6">
                            <select class="form-select" aria-label="Default select example" name="pendidikan" required>
                                <option value="" selected>Open this select menu</option>
                                <?php
                                foreach ($fetchPendidikan as $row) :
                                ?>
                                    <option value="<?= $row['label'] ?>"><?= $row['label'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jns_layanan" class="col-sm-2 col-form-label">Jenis Layanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jns_layanan" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3" name="btn-save">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="./script/loading.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>