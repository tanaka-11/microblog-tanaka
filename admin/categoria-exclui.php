<?php
// Require e use do namespace
use Microblog\{Categoria, ControleDeAcesso};
require_once '../vendor/autoload.php';

// Criação do objeto e executando metodo para verificação de login e verificação do tipo de usuario
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();
$sessao->verificaAcessoAdmin();

// Script de exclusão
$categoria = new Categoria;
$categoria->setId($_GET['id']);
$categoria->deletar();

// Redirecionamento
header('location:categorias.php');