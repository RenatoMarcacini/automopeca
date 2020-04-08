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
            isset($_POST["descriminacao_peca"]) &&
            isset($_POST["valor_peca"]) &&
            isset($_POST["tipo_peca"])
        ) {

            $peca = new Peca(
                0,
                $_POST["descriminacao_peca"],
                doubleval($_POST["valor_peca"]),
                $_POST["tipo_peca"]
            );

            $pecaDao = new PecaDao();
            if ($pecaDao->Inserir($peca)) {
                header("location:" . $site_url . "routes/peca/peca_lista.php?acao=1");
            } else {
                header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
            }
        } else {
            header("location:" . $site_url . "routes/peca/peca_lista.php?acao=0");
        }
    }

    ?>

    <fieldset class="border p-2">
        <legend>Nova Peça</legend>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="descriminacao_peca">Descriminação</label>
                    <input name="descriminacao_peca" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Digite a descriminação" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="valor_peca">Valor</label>
                    <input id="valor_peca" name="valor_peca" type="number" step="0.01" value="0" class="form-control" placeholder="Digite o valor em R$" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="tipo_peca">Tipo</label>
                    <input name="tipo_peca" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Digite o tipo" required>
                </div>
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="Cadastrar">
            <a href="<?php echo $site_url; ?>routes/peca/peca_lista.php" class="btn btn-danger">Voltar</a>
        </form>
    </fieldset>

</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>