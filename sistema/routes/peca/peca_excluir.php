<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/peca_dao.php");
require("../../models/peca_model.php");
require("../../database/pecaservico_dao.php");

?>

<div class="col-md-10">
    <?php
    if (isset($_POST["submit"])) {
        if (isset($_POST["id_peca"])) {

            $peca_servicoDao = new PecaServicoDao();
            if ($peca_servicoDao->ListarPorPeca($_POST["id_peca"]) == null) {
                $pecaID = intval($_POST["id_peca"]);
                $pecaDao = new pecaDao();

                if ($pecaDao->Excluir($pecaID)) {
                    header("location:" . $site_url . "routes/peca/peca_lista.php?acao=1");
                } else {
                    header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Há serviços que dependem desta descrminação!</div>';
                $pecaDao = new pecaDao();
                $peca_listado = $pecaDao->ListarID($_GET["id"]);
                if ($peca_listado == null) {
                    header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
                }
            }
        } else {
            header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
        }
    } else {

        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {

            $pecaDao = new pecaDao();
            $peca_listado = $pecaDao->ListarID($_GET["id"]);
            if ($peca_listado == null) {
                header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
            }
        }
    }

    ?>

    <fieldset class="border p-2">
        <legend>Excluir Peça</legend>
        <form method="post">
            <input name="id_peca" type="text" value="<?php echo $peca_listado["ID"]; ?>" readonly hidden>
            <label> <strong>ID: </strong> <?php echo $peca_listado["ID"]; ?> </label><br>
            <label> <strong>Descriminacao: </strong> <?php echo $peca_listado["Descriminacao"]; ?> </label><br>
            <label> <strong>Valor: </strong> <?php echo $peca_listado["Valor"]; ?> </label><br>
            <label> <strong>Tipo: </strong> <?php echo $peca_listado["Tipo"]; ?> </label><br>

            <input type="submit" class="btn btn-success" name="submit" value="Excluir">
            <a href="<?php echo $site_url; ?>routes/peca/peca_lista.php" class="btn btn-danger">Voltar</a>
        </form>
    </fieldset>

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