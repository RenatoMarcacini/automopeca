<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/cliente_dao.php");
require("../../models/cliente_model.php");

?>

<div class="col-md-10">
    <?php
        if(isset($_POST["submit"])){
            if(isset($_POST["nome_cliente"]) && isset($_POST["telefone_cliente"])){

                $cliente = new Cliente(
                    0,
                    $_POST["nome_cliente"],
                    $_POST["telefone_cliente"],
                    $_POST["endereco_cliente"],
                    $_POST["numero_cliente"],
                    $_POST["bairro_cliente"],
                    $_POST["cidade_cliente"]
                );

                $clienteDao = new ClienteDao();
                if($clienteDao->Inserir($cliente)){
                    header("location:" . $site_url . "routes/cliente/cliente_lista.php?acao=1");
                }
                else{
                    header("location:" . $site_url . "routes/cliente/cliente_lista.php?acao=0");
                }
            }
            else{
                header("location:" . $site_url . "routes/cliente/cliente_lista.php?acao=0");
            }
        }

    ?>

    <form method="post">
        <fieldset class="border p-2">
            <legend>Novo Cliente</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome_cliente">Nome</label>
                    <input name="nome_cliente"  type="text" class="form-control" placeholder="Digite o nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone_cliente">Telefone</label>
                    <input name="telefone_cliente" type="tel" class="form-control" placeholder="(00) 00000-0000" data-mask="(00) 00000-0000" required>
                </div>
            
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="endereco_cliente">Endereço</label>
                    <input name="endereco_cliente" type="text" class="form-control" placeholder="Digite o Endereço">
                </div>
                <div class="form-group col-md-3">
                    <label for="numero_cliente">Número</label>
                    <input name="numero_cliente" type="number" value="0" min="0" max="10000" class="form-control" placeholder="Digite o número">
                </div>
                <div class="form-group col-md-3">
                    <label for="bairro_cliente">Bairro</label>
                    <input name="bairro_cliente" type="text" class="form-control" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-md-3">
                    <label for="cidade_cliente">Cidade</label>
                    <input name="cidade_cliente" type="text" class="form-control" placeholder="Digite o cidade">
                </div>
              
            
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="Cadastrar">
            <a href="<?php echo $site_url; ?>routes/cliente/cliente_lista.php" class="btn btn-danger">Voltar</a>
        </fieldset>

    </form>

</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>

<script>
    $(function(){
        
    });
</script>