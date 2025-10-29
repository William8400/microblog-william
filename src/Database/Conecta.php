<?php
class Conecta {
    private static $servidor = "localhost";
    private static $banco = "microblog_william";
    private static $usuario = "root";
    private static $senha = "";
    private static $conexao = null;

    // Método estático para obter a conexão PDO
    public static function getConexao() {
        if (self::$conexao === null) {
            try {
                self::$conexao = new PDO(
                    "mysql:host=" . self::$servidor . ";dbname=" . self::$banco . ";charset=utf8",
                    self::$usuario,
                    self::$senha
                );

                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $erro) {
                die("Erro ao conectar: " . $erro->getMessage());
            }
        }
        return self::$conexao;
    }
}

Conecta::getConexao();
