<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Models/Noticia.php";
require_once "../src/Services/NoticiaServico.php";
require_once "../src/Helpers/Utils.php";
require_once "../src/Services/AutenticacaoServico.php";
AutenticacaoServico::exijirLogin();

$erro = null;

$noticiaServico = new NoticiaServico();

$id = Utils::sanitizar($_GET['id'], 'inteiro');

if(!$id) Utils::redirecionarPara("noticias.php");

try {
	$noticiaServico->excluir($id, $_SESSION['id'], $_SESSION['tipo']);
} catch (Throwable $e) {
	$erro = "Erro ao excluir noticia. <br>".$e->getMessage();
}


require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir notícia
		</h2>

			

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>