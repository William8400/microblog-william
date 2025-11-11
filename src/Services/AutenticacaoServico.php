<?php 
//src/Services/AutenticacaoServico
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

    public static function login(int $valorId, string $valorNome, string $valorTipo ):void {
        AutenticacaoServico::iniciarSessao();

        // Criando as variáveis de sessão com os dados informados

        $_SESSION['id'] = $valorId;

        $_SESSION['nome'] = $valorNome;

        $_SESSION['tipo'] = $valorTipo;

        // Após logar, vá para admin/index.php
        Utils::redirecionarPara("admin/");
    }

}