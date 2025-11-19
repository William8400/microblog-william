<?php
// src/helpers/Utils.php

class Utils
{

    /* Usamos Mixed para sinalizar que o método aceita/retorna tipos de dados variados (string, int, array, float etc) */

    // Quando coloca static você não precisa fazer um objeto você pode usar direto
    public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'): mixed
    {
        switch ($tipoDeSanitizacao) {

            case 'inteiro':
                return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);

            case 'email':
                /* o trim remove os espaços digitados no formulário */
                return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));

            default:
                return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }

    public static function codificarSenha(string $valorSenha): string
    {
        return password_hash($valorSenha, PASSWORD_DEFAULT);
    }

    /* Ao chamar o método verificarSEnha, passamos pra ele 
    a senha digitada no formulário e a senha existente no banco 
    */
    public static function verificarSenha(string $senhaDigitadaFormulario, string $senhaArmazenadaNoBanco): string
    {
        /* usamos o password_verify para COMPRAR as duas senhas */
        if (password_verify($senhaDigitadaFormulario, $senhaArmazenadaNoBanco)) {
            // São iguais? Então retorne a mesma já existente no banco
            return $senhaArmazenadaNoBanco;
        } else {
            // São diferentes? Então pega a senha digitada e faça um novo hash
            return Utils::codificarSenha($senhaDigitadaFormulario);
            // self::codificarSenha também funciona
        }
    }

    public static function dump(mixed $dados): void
    {
        echo '<pre>';
        var_dump($dados);
        echo '</pre>';
    }

    public static function redirecionarPara(string $pagina): void
    {

        header("location:" . $pagina);
        exit;
    }

    public static function formatardata(string $valorData): string
    {
        return date("d/m/Y H:i", strtotime($valorData));
    }

    public static function upload(?array $arquivo): void
    {

        /* Validação inicial, verificando se: 
        - não tem arquivo
        - não existe alguma referência na área temporária
        - não for um arquivo que possa/permita envio/upload    
        */
        if (
            !$arquivo ||
            !isset($arquivo["tmp_name"]) ||
            !is_uploaded_file($arquivo["tmp_name"])
        ) {
            throw new Exception("Nenhum arquivo válido foi enviado.");
        }

        // Definindo uma pasta no servidor/site para receber a imagem enviada 
        $pastaDeDestino = "../images/";

        // Validação dos formatos de imagem
        $formatosPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];

        // definindo um tamanho máximo pra imagem
        $tamanhoMaximo = 2 * 1024 * 1024; // 2MB


        // Detectando o formato REAL do arquivo
        $formatoDoArquivoEnviado = mime_content_type($arquivo["tmp_name"]);

        // Se o formato NÃO ESTIVER na lista de formatos permitidos 
        if (!in_array($formatoDoArquivoEnviado, $formatosPermitidos)) {
            throw new Exception("Apenas arquivos JPG, PNG, GIF e SVG são permitidos.");
        }

        // Se o tamanho do arquivo for acima do máximo 
        if ($arquivo["size"] > $tamanhoMaximo) {
            throw new Exception("O arquivo é muito grande. Tamanho máximo: 2MB.");
        }

        // Montando o nome/caminho do arquivo que será guardado na pasta imagens
        $nomeDoArquivo = $pastaDeDestino . basename($arquivo["name"]);

        // Se não CONSEGUIR executar a função move_uploaded_file, lançar uma exceção
        if (!move_uploaded_file($arquivo["tmp_name"], $nomeDoArquivo)) {
            throw new Exception("Erro ao mover o arquivo. Código de erro: " . $arquivo["error"]);
        }
    }
}
