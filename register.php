<?php
require 'features.php';

$name = $_POST['name'];
$pass = $_POST['pass'];
if(!isset($_POST['name']) || !isset($_POST['pass'])){
    echo(getTemplate("register"));
}
else {
    if($name != null && $pass != null ){
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $conn->query("INSERT INTO `accounts` (`username`, `password`, `banned`, `ID`) VALUES ('$name', '$pass', '0', NULL)");
        echo($conn->error);
    }
    else{
        echo("You forgot to set a name or a password!");
    }
}