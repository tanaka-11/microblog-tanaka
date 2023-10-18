<?php
// Require e use do namespace
use Microblog\{Categoria, ControleDeAcesso};
require_once '../vendor/autoload.php';

// Criação do objeto e executando metodo para verificação de login
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

// Script de exclusão
$categoria = new Categoria;
$categoria->setId($_GET['id']);
$categoria->deletar();

// Redirecionamento
header('location:categorias.php');