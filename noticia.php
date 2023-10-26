<?php
require_once "inc/cabecalho.php";

// Script para exibição de uma noticia
$noticia->setId($_GET['id']);
$dados = $noticia->listarDetalhes();

?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2><?=$dados['titulo']?></h2>
        <p class="font-weight-light">
            <time><?=$dados['data']?></time> - <span><?=$dados['autor']?></span>
        </p>
        <img src="imagens/<?=$dados['imagem']?>" alt="" class="float-left pr-2 img-fluid">
        <p><?=$dados['texto']?></p>
    </article>
    

</div>        
                  

<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

