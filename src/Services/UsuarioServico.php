<?php

// src/Services/UsuarioServico.php

class UsuarioServico {
    private PDO $conexao;

    /* Toda vez que criarmos um objeto baseado na classe UsuarioServico, este objeto fará uma chamada ao método de conexão na classe Conecta. */

    public function __construct()
    {
        $this->conexao = Conecta::getConexao();
    }

    /* Métodos CRUD  para Usuários */
    public function inserir(Usuario $dadosDoUsuario):void {
        $sql = "INSERT INTO usuarios(nome, email, tipo, senha) 
                VALUES(:nome, :email, :tipo, :senha)"; /* Parâmetros nomeados */ 
        
        $consulta = $this->conexao->prepare($sql);
        
        $consulta->bindValue(":nome", $dadosDoUsuario->getNome());
        
        $consulta->bindValue(":email", $dadosDoUsuario->getEmail());
        
        $consulta->bindValue(":tipo", $dadosDoUsuario->getTipo());
        
        $consulta->bindValue(":senha", $dadosDoUsuario->getSenha());
        
    }
}