<?php
include "config.php";

session_start();

$conn = new mysqli($servername, $username, $password);
$conn->select_db($database);

function mods($amount){
    global $conn;
    $result = $conn->query("SELECT * FROM mods LIMIT '$amount'");
    return $result;
}

function getTemplate($path){
    global $sitename;
    return str_replace("_sitename_", $sitename, file_get_contents("templates/".$path.".html"));
}

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return array_reverse($rows);
}
