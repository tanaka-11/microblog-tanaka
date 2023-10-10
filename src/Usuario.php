<?php
// Namespace e use
namespace Microblog;
use PDO, Exception;

// Classe
class Usuario {
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private PDO $conexao;

    // Conexao
    public function __construct(){
        $this->conexao = Banco::conecta();
    }

    // METODOS CRUD

    // Metodo para inserir(INSERT) dados de usuario.
    public function inserir(): void {
        $sql = "INSERT INTO usuarios(nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir usuário". $erro->getMessage());
        }
    }

    // METODOS DE CODIFICAÇÃO/COMPARAÇÃO DA SENHA

    // Metodo para codificação
    public function codificaSenha(string $senha): string {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

   // Getters e Setters

   // ID
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    // NOME
    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): self {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // EMAIL
    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return $this;
    }

    // SENHA
    public function getSenha(): string {
        return $this->senha;
    }

    public function setSenha(string $senha): self {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // TIPO
    public function getTipo(): string {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self {
        $this->tipo = filter_var($tipo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // CONEXAO
//     public function getConexao(): PDO {
//         return $this->conexao;
//     }

//     public function setConexao(PDO $conexao): self {
//         $this->conexao = $conexao;
//         return $this;
//     }
}