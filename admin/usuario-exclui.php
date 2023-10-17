<?php
// Require e use do namespace
use Microblog\{Usuario, ControleDeAcesso};
require_once '../vendor/autoload.php';

// Script de exclusão
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->deletar();

// Criação do objeto e executando metodo para verificação de login
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

// Redirecionamento
header('location:usuarios.php');