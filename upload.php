<?php
include "features.php";
//this code SUCKS
// rewrite plz!
if(isset($_POST["name"]))$modname = htmlspecialchars($_POST["name"]);
if(isset($_POST["desc"]))$moddesc = htmlspecialchars($_POST["desc"]);

if(isset($_FILES['mod']) && isset($modname) && isset($moddesc)){
    $errors= array();
    $file_name = $_FILES['mod']['name'];
    $file_size =$_FILES['mod']['size'];
    $file_tmp =$_FILES['mod']['tmp_name'];
    $file_type=$_FILES['mod']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    $extensions= array("jpeg","jpg","png", "webm", "gif", "zip", "tar.gz", "rar");

    if(in_array($file_ext,$extensions)=== false){
        $error="extension not allowed, please choose a JPEG or PNG file.\n";
    }

    if($file_size > 200000){
        $error="File size must not be above 2MB \n";
    }
    
    if(empty($error)==true && $file_ext != ""){
        $moddownload = random_string(16);
        $fullmod = $moddownload.".".$file_ext;
        move_uploaded_file($file_tmp,"uploads/".$moddownload.".".$file_ext);
        echo "File uploaded!\n";
        $conn->query("INSERT INTO `mods` (`NAME`, `DESC`, `DOWNLOAD`, `ID`) VALUES ('$modname', '$moddesc', '$fullmod', NULL)");
    }elseif(empty($error)==false){
        print($error);
    }
}
else 
{
    echo(getTemplate("upload"));
}