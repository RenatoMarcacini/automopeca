<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/cliente_dao.php");

?>

<div class="col-md-10">

    <?php 
        if(isset($_GET["acao"])){
            if($_GET["acao"] == 1){
                echo '<div class="alert alert-success" role="alert">Operação concluida com sucesso!</div>';
            }
            else if($_GET["acao"] == 0){
                echo '<div class="alert alert-danger" role="alert">Erro ao concluir operação, tente novamente ou entre em contato com suporte!</div>';
            }
        }
    ?>

    <fieldset class="border p-2">
        <legend>Lista de Clientes</legend>
        <a href="<?php echo $site_url; ?>routes/cliente/cliente_inserir.php" style="margin-bottom: 5px;" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Cliente</a>
        <table id="tabela" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tel/Cel</th>
                    <th>Endereço</th>
                    <th>Número</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
    
                $clienteDao = new ClienteDao();
                $lista_cliente = $clienteDao->Listar();
               
                for ($i=0; $i < count($lista_cliente); $i++) { 
    
                    echo '<tr>';
                    echo '  <td>' . $lista_cliente[$i]['ID'] . '</td>';
                    echo '  <td>' . $lista_cliente[$i]['Nome'] . '</td>';
                    echo '  <td>' . $lista_cliente[$i]['Telefone'] . '</td>';
                    echo '  <td>' . $lista_cliente[$i]['Endereco'] . '</td>';
                    echo '  <td>' . $lista_cliente[$i]['Numero'] . '</td>';
                    echo '  <td>' . $lista_cliente[$i]['Bairro'] . '</td>';
                    echo '  <td>' . $lista_cliente[$i]['Cidade'] . '</td>';
                    echo '<td>                     
                            <a class="btn btn-info" href="'. $site_url . "routes/cliente/cliente_editar.php/?id=" . $lista_cliente[$i]['ID'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="cliente_excluir.php?id=' . $lista_cliente[$i]['ID'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>';
                }
                ?>
            </tbody>
        </table>
    </fieldset>
</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>

