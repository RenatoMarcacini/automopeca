<?php
require_once("connection.php");
class ServicoDao
{

    public function Listar()
    {
        $support = new Support();
        $sql = "SELECT S.ID, C.Nome, S.Carro, S.Placa, S.DataEntrada, S.DataSaida, S.Total  FROM servicos AS S INNER JOIN clientes C ON S.IDCliente = C.ID";

        $stmt = $support->connect->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $lista_peca = array();
            while ($peca = $result->fetch_assoc()) {
                array_push($lista_peca, $peca);
            }
            return $lista_peca;
        }
        return null;
    }

    public function ListarPorCliente($id_cliente)
    {
        $support = new Support();
        $sql = "SELECT ID FROM servicos WHERE IDCliente = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    public function ListarID($id)
    {
        $support = new Support();
        $sql = "SELECT S.ID, S.IDCliente, C.Nome, S.Carro, S.Placa, S.DataEntrada, S.DataSaida, S.Total  FROM servicos AS S INNER JOIN clientes C ON S.IDCliente = C.ID WHERE S.ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

   

    public function Inserir(Servico $servico)
    {
        $support = new Support();
        $sql = "INSERT INTO servicos (IDCliente, Carro, Placa, DataEntrada, DataSaida, Total) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param(
            "issssd",
            $servico->idCliente,
            $servico->carro,
            $servico->placa,
            $servico->dataEntrada,
            $servico->dataSaida,
            $servico->total
        );
        return $stmt->execute();
    }

    public function UltimoIDServico()
    {
        $support = new Support();
        $sql = "SELECT (AUTO_INCREMENT-1) AS UltimoID FROM   information_schema.tables WHERE  table_name = 'servicos' AND    table_schema = 'automopeca_servico'";

        $stmt = $support->connect->prepare($sql);
            if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    public function Atualizar(Servico $servico)
    {
        $support = new Support();
        $sql = "UPDATE servicos SET IDCliente = ?, Carro = ?, Placa = ?, DataEntrada = ?, DataSaida = ?, Total = ? WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param(
            "issssdi",
            $servico->idCliente,
            $servico->carro,
            $servico->placa,
            $servico->dataEntrada,
            $servico->dataSaida,
            $servico->total,
            $servico->id
        );
        return $stmt->execute();
    }

    public function Excluir($id)
    {
        $support = new Support();
        $sql = "DELETE FROM servicos WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
