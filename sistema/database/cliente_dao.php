<?php 
require_once("connection.php");
class ClienteDao
{
    public function Listar()
    {
        $support = new Support();
        $sql = "SELECT ID, Nome, Telefone, Endereco, Numero, Bairro, Cidade FROM clientes";
        $result = $support->connect->query($sql);
        $lista_cliente = array();
        while($cliente = $result->fetch_assoc()){
            array_push($lista_cliente, $cliente);
        }
        return $lista_cliente;
    }

    public function ListarID($id){
        $support = new Support();
        $sql = "SELECT ID, Nome, Telefone, Endereco, Numero, Bairro, Cidade FROM clientes WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        else{
            return false;
        }
    }

    public function Inserir(Cliente $cliente){
        $support = new Support();
        $sql = "INSERT INTO clientes (Nome, Telefone, Endereco, Numero, Bairro, Cidade) VALUES (?,?,?,?,?,?)";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("sssiss", 
            $cliente->nome,
            $cliente->telefone,
            $cliente->endereco,
            $cliente->numero,
            $cliente->bairro,
            $cliente->cidade
        );

        return $stmt->execute();
    }


    public function Atualizar(Cliente $cliente){
        $support = new Support();
        $sql = "UPDATE clientes SET Nome = ?, Telefone = ?, Endereco = ?, Numero = ?, Bairro = ?, Cidade = ? WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("sssissi", 
            $cliente->nome,
            $cliente->telefone,
            $cliente->endereco,
            $cliente->numero,
            $cliente->bairro,
            $cliente->cidade,
            $cliente->id
        );

        return $stmt->execute();
    }

    public function Excluir($id){
        $support = new Support();
        $sql = "DELETE FROM clientes WHERE ID = ?";

        $stmt = $support->connect->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
    



?>