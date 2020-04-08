<?php
class Servico{
    public $id;
    public $idCliente;
    public $carro;
    public $placa;
    public $dataEntrada;
    public $dataSaida;
    public $total;
    
    function __construct($id, $idCliente, $carro, $placa, $dataEntrada, $dataSaida, $total)
    {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->carro = $carro;
        $this->placa = $placa;
        $this->dataEntrada = $dataEntrada;
        $this->dataSaida = $dataSaida;
        $this->total = $total;
    }
}


?>