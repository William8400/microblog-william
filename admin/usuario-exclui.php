<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Models/Usuario.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";

$id = Utils::sanitizar($_GET["id"], 'inteiro');

if (!$id) Utils::redirecionarPara('usuarios.php');

$erro = null;

$usuarioServico = new UsuarioServico();


	try {
		
		$usuarioServico->excluirUsuario($id);

	 // Utils::redirecionarPara('usuarios.php');

	} catch (Throwable $e) {
		$erro = "Erro ao excluir usuário. <br>" . $e->getMessage();
	}


require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir usuário
		</h2>

		<?php if ($erro): ?>
			<p class="alert alert-danger text-center"> <?= $erro ?> </p>
		<?php else: ?>
		  <p class="alert alert-success text-center">Excluido com sucesso!<?=$erro?> </p>
		<?php endif; ?>

		<div class="text-center">
			<a href="usuarios.php" class="btn btn-secondary">Voltar</a>
		</div>

</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>