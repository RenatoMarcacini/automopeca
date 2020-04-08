<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/servico_dao.php");
require("../../models/servico_model.php");
require("../../database/pecaservico_dao.php");
require("../../models/pecaservico_model.php");
?>

<div class="col-md-10">
    <?php
    if (isset($_POST["submit"])) {
        if (isset($_POST["id_servico"])) {

            $peca_servicoDao = new PecaServicoDao();
            if ($peca_servicoDao->ExcluirPorServico($_POST["id_servico"])) {
                $servicoID = intval($_POST["id_servico"]);
                $servicoDao = new ServicoDao();
                if ($servicoDao->Excluir($servicoID)) {
                    header("location:" . $site_url . "routes/servico/servico_lista.php?acao=1");
                } else {
                    header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
                }
            }
        } else {
            header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
        }
    } else {

        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {

            $servicoDao = new servicoDao();
            $servico_listado = $servicoDao->ListarID($_GET["id"]);
            if ($servico_listado == null) {
                header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
            }
        }
    }

    ?>

    <fieldset class="border p-2">
        <legend>Excluir Serviço</legend>
        <form method="post">
            <input name="id_servico" type="text" value="<?php echo $servico_listado["ID"]; ?>" readonly hidden>
            <label> <strong>ID: </strong> <?php echo $servico_listado["ID"]; ?> </label><br>
            <label> <strong>Cliente: </strong> <?php echo $servico_listado["Nome"]; ?> </label><br>
            <label> <strong>Carro: </strong> <?php echo $servico_listado["Carro"]; ?> </label><br>
            <label> <strong>Placa: </strong> <?php echo $servico_listado["Placa"]; ?> </label><br>
            <label> <strong>Data de Entrada: </strong> <?php simplificarData($servico_listado["DataEntrada"]); ?> </label><br>
            <label> <strong>Data de Saída: </strong> <?php simplificarData($servico_listado["DataSaida"]); ?> </label><br>
            <input type="submit" class="btn btn-success" name="submit" value="Excluir">
            <a href="<?php echo $site_url; ?>routes/servico/servico_lista.php" class="btn btn-danger">Voltar</a>
        </form>
    </fieldset>

</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>