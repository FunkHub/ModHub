<?php
require 'features.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

if(isset($_POST['username'])){
    $user = $_POST['username'];
    if(!$conn->query("SELECT * FROM accounts")) die("Error logging in.");
}
else{
    echo(getTemplate("account"));
}
