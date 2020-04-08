<?php
require("../../components/header.php");
require("../../components/panel.php");
require("../../database/servico_dao.php");
require("../../models/servico_model.php");
include("../../database/cliente_dao.php");
require("../../models/cliente_model.php");
require("../../database/peca_dao.php");
require("../../models/peca_model.php");
require("../../database/pecaservico_dao.php");
require("../../models/pecaservico_model.php");
?>

<div class="col-md-10">
    <?php
    if (isset($_POST["submit"])) {
        echo $_POST['cliente_id'];

        echo var_dump($_POST['peca_id']);
        echo var_dump($_POST['peca_valor']);
        if (
            isset($_POST["carro_servico"]) &&
            isset($_POST["placa_servico"]) &&
            isset($_POST["entrada_servico"]) &&
            isset($_POST["cliente_id"]) &&
            isset($_POST["peca_id"]) &&
            isset($_POST["peca_valor"])
        ) {

            $servico = new Servico(
                0,
                $_POST["cliente_id"],
                $_POST["carro_servico"],
                $_POST["placa_servico"],
                $_POST["entrada_servico"],
                null,
                $_POST["valor_total"]
            );

            $peca = $_POST["peca_id"];
            $peca_valor = $_POST["peca_valor"];


            $servicoDao = new servicoDao();
            if ($servicoDao->Inserir($servico)) {
                $servico_ultimo_id = $servicoDao->UltimoIDServico();
                $peca_servicoDao = new PecaServicoDao();
                $erro = 0;
                for ($i = 0; $i < count($_POST['peca_id']); $i++) {
                    $pecaservico = new PecaServico(
                        0,
                        $servico_ultimo_id["UltimoID"],
                        $peca[$i],
                        1,
                        $peca_valor[$i]
                    );
                    if (!$peca_servicoDao->Inserir($pecaservico)) {
                        $erro = 1;
                    }
                }

                if ($erro == 1) {
                    header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
                } else {
                    header("location:" . $site_url . "routes/servico/servico_lista.php?acao=1");
                }
            } else {
                header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
            }
        } else {
            header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
        }
    }


    ?>

    <form method="post">
        <fieldset class="border p-2">
            <legend class="w-auto">Novo Serviço</legend>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="carro_servico">Cliente</label>

                    <select name="cliente_id" class="form-control" id="clientes">
                        <?php
                        $clienteDao = new ClienteDao();
                        $lista_cliente = $clienteDao->Listar();

                        for ($i = 0; $i < count($lista_cliente); $i++) {
                            echo "<option value='" . $lista_cliente[$i]['ID'] . "'>" . $lista_cliente[$i]['Nome']  . "</option>";
                        }
                        ?>
                    </select>

                </div>
                <div class="form-group col-md-3">
                    <label for="carro_servico">Carro</label>
                    <input name="carro_servico" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="Digite o carro" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="placa_servico">Placa</label>
                    <input name="placa_servico" onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" placeholder="ABC-0000" data-mask="AAA-0000" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="entrada_servico">Data de Entrada</label>
                    <input id="data_entrada" name="entrada_servico" type="date" class="form-control" required>
                </div>
            </div>
        </fieldset>

        <fieldset class="border p-2">
            <legend class="w-auto">Peças Utilizadas</legend>

            <div class="tabela_peca">
                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody id="corpo_tabela">
                    </tbody>
                </table>
            </div>

            <div class="form-group float-right">
                <label for="valor_total">Total</label>
                <input class="form-control" id="valor_total" name="valor_total" type="number" readonly required value="0">
            </div>
            <button id="btn_peca" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</button>
        </fieldset>

        <br>
        <input type="submit" class="btn btn-success" name="submit" value="Cadastrar">
        <a href="<?php echo $site_url; ?>routes/servico/servico_lista.php" class="btn btn-danger">Voltar</a>


    </form>

</div>

<div id="modal_peca" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de Peças</h5>
            </div>
            <div class="modal-body">
                <select id="pecas" class="form-control">
                    <?php
                    $pecaDao = new PecaDao();
                    $lista_peca = $pecaDao->Listar();

                    for ($i = 0; $i < count($lista_peca); $i++) {
                        echo "<option label='" . $lista_peca[$i]["Valor"] . "' value='" . $lista_peca[$i]['ID'] . "'>" . $lista_peca[$i]['Descriminacao']  . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_adicionar_peca">Adicionar</button>
                <button type="button" class="btn btn-secondary" id="btn_fechar">Fechar</button>
            </div>
        </div>
    </div>
</div>



<?php require("../../components/panel_end.php") ?>
<?php require("../../components/footer.php") ?>

<script>
    $(function() {
        var dataAtual = new Date().toISOString().split("T")[0];
        $("#valor_total").val(calcularTotal());

        $("#data_entrada").val(dataAtual);

        var index = 0;
        $("#btn_peca").click(function(e) {
            e.preventDefault();
            $("#modal_peca").show();
            return false;
        });

        $("#btn_fechar").click(function() {
            $("#modal_peca").hide();

        });

        $("#btn_adicionar_peca").click(function() {
            $("#modal_peca").hide();
            index++;
            $("#corpo_tabela").append(
                `
                <tr id='peca_${index}'>
                    <td><input hidden type='number' name='peca_id[]' value='${$("#pecas").val()}'/> ${document.getElementById("pecas").selectedOptions[0].innerHTML}</td>
                    <td><input class="subvalor" hidden type='number' name='peca_valor[]' value='${document.getElementById("pecas").selectedOptions[0].label}'/> ${document.getElementById("pecas").selectedOptions[0].label}</td>
                    <td><button onclick=$(this).removerPeca('#peca_${index}') class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                </tr>
                `
            );

            $("#valor_total").val(calcularTotal());
        });

        function calcularTotal() {
            let valores = $(".subvalor");
            let total = 0;
            for (let i = 0; i < valores.length; i++) {
                total += parseFloat(valores[i].value);
            }
            return total;
        }

        $.fn.removerPeca = function(idPeca) {
            $(idPeca).remove();
            $("#valor_total").val(calcularTotal());
        };

    });
</script>