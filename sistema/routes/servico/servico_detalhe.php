<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/servico_dao.php");
require("../../models/servico_model.php");
require("../../database/pecaservico_dao.php");
?>

<div class="col-md-10">
    <h3>Detalhe serviço</h3>

    <?php
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {

        $servicoDao = new ServicoDao();
        $servico_listado = $servicoDao->ListarID($_GET["id"]);
        if ($servico_listado == null) {
            header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
        }
    }
    ?>
    <div class="row">
        <fieldset class="border p-2 col-md-6">
            <legend>Serviços</legend>
            <label> <strong>Cliente: </strong> <?php echo $servico_listado["Nome"]; ?> </label><br>
            <label> <strong>Carro: </strong> <?php echo $servico_listado["Carro"]; ?> </label><br>
            <label> <strong>Placa: </strong> <?php echo $servico_listado["Placa"]; ?> </label><br>
            <label> <strong>Data de Entrada: </strong> <?php echo $servico_listado["DataEntrada"]; ?> </label><br>
            <label> <strong>Data de Saída: </strong> <?php echo $servico_listado["DataSaida"]; ?> </label><br>
            <a target="_blank" href="<?php echo $site_url; ?>routes/servico/servico_pdf.php/?id=<?php echo $_GET['id']; ?>" class="btn btn-warning"> <i class="fa fa-file-pdf-o"></i> Gerar PDF</a>
            <a href="<?php echo $site_url; ?>routes/servico/servico_lista.php" class="btn btn-danger">Voltar</a>
        </fieldset>

        <fieldset class="border p-2 col-md-6">
            <legend>Descriminação</legend>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>R$ Atual Unit</th>
                        <th>Valor Cobrado</th>
                    </tr>
                </thead>
                <?php
                $peca_servicoDao = new PecaServicoDao();
                $lista_pecaServico = $peca_servicoDao->Listar($servico_listado["ID"]);

                if (isset($lista_pecaServico)) {
                    for ($i = 0; $i < count($lista_pecaServico); $i++) {
                        echo "<tr>";
                        echo '<td>' . $lista_pecaServico[$i]["Descriminacao"] . "</td>";
                        echo '<td>' . $lista_pecaServico[$i]["Tipo"] . "</td>";
                        echo '<td>' . $lista_pecaServico[$i]["Valor"] . "</td>";
                        echo '<td>' . $lista_pecaServico[$i]["SubValor"] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>

            </table>
            <label> <strong>Total: R$</strong> <?php echo $servico_listado["Total"]; ?> </label><br>
        </fieldset>

    </div>

 




</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>

<script>
    $(function() {
        var id = $("#id").val();
        console.log(id);
        $("#id").change(function(e) {
            console.log("mexi");
            $(this).val(id);
            $(this).attr("readonly", true);
        });
    });
</script>
