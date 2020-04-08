<?php
    class Cliente{
        public $id;
        public $nome;
        public $telefone;
        public $endereco;
        public $numero;
        public $bairro;
        public $cidade;
        
        function __construct($id, $nome, $telefone, $endereco, $numero, $bairro, $cidade)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
            $this->numero = $numero;
            $this->bairro = $bairro;
            $this->cidade = $cidade;
        }
    }

?>