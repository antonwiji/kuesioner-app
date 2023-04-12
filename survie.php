<?php

include 'connection.php';

$data = query('SELECT user_tb.nama, answers_user_tb.* FROM answers_user_tb INNER JOIN user_tb ON answers_user_tb.id_user = user_tb.id;');

$total = query('SELECT SUM(u1) as t_u1, SUM(u2) as t_u2, SUM(u3) as t_u3, SUM(u4) as t_u4, SUM(u5) as t_u5, SUM(u6) as t_u6, SUM(u7) as t_u7, SUM(u8) as t_u8, SUM(u9) as t_u9, SUM(u10) as t_u10 FROM answers_user_tb');

$rows_question = query('SELECT COUNT(*) as countrow FROM answers_user_tb')[0]['countrow'];
$testing = query("SELECT SUM(u1)/('$rows_question') tu1, SUM(u2)/('$rows_question') tu2, SUM(u3)/('$rows_question') tu3, SUM(u4)/('$rows_question') tu4, SUM(u5)/('$rows_question') tu5, SUM(u6)/('$rows_question') tu6, SUM(u7)/('$rows_question') tu7, SUM(u8)/('$rows_question') tu8, SUM(u9)/('$rows_question') tu9, SUM(u10)/('$rows_question') tu10 FROM answers_user_tb");

function nnr_tertimbang($param, $query)
{
    $querydata = $query;
    $data = $querydata[0][$param];
    return round($data * 0.111, 3);
}

$sumData = array();

for ($x = 1; $x <= 10; $x++) {
    array_push($sumData, nnr_tertimbang("tu$x", $testing));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-c3ow {
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }
    </style>
</head>

<body>
    <div style="display: flex; justify-content: center;">
        <table class="tg" style="table-layout: fixed; width: 429px">
            <colgroup>
                <col style="width: 129.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.666666px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
                <col style="width: 40.333333px">
            </colgroup>
            <thead>
                <tr>
                    <th class="tg-0pky">Nama</th>
                    <th class="tg-0pky">U1</th>
                    <th class="tg-0pky">U2</th>
                    <th class="tg-0pky">U3</th>
                    <th class="tg-0pky">U4</th>
                    <th class="tg-0pky">U5</th>
                    <th class="tg-0pky">U6</th>
                    <th class="tg-0lax">U7</th>
                    <th class="tg-0lax">U8</th>
                    <th class="tg-0pky">U9</th>
                    <th class="tg-0pky">U10</th>
                    <th class="tg-0pky"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) : ?>
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
                <tr>
                    <td class="tg-0pky">Nilai/Unsur</td>
                    <?php foreach ($total as $row_total) : ?>
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
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($testing as $row_testing) : ?>
                    <tr>
                        <td class="tg-0pky">NRR Unsur</td>
                        <td class="tg-0pky"><?= round($row_testing['tu1'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu2'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu3'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu4'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu5'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu6'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu7'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu8'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu9'], 3) ?></td>
                        <td class="tg-0pky"><?= round($row_testing['tu10'], 3) ?></td>
                        <!-- <td class="tg-0pky"></td> -->
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="tg-0pky">NRR Tertimbang Unsurr</td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu1', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu2', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu3', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu4', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu5', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu6', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu7', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu8', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu9', $testing) ?></td>
                    <td class="tg-0pky"><?= nnr_tertimbang('tu10', $testing) ?></td>
                    <td class="tg-0pky"><?= array_sum($sumData) ?></td>
                </tr>
                <tr>
                    <td class="tg-0pky" colspan="11">IKM Unit Pelayanan</td>
                    <td class="tg-0pky"><?= array_sum($sumData) * 25 ?></td>
                </tr>
            </tbody>
        </table>
        <a href="/kuesioner-app"><button> Kembali Ke Home</button></a>
    </div>
</body>

</html>