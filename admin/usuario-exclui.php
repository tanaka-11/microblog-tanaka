<?php
// Require e use do namespace
use Microblog\{Usuario, ControleDeAcesso};
require_once '../vendor/autoload.php';

// Criação do objeto e executando metodo para verificação de login
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

// Verificação do tipo de usuario
$sessao->verificaAcessoAdmin();

// Script de exclusão
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->deletar();

// Redirecionamento
header('location:usuarios.php');