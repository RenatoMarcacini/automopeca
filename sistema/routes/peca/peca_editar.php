<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/peca_dao.php");
require("../../models/peca_model.php");

?>

<div class="col-md-10">
    <?php
    if (isset($_POST["submit"])) {
        if (
            isset($_POST["id_peca"]) &&
            isset($_POST["descriminacao_peca"]) &&
            isset($_POST["valor_peca"]) &&
            isset($_POST["tipo_peca"])
        ) {

            $peca = new Peca(
                $_POST["id_peca"],
                $_POST["descriminacao_peca"],
                doubleval($_POST["valor_peca"]),
                $_POST["tipo_peca"]
            );
            
            $pecaDao = new PecaDao();
            if ($pecaDao->Atualizar($peca)) {
                header("location:" . $site_url . "routes/peca/peca_lista.php?acao=1");
            } else {
                header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
            }
        } else {
            header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
        }
    } else {

        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {

            $pecaDao = new PecaDao();
            $peca_listado = $pecaDao->ListarID($_GET["id"]);
            if ($peca_listado == null) {
                header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
            }
        }
    }

    ?>

    <fieldset class="border p-2">
        <legend>Editar Peça</legend>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-1">
                    <label for="id_peca">ID</label>
                    <input id="id" readonly="true" name="id_peca" value="<?php echo $peca_listado["ID"]; ?>" type="text" class="form-control" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="descriminacao_peca">Descriminação</label>
                    <input name="descriminacao_peca" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Digite a descriminação" value="<?php echo $peca_listado["Descriminacao"]; ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="valor_peca">Valor</label>
                    <input id="valor_peca" name="valor_peca" type="number" step="0.01" class="form-control" placeholder="Digite o valor em R$" value="<?php echo $peca_listado["Valor"]; ?>" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="tipo_peca">Tipo</label>
                    <input name="tipo_peca" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Digite o tipo" value="<?php echo $peca_listado["Tipo"]; ?>" required>
                </div>
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="Atualizar">
            <a href="<?php echo $site_url; ?>routes/peca/peca_lista.php" class="btn btn-danger" >Voltar</a>
        </form>
    </fieldset>
</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>