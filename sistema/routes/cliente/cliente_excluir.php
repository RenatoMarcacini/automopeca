<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/cliente_dao.php");
require("../../database/servico_dao.php");
require("../../models/cliente_model.php");
?>

<div class="col-md-10">
    <?php
    if (isset($_POST["submit"])) {
        $servicoDao = new ServicoDao();


        if (isset($_POST["id_cliente"])) {
            if ($servicoDao->ListarPorCliente($_POST["id_cliente"]) != null) {
                echo '<div class="alert alert-danger" role="alert">Há serviços que dependem desta descrminação!</div>';
                $clienteDao = new ClienteDao();
                $cliente_listado = $clienteDao->ListarID($_GET["id"]);
            }
        } else {
            header("location:" . $site_url . "routes/cliente/cliente_lista.php?acao=0");
        }
    } else {

        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {

            $clienteDao = new ClienteDao();
            $cliente_listado = $clienteDao->ListarID($_GET["id"]);
            if ($cliente_listado == null) {
                header("location:" . $site_url . "routes/cliente/cliente_lista.php?acao=0");
            }
        }
    }

    ?>

    <fieldset class="border p-2">
        <legend>Excluir Cliente</legend>
        <form method="post">

            <input name="id_cliente" type="text" value="<?php echo $cliente_listado["ID"]; ?>" readonly hidden>
            <label> <strong>ID: </strong> <?php echo $cliente_listado["ID"]; ?> </label><br>
            <label> <strong>Nome: </strong> <?php echo $cliente_listado["Nome"]; ?> </label><br>
            <label> <strong>Telefone: </strong> <?php echo $cliente_listado["Telefone"]; ?> </label><br>
            <label> <strong>Endereco: </strong> <?php echo $cliente_listado["Endereco"]; ?> </label><br>
            <label> <strong>Número: </strong> <?php echo $cliente_listado["Numero"]; ?> </label><br>
            <label> <strong>Bairro: </strong> <?php echo $cliente_listado["Bairro"]; ?> </label><br>
            <label> <strong>Cidade: </strong> <?php echo $cliente_listado["Cidade"]; ?> </label><br>
            <input type="submit" class="btn btn-success" name="submit" value="Excluir">
            <a href="<?php echo $site_url; ?>routes/cliente/cliente_lista.php" class="btn btn-danger">Voltar</a>

        </form>
    </fieldset>

</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>