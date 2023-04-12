<?php
include "connection.php";
$querySoal = $_POST['query_soal'];
$data = query("select qt.question, ast.answers, ast.point from question_tb as qt inner join answers_tb ast on qt.id_answers = ast.id_question where qt.id = '$querySoal'");

echo json_encode($data);
