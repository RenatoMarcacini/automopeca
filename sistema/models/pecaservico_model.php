<?php
class PecaServico{
    public $id;
    public $id_servico;
    public $id_peca;
    public $quantidade;
    public $valor;
    
    function __construct($id, $id_servico, $id_peca, $quantidade, $valor)
    {
        $this->id = $id;
        $this->id_servico = $id_servico;
        $this->id_peca = $id_peca;
        $this->quantidade = $quantidade;
        $this->valor = $valor;
    }
}


?>