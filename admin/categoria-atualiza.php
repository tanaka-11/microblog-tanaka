<?php 
// Namespace e requires
use Microblog\{Categoria};
require_once "../inc/cabecalho-admin.php";

// Verificação do tipo de usuario
$sessao->verificaAcessoAdmin();

// Script de exibição
$categoria = new Categoria;
$categoria->setId($_GET['id']);
$dados = $categoria->lerUm();

// Script de atualização
if(isset($_POST['atualizar'])) {
	$categoria->setNome($_POST['nome']);
	$categoria->atualizar();
	header('location:categorias.php');
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados da categoria
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$dados['nome']?>" class="form-control" type="text" id="nome" name="nome" required>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

