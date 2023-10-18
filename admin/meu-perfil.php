<?php 
// Namespace e require
use Microblog\{Usuario, Utilitarios};
require_once "../inc/cabecalho-admin.php";

// Criação do objeto e atribuição do objeto ID do usuario logado
$usuario = new Usuario;
$usuario->setId($_SESSION['id']);

// Instancia
$dadosDoUsuario = $usuario->listarUm();

// Script de atualização
if(isset($_POST['atualizar'])) {
	$usuario->setNome($_POST['nome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setTipo($_SESSION['tipo']); // Utilizamos o Session pois passamos o tipo no metodo atualizar e estamos trazendo o tipo da pessoa que esta logada(da propria sessão)

	// Verificação da senha
	if(empty($_POST['senha'])) {
		$usuario->setSenha($dadosDoUsuario['senha']);
	} else {
		$usuario->setSenha(
			$usuario->verificaSenha($_POST['senha'], $dadosDoUsuario['senha'])
		);
	}

	// Chamando o metodo de atualização
	$usuario->atualizar();
	
	// Atualizando a variavel de sessão com o novo nome
 	$_SESSION['nome'] = $usuario->getNome();

	// Redirecionamento apos atualização
	header('location:index.php?perfil_atualizado');
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar meus dados
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$dadosDoUsuario['nome']?>" class="form-control" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input value="<?=$dadosDoUsuario['email']?>" class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

