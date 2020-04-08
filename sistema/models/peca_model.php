<?php
class Peca{
    public $id;
    public $descriminacao;
    public $valor;
    public $tipo;
    
    function __construct($id, $descriminacao, $valor, $tipo)
    {
        $this->id = $id;
        $this->descriminacao = $descriminacao;
        $this->valor = $valor;
        $this->tipo = $tipo;
    }
}


?>