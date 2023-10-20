<?php
// Namespace
namespace Microblog;
use PDO, Exception;

// Classe
final class Categoria {
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
    
    // Metodo de exibição(SELECT) das categorias
    public function ler(): array {
        $sql = "SELECT * FROM categorias ORDER BY id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir dados das categorias". $erro->getMessage());
        }
        return $resultado;
    }

    // Metodo de exibição de UMA categoria
    public function lerUm(): array {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir dados de uma categorias". $erro->getMessage());
        }
        return $resultado;
    }

    // Metodo de atualização(UPDATE) das categorias
    public function atualizar(): void {
        $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar dados de uma categoria". $erro->getMessage());
        }
    }

    // Metodo de exclusão (DELETE) dos dados de uma categoria
    public function deletar(): void {
        $sql = "DELETE FROM categorias WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        }  catch (Exception $erro) {
            die("Erro ao excluir: ".$erro->getMessage());
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