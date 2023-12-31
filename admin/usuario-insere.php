<?php
// Require do cabeçalho ja com o autoload e use. 
use Microblog\Usuario;
require_once "../inc/cabecalho-admin.php";

// Verificação do tipo de usuario
$sessao->verificaAcessoAdmin();


if(isset($_POST['inserir'])){
	// Criação do objeto
	$usuario = new Usuario;

	// Dados do objeto
	$usuario->setNome($_POST['nome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setTipo($_POST['tipo']);

	// Passando o metodo de codificação para o setSenha
	$usuario->setSenha($usuario->codificaSenha($_POST['senha']));

	// Chamando metodo
	$usuario->inserir();

	// Redirecionamento
	header('location:usuarios.php');
}

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Inserir novo usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option value="editor">Editor</option>
					<option value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

