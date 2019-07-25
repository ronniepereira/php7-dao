<?php

require_once("config.php");

/*Carrega uma lista de usuarios
$lista = Usuario::getList();
echo json_encode($lista);
*/

/*Carrega lista de usuario pelo login
$search = Usuario::search("jo");
echo json_encode($search);
*/

$usuario = new Usuario();
$usuario->login("joao", "qwsdferty");
echo $usuario;
?>