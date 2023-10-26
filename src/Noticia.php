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

    // Listar (SELECT)
    public function listar(): array {
        // Condicional para saber se o usuario logado é um admin.
        if($this->usuario->getTipo() === 'admin'){
        // SQL do Admin
            $sql = "SELECT noticias.id, noticias.titulo, noticias.data, usuarios.nome AS autor, noticias.destaque
            FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id ORDER BY data DESC";
        } else {
        // SQL do Editor
            $sql = "SELECT id, titulo, data, destaque FROM noticias WHERE usuario_id = :usuario_id ORDER BY data DESC";
        }

        try {
            $consulta = $this->conexao->prepare($sql);

            // Condicional para tratamento de usuario que não for Admin
            if($this->usuario->getTipo() !== 'admin'){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }

            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir ". $erro->getMessage());
        }
        
        return $resultado;
        
    }

    // Listar UM
    public function listarUm(): array {
        if ($this->usuario->getTipo() === 'admin') {
            // Sql do Admin
            $sql = "SELECT * FROM noticias WHERE id = :id"; 
        } else {
            // Sql do Editor
            $sql = "SELECT * FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id ,PDO::PARAM_INT);
            // Condicional Não Admin
            if($this->usuario->getTipo() !== 'admin'){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }

            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $erro) {
            die("Erro ao exibir dado". $erro->getMessage());
        }

        return $resultado;
    }

    // Atualizar (UPDATE)
    public function atualizar(): void {
        if ($this->usuario->getTipo() === 'admin') {
            // Sql do Admin
            $sql = "UPDATE noticias SET titulo = :titulo, texto = :texto, resumo = :resumo, imagem = :imagem, categoria_id = :categoria_id, destaque = :destaque WHERE id = :id"; 
        } else {
            // Sql do Editor
            $sql = "UPDATE noticias SET titulo = :titulo, texto = :texto, resumo = :resumo, imagem = :imagem, categoria_id = :categoria_id, destaque = :destaque WHERE id = :id AND usuario_id = :usuario_id";
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);

          if($this->usuario->getTipo() !== 'admin'){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }

            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar". $erro->getMessage());
        }
        
    }

    // Excluir (DELETE)
    public function excluir(): void {
        if ($this->usuario->getTipo() === 'admin') {
            // Sql do Admin
            $sql = "DELETE FROM noticias WHERE id = :id"; 
        } else {
            // Sql do Editor
            $sql = "DELETE FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            if($this->usuario->getTipo() !== 'admin'){
                $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            }
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao deletar". $erro->getMessage());
        }
    }
    // FINAL METODOS CRUD


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

    // METODOS DA ÁREA PUBLICA

    // listarDestaque (SELECT)
    public function listarDestaque(): array {
        $sql = "SELECT id, titulo, resumo, imagem FROM noticias WHERE destaque = :destaque ORDER BY data DESC";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir". $erro->getMessage());
        }
        return $resultado;
    }

    // listarTodas (SELECT)
    public function listarTodas(): array {
        $sql = "SELECT id, data, titulo, resumo FROM noticias ORDER BY data DESC";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir". $erro->getMessage());
        }
        return $resultado;
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