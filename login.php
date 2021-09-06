<?php
require 'features.php';

if(isset($_POST['username'])){
    $user = $_POST['username'];
    if(!$conn->query("SELECT * FROM accounts")) die("Error logging in.");
}
else{
    echo(getTemplate("account"));
}