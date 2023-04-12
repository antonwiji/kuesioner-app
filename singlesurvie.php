<?php
include "connection.php";
$data = $_GET['data'];

$first_month = query("SELECT user_tb.nama, user_tb.crated_at, answers_user_tb.* FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) <= 6;");

$last_month = query("SELECT user_tb.nama, user_tb.crated_at, answers_user_tb.* FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) > 6;");

$first_total = query("SELECT SUM(u1) as t_u1, SUM(u2) as t_u2, SUM(u3) as t_u3, SUM(u4) as t_u4, SUM(u5) as t_u5, SUM(u6) as t_u6, SUM(u7) as t_u7, SUM(u8) as t_u8, SUM(u9) as t_u9, SUM(u10) as t_u10 FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) <= 6;");

$last_total = query("SELECT SUM(u1) as t_u1, SUM(u2) as t_u2, SUM(u3) as t_u3, SUM(u4) as t_u4, SUM(u5) as t_u5, SUM(u6) as t_u6, SUM(u7) as t_u7, SUM(u8) as t_u8, SUM(u9) as t_u9, SUM(u10) as t_u10 FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) > 6;");

// mendapatkan Nilai N
$first_rows_question = query("SELECT COUNT(*) as countrow FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) <= 6;")[0]['countrow'];

$last_rows_question = query("SELECT COUNT(*) as countrow FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) > 6;")[0]['countrow'];

// mendapatkan Nilai Rata-rata
$first_rata_data = query("SELECT SUM(u1)/($first_rows_question) tu1, SUM(u2)/($first_rows_question) tu2, SUM(u3)/($first_rows_question) tu3, SUM(u4)/($first_rows_question) tu4, SUM(u5)/($first_rows_question) tu5, SUM(u6)/($first_rows_question) tu6, SUM(u7)/($first_rows_question) tu7, SUM(u8)/($first_rows_question) tu8, SUM(u9)/($first_rows_question) tu9, SUM(u10)/($first_rows_question) tu10 FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) <= 6;");

$last_rata_data = query("SELECT SUM(u1)/($last_rows_question) tu1, SUM(u2)/($last_rows_question) tu2, SUM(u3)/($last_rows_question) tu3, SUM(u4)/($last_rows_question) tu4, SUM(u5)/($last_rows_question) tu5, SUM(u6)/($last_rows_question) tu6, SUM(u7)/($last_rows_question) tu7, SUM(u8)/($last_rows_question) tu8, SUM(u9)/($last_rows_question) tu9, SUM(u10)/($last_rows_question) tu10 FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id WHERE YEAR(crated_at) = $data AND MONTH(crated_at) > 6;");

function nnr_tertimbang($param, $query)
{
    $querydata = $query;
    $data = $querydata[0][$param];
    return round($data * 0.111, 3);
}

$sum_data_first = array();
$sum_data_last = array();

for ($x = 1; $x <= 10; $x++) {
    array_push($sum_data_first, nnr_tertimbang("tu$x", $first_rata_data));
    array_push($sum_data_last, nnr_tertimbang("tu$x", $last_rata_data));
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/loading.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Survie Tahun <?= $data ?></title>
</head>

<body>
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <nav class="m-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="testingsurvie.php">Arsip</a></li>
            <li class="breadcrumb-item active" aria-current="page">Survie <?= $data ?></li>
        </ol>
    </nav>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Januari - Juni
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div style="display: flex; justify-content: center;">
                        <div class="table-content" style="overflow: scroll;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">U1</th>
                                        <th scope="col">U2</th>
                                        <th scope="col">U3</th>
                                        <th scope="col">U4</th>
                                        <th scope="col">U5</th>
                                        <th scope="col">U6</th>
                                        <th scope="col">U7</th>
                                        <th scope="col">U8</th>
                                        <th scope="col">U9</th>
                                        <th scope="col">U10</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($first_month as $row) : ?>
                                        <tr>
                                            <td class="tg-0pky"><?= $row['nama'] ?></td>
                                            <td class="tg-0pky"><?= $row['u1'] ?></td>
                                            <td class="tg-0pky"><?= $row['u2'] ?></td>
                                            <td class="tg-c3ow"><?= $row['u3'] ?></td>
                                            <td class="tg-0pky"><?= $row['u4'] ?></td>
                                            <td class="tg-0pky"><?= $row['u5'] ?></td>
                                            <td class="tg-0pky"><?= $row['u6'] ?></td>
                                            <td class="tg-0lax"><?= $row['u7'] ?></td>
                                            <td class="tg-0lax"><?= $row['u8'] ?></td>
                                            <td class="tg-0pky"><?= $row['u9'] ?></td>
                                            <td class="tg-0pky"><?= $row['u10'] ?></td>
                                            <!-- <td class="tg-0pky" rowspan="9"></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($first_total as $row_total) : ?>
                                        <tr>
                                            <td class="tg-0pky">Nilai/Unsur</td>
                                            <td class="tg-0pky"><?= $row_total['t_u1'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u2'] ?></td>
                                            <td class="tg-c3ow"><?= $row_total['t_u3'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u4'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u5'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u6'] ?></td>
                                            <td class="tg-0lax"><?= $row_total['t_u7'] ?></td>
                                            <td class="tg-0lax"><?= $row_total['t_u8'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u9'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u10'] ?></td>
                                            <!-- <td class="tg-0pky" rowspan="2"></td> -->
                                        </tr>
                                    <?php endforeach; ?>

                                    <?php foreach ($first_rata_data as $row_first_rata) : ?>
                                        <tr>
                                            <td class="tg-0pky">NRR Unsur</td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu1'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu2'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu3'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu4'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu5'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu6'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu7'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu8'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu9'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_first_rata['tu10'], 3) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="tg-0pky">NRR Tertimbang Unsurr</td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu1', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu2', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu3', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu4', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu5', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu6', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu7', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu8', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu9', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu10', $first_rata_data) ?></td>
                                        <td class="tg-0pky"><?= array_sum($sum_data_first) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tg-0pky" colspan="11">IKM Unit Pelayanan</td>
                                        <td class="tg-0pky"><?= array_sum($sum_data_first) * 25 ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Juli - December
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div style="display: flex; justify-content: center;">
                        <div class="table-content" style="overflow: scroll;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">U1</th>
                                        <th scope="col">U2</th>
                                        <th scope="col">U3</th>
                                        <th scope="col">U4</th>
                                        <th scope="col">U5</th>
                                        <th scope="col">U6</th>
                                        <th scope="col">U7</th>
                                        <th scope="col">U8</th>
                                        <th scope="col">U9</th>
                                        <th scope="col">U10</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($last_month as $row) : ?>
                                        <tr>
                                            <td class="tg-0pky"><?= $row['nama'] ?></td>
                                            <td class="tg-0pky"><?= $row['u1'] ?></td>
                                            <td class="tg-0pky"><?= $row['u2'] ?></td>
                                            <td class="tg-c3ow"><?= $row['u3'] ?></td>
                                            <td class="tg-0pky"><?= $row['u4'] ?></td>
                                            <td class="tg-0pky"><?= $row['u5'] ?></td>
                                            <td class="tg-0pky"><?= $row['u6'] ?></td>
                                            <td class="tg-0lax"><?= $row['u7'] ?></td>
                                            <td class="tg-0lax"><?= $row['u8'] ?></td>
                                            <td class="tg-0pky"><?= $row['u9'] ?></td>
                                            <td class="tg-0pky"><?= $row['u10'] ?></td>
                                            <!-- <td class="tg-0pky" rowspan="9"></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($last_total as $row_total) : ?>
                                        <tr>
                                            <td class="tg-0pky">Nilai/Unsur</td>
                                            <td class="tg-0pky"><?= $row_total['t_u1'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u2'] ?></td>
                                            <td class="tg-c3ow"><?= $row_total['t_u3'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u4'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u5'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u6'] ?></td>
                                            <td class="tg-0lax"><?= $row_total['t_u7'] ?></td>
                                            <td class="tg-0lax"><?= $row_total['t_u8'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u9'] ?></td>
                                            <td class="tg-0pky"><?= $row_total['t_u10'] ?></td>
                                            <!-- <td class="tg-0pky" rowspan="2"></td> -->
                                        </tr>
                                    <?php endforeach; ?>

                                    <?php foreach ($last_rata_data as $row_last_rata) : ?>
                                        <tr>
                                            <td class="tg-0pky">NRR Unsur</td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu1'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu2'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu3'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu4'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu5'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu6'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu7'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu8'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu9'], 3) ?></td>
                                            <td class="tg-0pky"><?= round($row_last_rata['tu10'], 3) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="tg-0pky">NRR Tertimbang Unsurr</td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu1', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu2', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu3', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu4', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu5', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu6', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu7', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu8', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu9', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= nnr_tertimbang('tu10', $last_rata_data) ?></td>
                                        <td class="tg-0pky"><?= array_sum($sum_data_last) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tg-0pky" colspan="11">IKM Unit Pelayanan</td>
                                        <td class="tg-0pky"><?= array_sum($sum_data_last) * 25 ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./script/loading.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>