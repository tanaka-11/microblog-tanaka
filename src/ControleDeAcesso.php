<?php
// Namespace
namespace Microblog;

// Classe
final class ControleDeAcesso {
    // Metodo para iniciar a sessão com o array superglobal($_SESSION) via construtor.
    public function __construct(){
        // Se não existir uma sessão em funcionamento ele vai se iniciar com o comando (session_start)
        if(!isset($_SESSION)){
            session_start();
        }
    }

    // Metodo para verificação de acesso
    public function verificaAcesso():void {
        // Se  não existir uma variavel de sessão chamada "id", ou seja, não logado então termine a sessão e retorne para o login
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header('location:../login.php?acesso_proibido');
            die(); // ou o comando exit();
        }
    }

    // Metodo para verificação de acesso ADMIN
    public function verificaAcessoAdmin(): void {
        // Verificando se o tipo logado NÃO é admin com o comando (!==)
        if($_SESSION['tipo'] !== 'admin' ){
            header('location:nao-autorizado.php');
            die();
        }
    }

    // Metodo com sessao($_SESSION) para o acesso de usuarios 
    public function login(int $id, string $nome, string $tipo): void {
        // Criamos variaveis de sessão no momento de login contendo os dados do usuario para o controle.
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;
    }

    // Metodo de saida dos usuarios
    public function logout(): void {
        session_start();
        session_destroy();
        header('location:../login.php?logout');
        exit();
    }


}
