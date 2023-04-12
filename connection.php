<?php
$conn = mysqli_connect("localhost", "root", "", "kuesioner-db");
// $conn = mysqli_connect("localhost", "id20504194_admin1", "xYR3#9)3RX/QRaGM", "id20504194_kuesioner_db");

function query($query)
{
    global $conn;
    $result  = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
