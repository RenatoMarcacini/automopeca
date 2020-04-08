<?php
require_once("connection.php");
class PecaServicoDao{

    public function Listar($id){
        $support = new Support();
        $sql = "SELECT PS.IDPeca, P.Descriminacao, P.Valor, P.Tipo, PS.Valor AS SubValor FROM pecaservico AS PS INNER JOIN pecas P ON PS.IDPeca = P.ID WHERE PS.IDServico = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);

        if($stmt->execute()){
            $result = $stmt->get_result();
            $lista_peca_servico = array();
            while($peca_servico = $result->fetch_assoc()){
                array_push($lista_peca_servico, $peca_servico);
            }
            return $lista_peca_servico;
        }
        return null;
    }

    public function ListarID($id){
        $support = new Support();
        $sql = "SELECT S.ID, C.Nome, S.Carro, S.Placa, S.DataEntrada, S.DataSaida, S.Total  FROM servicos AS S INNER JOIN clientes C ON S.IDCliente = C.ID WHERE S.ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    public function ListarPorPeca($id_peca){
        $support = new Support();
        $sql = "SELECT IDServico, IDPeca, Quantidade, Valor FROM pecaservico WHERE IDPeca = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id_peca);
        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    public function Inserir(PecaServico $peca_servico){
        $support = new Support();
        $sql = "INSERT INTO pecaservico (IDPeca, IDServico, Quantidade, Valor) VALUES (?, ?, ?, ?)";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("iiid", 
            $peca_servico->id_peca,
            $peca_servico->id_servico,
            $peca_servico->quantidade,
            $peca_servico->valor
        );
        return $stmt->execute();
    }

    public function ExcluirPorServico($id){
        $support = new Support();
        $sql = "DELETE FROM pecaservico WHERE IDServico = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}

?>