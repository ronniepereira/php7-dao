<?php

require_once("config.php");

//Carrega uma lista de usuarios
/*
$lista = Usuario::getList();
echo json_encode($lista);
*/

//Carrega lista de usuario pelo login
/*
$search = Usuario::search("jo");
echo json_encode($search);
*/

//Usuario fazendo login e retornando dados
/*
$usuario = new Usuario();
$usuario->login("joao", "qwsdferty");
echo $usuario;
*/


//Criando um novo usuario
/*
$aluno = new Usuario("Aluno","@lun0");
echo $aluno;
*/

//Alterando dados de login do usuario
/*
$usuario = new Usuario();
$usuario->loadById(5);
$usuario->update("professor", "!@#$%");
*/

$usuario = new Usuario();
$usuario->loadById(6);
$usuario->delete();

echo $usuario;
?>