<?php
// src/helpers/Utils.php

class Utils {

    /* Usamos Mixed para sinalizar que o método aceita/retorna tipos de dados variados (string, int, array, float etc) */

    // Quando coloca static você não precisa fazer um objeto você pode usar direto
    public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'):mixed {
        switch($tipoDeSanitizacao){
            
            case 'inteiro':
                return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);

            case 'email':
                /* o trim remove os espaços digitados no formulário */
                return trim(filter_var($valor, FILTER_SANITIZE_EMAIL)); 
            
            default:   
                return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }

    public static function codificarSenha(string $valorSenha):string{
        return password_hash($valorSenha, PASSWORD_DEFAULT);
    }

    public static function dump(mixed $dados):void{
        echo '<pre>';
        var_dump($dados);
        echo '</pre>';
    }

}