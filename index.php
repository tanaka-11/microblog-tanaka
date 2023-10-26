<?php
use Microblog\{Utilitarios};
require_once "inc/cabecalho.php";

// Filtrando noticias pelo destaque, listando eles e os guardando numa variavel
$noticia->setDestaque("sim"); 
$destaques = $noticia->listarDestaque();
$todas = $noticia->listarTodas();
// Utilitarios::dump($todas);
?>


<div class="row my-1 mx-md-n1">
    <?php foreach($destaques as $umDestaque){ ?>
        <!-- INÍCIO Card -->
		<div class="col-md-6 my-1 px-md-1">
            <article class="card shadow-sm h-100">
                <a href="noticia.php?id=<?=$umDestaque['id']?>" class="card-link">

                    <img src="imagens/<?=$umDestaque['imagem']?>" class="card-img-top" alt="...">

                    <div class="card-body">
                        <h3 class="fs-4 card-title"><?=$umDestaque['titulo']?></h3>
                        <p class="card-text"><?=$umDestaque['resumo']?></p>
                    </div>
                </a>
            </article>
		</div>
		<!-- FIM Card -->
    <?php } ?>
</div>        
        
            


<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

