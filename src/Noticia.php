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
    public function inserir(): void {
        $sql = "INSERT INTO noticias(
            titulo, texto, resumo, imagem, destaque, usuario_id, categoria_id
        ) VALUES (
            :titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);
            
            // Atribuindo valores com a associação entre Classes 
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir". $erro->getMessage());
        }
        
    }
    
    // Metodo de UPLOAD de foto
    public function upload(array $arquivo): void {
        // Validação dos tipos
        $tiposValidos = ["image/png", "image/jpeg", "image/gif", "image/svg+xml"];

        // Verificação dos tipos (Utilizamos o !in_array para saber se não é um tipo valido)
        if(!in_array($arquivo['type'], $tiposValidos)){
            die("
                <script>
                    alert('Formato inválido');
                    history.back();
                </script>
                ");
        }

        // Acessando apenas o nome do arquivo
        $nome = $arquivo['name'];

        // Acessando os dados de armazenamento temporários
        $temporario = $arquivo['tmp_name'];

        // Definindo a pasta de destino da imagem
        $pastaFinal = '../imagens/'.$nome;

        // Enviando da area temporaria para a pasta de destino
        move_uploaded_file($temporario, $pastaFinal);
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