<?php
// Namespace
namespace Microblog;
use PDO, Exception;

// Classe
class Categoria {
    private int $id;
    private string $nome;

    // Conexão via construtor


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
}