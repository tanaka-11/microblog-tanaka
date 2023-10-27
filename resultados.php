<?php
use Microblog\{Utilitarios, Noticia};
require_once "vendor/autoload.php";
$noticia = new Noticia;

$noticia->setTermo($_POST['busca']);
$resultados = $noticia->buscar();
$quantidade = count($resultados);

// 
if($quantidade > 0){
?>
    <h2 class="fs-5">Resultados: <span><?=$quantidade?></span></h2>
    <div class="list-group">
        <?php foreach($resultados as $itemNoticia){ ?>
            <a class="list-group-item list-group-item-action" href="noticia.php?id=<?=$itemNoticia['id']?>">
                <?=$itemNoticia['titulo']?>
            </a>
        <?php } ?>
    </div>
<?php
} else {
?>
    <h2 class="fs-5 text-danger">Sem notícias</h2>
<?php } ?>    

