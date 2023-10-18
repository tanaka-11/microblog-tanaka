<?php 
// Namespace e require
use Microblog\{Usuario, ControleDeAcesso, Utilitarios};
require_once "inc/cabecalho.php";


// Script das mensagens de feedback sobre login/logout dos usuarios
if (isset ($_GET['campos_obrigatorios']) ) {
	$feedback = "Preencha e-mail e senha";

} elseif (isset ($_GET['dados_incorretos']) ) {
	$feedback = "Preencha novamente";

} elseif (isset ($_GET['logout']) ) {
	$feedback = "Você saiu do sistema";

} elseif (isset ($_GET['acesso_proibido'])){
	$feedback = "Faça o login";
}

?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

				<!-- Mensagem Feedback -->
                <?php if(isset($feedback)) {?>
					<p class="my-2 alert alert-warning text-center"><?=$feedback?></p>
				<?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>

				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>

			<!-- SCRIPT DE VERIFICAÇÃO DOS DADOS -->
			<?php
				if(isset($_POST['entrar'])) {
					// Verificando se os campos 'email' e 'senha' estão vazios
					if (empty($_POST['email']) || empty($_POST['senha'])) {
						// Passando o parametro 'campos_obrigatorios' na url
						header('location:login.php?campos_obrigatorios');
					} else {
						// Capturando os dados
						$usuario = new Usuario;
						$usuario->setEmail($_POST['email']);

						// Buscando os dados
						$dados = $usuario->buscar();

						// Se não houver usuario encontrado // OU if ($dados === false)
						if(!$dados)	{
							// Passando o parametro 'dados_incorretos' na url
							header('location:login.php?dados_incorretos');
						} else {
							// Usuario encontrado
							// Verficação de senha e processo de Login com variaveis de sessão 
							if (password_verify($_POST['senha'], $dados['senha'])){
								$sessao = new ControleDeAcesso;
								$sessao->login($dados['id'], $dados['nome'], $dados['tipo']);
								header('location:admin/index.php');
							} else {
								header('location:login.php?dados_incorretos');
							}
						}

					}
				}
			?>

    </div>
    
    
</div>        
        
        
    



<?php 
require_once "inc/rodape.php";
?>

