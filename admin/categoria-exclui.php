<?php
// Require e use do namespace
use Microblog\{ControleDeAcesso};
require_once '../vendor/autoload.php';

// Criação do objeto e executando metodo para verificação de login
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

// Redirecionamento
header('location:usuarios.php');