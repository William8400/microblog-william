<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Models/Usuario.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";

$id = Utils::sanitizar($_GET["id"], 'inteiro');

if (!$id) Utils::redirecionarPara('usuarios.php');

$usuarioServico = new UsuarioServico();

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	try {
		$id = Utils::sanitizar($_POST['id'], 'int');

		$excluirUsuario = new Usuario($nome, $email, $senha, $tipo, $id);

		$usuario->getId($id);

		$usuarioServico->excluirUsuario($usuario);

		Utils::redirecionarPara('usuarios.php');
	} catch (Throwable $e) {
		$erro = "Erro ao excluir usuário. <br>" . $e->getMessage();
	}
}



require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir usuário
		</h2>



	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>