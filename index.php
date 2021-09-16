<?php
include "features.php";

$_SESSION["fuck"] = "session check";
if(isset($_GET['id'])) $ID = $_GET['id'];

if(!file_exists(".installed")){
    die("<script>document.write('Database has not been initialized yet! Please execute install.php');</script>");
}
//$result = $conn->query("SELECT * FROM mods");
//$row = $result->fetch_array(MYSQLI_BOTH);

// Usage
if(!isset($ID)){
    $result = $conn->query('SELECT * FROM mods');
    $rows = resultToArray($result);
    //var_dump($rows); // Array of rows
    $indexpage = getTemplate("main");
    $mods = '<ul>';
    for($i = 0; $i<sizeof($rows); $i++){
        $mods = $mods.'<li><a href="index.php?id='.$rows[$i]["ID"].'">'.$rows[$i]["NAME"].' - '. $rows[$i]["DESC"] .'</li>';
    }
    $mods = $mods.'</ul>';
    $indexpage = str_replace("_modlist_", $mods, $indexpage);
    echo($indexpage);
    $result->free();
    $conn->close();
}
else
{
    $result = $conn->query("SELECT * FROM mods WHERE ID='$ID';");
    $rows = mysqli_fetch_array($result);
    $indexpage = getTemplate("mod");
    $indexpage = str_replace("_modname_", $rows["NAME"], $indexpage);
    $indexpage = str_replace("_moddesc_", $rows["DESC"], $indexpage);
    $indexpage = str_replace("_moddownload_", $rows["DOWNLOAD"], $indexpage);
    echo($indexpage);
}