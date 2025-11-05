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

        $consulta->execute();

        
    }

    // buscar (SELECT)

    public function buscar():array { /* se o método não tem parâmetro podemos usar o query */
        $sql = "SELECT * FROM usuarios ORDER BY nome";

        $consulta = $this->conexao->query($sql);
        return $consulta->fetchAll();
    }

    // buscarPorId (SELECT/WHERE)

    public function buscarPorId(int $valorId):?array {
        
        $sql = "SELECT * FROM usuarios WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);

        $consulta->bindValue(":id", $valorId);
        $consulta->execute();
        /* Sobre o  ?: conhecido como "Elvis Operator"  
        
        É uma condicional simplificada/abreviada em que, 
        se a condição/expressão for válida (ou seja, tem dados),
        ela mesma é retornada. Caso contrário, é retornado null  */
        
        return $consulta->fetch() ?: null;
    }
    }