<?php
require_once("connection.php");
class PecaDao{

    public function Listar(){
        $support = new Support();
        $sql = "SELECT ID, Descriminacao, Valor, Tipo FROM pecas";

        $stmt = $support->connect->prepare($sql);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $lista_peca = array();
            while($peca = $result->fetch_assoc()){
                array_push($lista_peca, $peca);
            }
            return $lista_peca;
        }
        return null;
    }

    public function ListarID($id){
        $support = new Support();
        $sql = "SELECT ID, Descriminacao, Valor, Tipo FROM pecas WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        return null;
    }

    public function Inserir(Peca $peca){
        $support = new Support();
        $sql = "INSERT INTO pecas (Descriminacao, Valor, Tipo) VALUES (?, ?, ?)";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("sds", 
            $peca->descriminacao,
            $peca->valor,
            $peca->tipo
        );
        return $stmt->execute();
    }

    public function Atualizar(Peca $peca){
        $support = new Support();
        $sql = "UPDATE pecas SET Descriminacao = ?, Valor = ?, Tipo = ? WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("sdsi", 
            $peca->descriminacao,
            $peca->valor,
            $peca->tipo,
            $peca->id
        );
        return $stmt->execute();
    }

    public function Excluir($id){
        $support = new Support();
        $sql = "DELETE FROM pecas WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}

?>