<?php
include "connection.php";
session_start();
$responden = $_POST['responden'];

$result = explode(',', $responden);

$result = mysqli_query($conn, "INSERT INTO answers_user_tb (id_user, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10) VALUES ((SELECT MAX(id) FROM user_tb), '$result[0]', '$result[1]', '$result[2]', '$result[3]', '$result[4]', '$result[5]', '$result[6]', '$result[7]', '$result[8]', '$result[9]')");

if ($result) {
    session_unset();
    session_destroy();
}
