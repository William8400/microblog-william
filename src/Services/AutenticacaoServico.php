<?php 
//src/Services/AutenticacaoServico.php
require_once "src/Helpers/Utils.php";


class AutenticacaoServico {
    
    public static function iniciarSessao():void {
        /* Verificando se não há uma sessão em andamento/ativa */
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // Não havendo, inicializa uma sessão
            session_start();
        }
    }

    public static function exijirLogin():void {
        // Verificando se ja tem sessão
        AutenticacaoServico::iniciarSessao();

        /* Se não existir uma variavel de sessão para o id de um usuário, 
        na prática, é porque NÃO TEM NINGUEM LOGADO.*/
        
        if (!isset($_SESSION['id'])) {
            Utils::redirecionarPara("../login.php?acesso_proibido");
        }
    }

}