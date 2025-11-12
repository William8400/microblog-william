<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";
require_once "../src/Services/AutenticacaoServico.php";

AutenticacaoServico::exijirLogin();
AutenticacaoServico::exigirAdmin();

$id = Utils::sanitizar($_GET["id"], 'inteiro');

if (!$id) Utils::redirecionarPara('usuarios.php');

$erro = null;

$usuarioServico = new UsuarioServico();
$dadosDoUsuario = [];

// Tente....
try {
	$dadosDoUsuario = $usuarioServico->buscarPorId($id);
	// Executar o método de excluir passando o id de quem será excluído
	$usuarioServico->excluirUsuario($id);

	// Utils::redirecionarPara('usuarios.php');

} catch (Throwable $e) {
	// Deu ruim/erro? Dispare um erro e monte uma mensagem com os detalhes
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
			<p class="alert alert-success text-center"> O usuário <?= $dadosDoUsuario['nome'] ?> foi excluido com sucesso! <?= $erro ?> </p>
		<?php endif; ?>

		<div class="text-center">
			<a href="usuarios.php" class="btn btn-secondary">Voltar</a>
		</div>

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>