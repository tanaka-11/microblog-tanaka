<?php
// Require e use do namespace
use Microblog\{ControleDeAcesso, Noticia};
require_once '../vendor/autoload.php';

// Criação do objeto e executando metodo para verificação de login
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

// Script de exclusão de dados
$noticia = new Noticia;
$noticia->setId($_GET['id']);
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$noticia->excluir();

// Redirecionamento
header('location:noticias.php');