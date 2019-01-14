<?php 
include "header.php"; 
include_once "db.php";

$selectOption = $_GET["order"];
$Search = $_GET["Search"];
header('Location: results.php?order='.$selectOption.'&search='.$Search.'');
echo $selectOption;