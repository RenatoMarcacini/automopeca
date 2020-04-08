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
                    $_POST["id_cliente"],
                    $_POST["nome_cliente"],
                    $_POST["telefone_cliente"],
                    $_POST["endereco_cliente"],
                    $_POST["numero_cliente"],
                    $_POST["bairro_cliente"],
                    $_POST["cidade_cliente"]
                );  

                $clienteDao = new ClienteDao();
                if($clienteDao->Atualizar($cliente)){
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
        else{

            if(isset($_GET["id"]) && is_numeric($_GET["id"])){

                $clienteDao = new ClienteDao();
                $cliente_listado = $clienteDao->ListarID($_GET["id"]);
                if($cliente_listado == null){
                    header("location:" . $site_url . "routes/cliente/cliente_lista.php?acao=0");
                }
            }
        }

    ?>

    <fieldset class="border p-2">
        <legend>Editar Cliente</legend>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-1">
                    <label for="id_cliente">ID</label>
                    <input id="id" readonly="true" name="id_cliente" value="<?php echo $cliente_listado["ID"]; ?>"  type="text" class="form-control" placeholder="Digite o nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nome_cliente">Nome</label>
                    <input name="nome_cliente" value="<?php echo $cliente_listado["Nome"]; ?>"  type="text" class="form-control" placeholder="Digite o nome" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="telefone_cliente">Telefone</label>
                    <input value="<?php echo $cliente_listado["Telefone"]; ?>"  name="telefone_cliente" type="tel" class="form-control" placeholder="(00) 00000-0000" data-mask="(00) 00000-0000" required>
                </div>
            
            </div>
    
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="endereco_cliente">Endereço</label>
                    <input value="<?php echo $cliente_listado["Endereco"]; ?>"  name="endereco_cliente" type="text" class="form-control" placeholder="Digite o Endereço">
                </div>
                <div class="form-group col-md-3">
                    <label for="numero_cliente">Número</label>
                    <input value="<?php echo $cliente_listado["Numero"]; ?>"  name="numero_cliente" type="number" value="0" min="0" max="10000" class="form-control" placeholder="Digite o número">
                </div>
                <div class="form-group col-md-3">
                    <label for="bairro_cliente">Bairro</label>
                    <input value="<?php echo $cliente_listado["Bairro"]; ?>"  name="bairro_cliente" type="text" class="form-control" placeholder="Digite o bairro">
                </div>
                <div class="form-group col-md-3">
                    <label for="cidade_cliente">Cidade</label>
                    <input value="<?php echo $cliente_listado["Cidade"]; ?>"  name="cidade_cliente" type="text" class="form-control" placeholder="Digite o cidade">
                </div>
              
            
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="Atualizar">
            <a href="<?php echo $site_url; ?>routes/cliente/cliente_lista.php" class="btn btn-danger">Voltar</a>
        </form>
    </fieldset>


</div>

<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>

<script>
    $(function(){
        var id = $("#id").val();
        console.log(id);
        $("#id").change(function(e){
            console.log("mexi");
            $(this).val(id);
            $(this).attr("readonly", true);
        });
    });
</script>