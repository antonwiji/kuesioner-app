<?php

function splite($data, $urut)
{
    $result = explode(',', $data);
    return intval($result[$urut]);
}

$data1 = "1,2,3,4,5";
$data2 = "4,3,1,4,5";

$print = splite($data1, 1);

var_dump($print);
