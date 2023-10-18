<?php
// Namespace e requires
use Microblog\{Categoria}; 
require_once "../inc/cabecalho-admin.php";

// Objeto e verficação do tipo de usuario
$categoria = new Categoria;
$sessao->verificaAcessoAdmin();

// Chamada do metodo de exibição dos dados
$dados = $categoria->ler();
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Categorias <span class="badge bg-dark"><?=count($dados)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="categoria-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova categoria</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>

					<!-- Dados das categorias -->
					<?php foreach($dados as $categorias) {?>
					<tr>
						<td> <?=$categorias['nome']?> </td>

						<!-- Links Dinamicos -->
						<td class="text-center">
							<a class="btn btn-warning" href="categoria-atualiza.php?id=<?=$categorias['id']?>">
								<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" href="categoria-exclui.php?id=<?=$categorias['id']?>">
								<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
				<?php } ?>	

				</tbody>                
			</table>
	    </div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

