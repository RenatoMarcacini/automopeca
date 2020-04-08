<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/peca_dao.php");

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
        <legend>Lista de Peças</legend>
        <a href="<?php echo $site_url; ?>routes/peca/peca_inserir.php" style="margin-bottom: 5px;" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Peça</a>
        <table id="tabela" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Discriminacao</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $pecaDao = new PecaDao();
                $lista_peca = $pecaDao->Listar();
                if (isset($lista_peca)) {
                    for ($i = 0; $i < count($lista_peca); $i++) {

                        echo '<tr>';
                        echo '  <td>' . $lista_peca[$i]['ID'] . '</td>';
                        echo '  <td>' . $lista_peca[$i]['Descriminacao'] . '</td>';
                        echo '  <td>' . $lista_peca[$i]['Valor'] . '</td>';
                        echo '  <td>' . $lista_peca[$i]['Tipo'] . '</td>';
                        echo '<td>                     
                            <a class="btn btn-info" href="' . $site_url . "routes/peca/peca_editar.php/?id=" . $lista_peca[$i]['ID'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="btn btn-danger" href="peca_excluir.php?id=' . $lista_peca[$i]['ID'] . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
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