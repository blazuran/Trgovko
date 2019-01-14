<?php 
include "header.php"; 
include_once "db.php";

$selectOption = $_GET["order"];
$Search = $_GET["search"];
header('Location: results.php?order='.$selectOption.'&Search='.$Search.'');
echo $selectOption;