<?php
error_reporting(0);
session_start();
if($_SESSION) {
    if(isset($_SESSION["lang"]) AND $_SESSION["lang"] != "") {
        $lang = $_SESSION["lang"];
    } else {
        $lang = "en";
    }
} else {
    $lang = "en";
}

switch($lang) {
case "es":
    if(is_file(include("dictionary/es.php"))) {
        include("dictionary/es.php");
    } else {
        include("../dictionary/es.php");
    }
    break;
default:
    if(is_file(include("dictionary/en.php"))) {
        include("dictionary/en.php");
    } else {
        include("../dictionary/en.php");
    }
}

?>
