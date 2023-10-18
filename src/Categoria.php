<?php
// Namespace
namespace Microblog;
use PDO, Exception;

// Classe
class Categoria {
    private int $id;
    private string $nome;
    private PDO $conexao;
    
    // Conexão via construtor
    public function __construct(){
        $this->conexao = Banco::conecta();
    }

    // METODOS CRUD
    // Metodo de inserir (INSERT) dados de categoria
    public function inserir(): void {
        $sql = "INSERT INTO categorias(nome) VALUES (:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao inserir categoria". $erro->getMessage());
        }
    } 


    // Getters e Setters
    // ID
    public function getId():int {
        return $this->id;
    }

    public function setId(int $id):self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    // NOME
    public function getNome():string {
        return $this->nome;
    }

    public function setNome(string $nome):self {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // CONEXAO
    public function getConexao():PDO {
        return $this->conexao;
    }


    public function setConexao(PDO $conexao):self {
        $this->conexao = $conexao;
        return $this;
    }

}