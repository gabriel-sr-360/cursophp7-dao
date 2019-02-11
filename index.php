<?php 

require_once ("config.php");

/* Listar Usuario pelo ID
$usuario = new Usuario();
$usuario->loadById(1);
echo $usuario;
*/

//Carregar Lista de Usuários
//$lista = Usuario::listUsuarios();
//echo json_encode($lista);

/*Carregar Lista de Usuários buscando pelo Login
$search =  Usuario::search('ot');
echo json_encode($search);
*/

/*Autenticar Usuário
$user = new Usuario();
$login = "root";
$senha = "159753";
$user->login($login, $senha);

echo $user;*/

//Inserir Dados
//$login = "Fernando360";
//$senha = "55662522";
//$user = new Usuario($login, $senha );
//$user->inserirUsuario();
//echo $user;

//FAZENDO UPDATE
//$usuario = new Usuario();
//$usuario->loadById(7);
//$usuario->update("aluno", "845632");
//echo $usuario;

//FAZENDO UM DELETE
$usuario = new Usuario(11);
$usuario->loadById(11);
$usuario->delete();
echo $usuario;

 ?>