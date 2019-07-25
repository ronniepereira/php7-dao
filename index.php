<?php

require_once("config.php");

$root = new Usuario();
$root->loadbyId(2);

echo $root;
?>