<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/servico_dao.php");
?>

<div class="col-md-10">

    <?php
    if (isset($_GET["acao"])) {
        if ($_GET["acao"] == 1) {
            echo '<div class="alert alert-success" role="alert">Operação concluida com sucesso!</div>';
        } else if ($_GET["acao"] == 0) {
            echo '<div class="alert alert-danger" role="alert">Erro ao concluir operação, tente novamente ou entre em contato com suporte!</div>';
        }
    }
    ?>

    <fieldset class="border p-2">
        <legend>Lista De Serviços</legend>
        <a href="<?php echo $site_url; ?>routes/servico/servico_inserir.php" style="margin-bottom: 5px;" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Serviço</a>
    
        <table id="tabela" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Carro</th>
                    <th>Placa</th>
                    <th>Entrada</th>
                    <th>Saída</th>
                    <th>Total</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
    
                $servicoDao = new ServicoDao();
                $lista_servico = $servicoDao->Listar();
                if(isset($lista_servico)){
                    for ($i = 0; $i < count($lista_servico); $i++) {
        
                        echo '<tr>';
                        echo '  <td>' . $lista_servico[$i]['ID'] . '</td>';
                        echo '  <td>' . $lista_servico[$i]['Nome'] . '</td>';
                        echo '  <td>' . $lista_servico[$i]['Carro'] . '</td>';
                        echo '  <td>' . $lista_servico[$i]['Placa'] . '</td>';
                        echo '  <td>' . $lista_servico[$i]['DataEntrada'] . '</td>';
    
                        if(!isset($lista_servico[$i]['DataSaida'])){
                            echo "<td>PENDENTE</td>";
                        }
                        else{
                            echo '  <td>' . $lista_servico[$i]['DataSaida'] . '</td>';
                        }
                        echo '  <td>' . $lista_servico[$i]['Total'] . '</td>';                    
                        echo '<td>                     
                            <a class="btn btn-info" href="' . $site_url . "routes/servico/servico_editar.php/?id=" . $lista_servico[$i]['ID'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="servico_excluir.php?id=' . $lista_servico[$i]['ID'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a class="btn btn-warning" href="servico_detalhe.php?id=' . $lista_servico[$i]['ID'] . '"><i class="fa fa-file" aria-hidden="true"></i></a>
                        </td></tr>';
                    }
                }
                ?>
    
            </tbody>
        </table>
    </fieldset>

</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>
