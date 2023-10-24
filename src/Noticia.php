<?php
// Namespace
namespace Microblog;
use PDO, Exception;

// Classe
final class Noticia {
    // Propriedades comuns
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private string $termo;
    private PDO $conexao;

    // Fazendo asociação das propriedades com as outras classes já existentes(Categoria, Usuario) permitindo utilizar seus recursos a partir de outra classe(Noticia)
    public Usuario $usuario;
    public Categoria $categoria;    

    // Conexao, istancias do Usuario e Categoria via metodo construtor
    public function __construct(){
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;
        $this->conexao = Banco::conecta();
    }

    // Metodos CRUD
    // Inserir (INSERT)
    // public function inserir(): void {
    //     $sql = "INSERT INTO noticias 
    //     (data, titulo, texto, resumo, imagem, destaque, termo)
    //     VALUES 
    //     (:data, :titulo, :texto, :resumo, :imagem, :destaque, :termo)";

    //     try {
    //         $consulta = $this->conexao->prepare($sql);
    //         $consulta->bindValue(":data", $this->data, PDO::PARAM_STR);
    //     } catch (Exception $erro) {
    //         die("Erro ao inserir". $erro->getMessage());
    //     }
        
    // }

    // Getters e Setters
    // ID
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    // DATA
    public function getData(): string {
        return $this->data;
    }

    public function setData(string $data): self {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // TITULO
    public function getTitulo(): string {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }
    
    // TEXTO    
    public function getTexto(): string {
        return $this->texto;
    }

    public function setTexto(string $texto): self {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // RESUMO
    public function getResumo(): string {
        return $this->resumo;
    }

    public function setResumo(string $resumo): self {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // IMAGEM
    public function getImagem(): string {
        return $this->imagem;
    }

    public function setImagem(string $imagem): self {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // DESTAQUE
    public function getDestaque(): string {
        return $this->destaque;
    }

    public function setDestaque(string $destaque): self {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // TERMO
    public function getTermo(): string {
        return $this->termo;
    }

    public function setTermo(string $termo): self {
        $this->termo = filter_var($termo, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }

    // CONEXAO
    // public function getConexao(): PDO {
    //     return $this->conexao;
    // }

  
    // public function setConexao(PDO $conexao): self {
    //     $this->conexao = $conexao;
    //     return $this;
    // }
}