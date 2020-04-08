<?php
require("../../database/servico_dao.php");
require("../../models/servico_model.php");
require("../../database/pecaservico_dao.php");
require_once("../../dompdf/dompdf_config.inc.php");
date_default_timezone_set('America/Sao_Paulo');
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    session_start();
    if (!isset($_SESSION['email'])) {
        $site_url = "http://localhost/automopeca/";
        header("location: {$site_url}index.php");
    }

    $servicoDao = new ServicoDao();
    $servico_listado = $servicoDao->ListarID($_GET["id"]);
    if ($servico_listado == null) {
        header("location:" . $site_url . "routes/servico/servico_lista.php?acao=0");
    }
}

$peca_servicoDao = new PecaServicoDao();
$lista_pecaServico = $peca_servicoDao->Listar($servico_listado["ID"]);

$data_atual = date('d/m/Y');
$data_entrada = date('d/m/Y', strtotime($servico_listado["DataEntrada"]));
$data_saida = "";
if(isset($servico_listado["DataSaida"])){
    $data_saida = date('d/m/Y', strtotime($servico_listado["DataSaida"]));
}

$descriminacao = "
    <table>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Valor R$</th>
        </tr>
    ";
if (isset($lista_pecaServico)) {
    for ($i = 0; $i < count($lista_pecaServico); $i++) {
        $descriminacao .= "
            <tr>
                <td> {$lista_pecaServico[$i]['Descriminacao']}</td>
                <td> {$lista_pecaServico[$i]['Tipo']}</td>
                <td> {$lista_pecaServico[$i]['SubValor']}</td>
            </tr>";
    }
}


$descriminacao .= "</table>";


$dompdf = new DOMPDF();
$html = "
            <style>
                body{
                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                    font-size: 12px;
                    box-sizing: border-box;
                }

                p{
                    margin: 5px;
                    font-size: 14px;
                }

                img{
                    display:block;
                    width: 60px;
                    position: fixed;
                }

                .titulo_empresa {
                    margin-left: 65px;
                    margin-bottom: 10px;
                }

                .titulo_empresa h1{
                    font-size: 14px;
                    margin: 0;
                }

                .titulo_empresa p{
                    font-size: 12px;
                    margin: 0;
                }

                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                
                th{
                padding: 5px 0;
                border-bottom: 1px solid black;
                text-align: left;
                }

                td{
                    padding: 5px 0;  
                }

                .total{
                    font-size: 18px;
                    text-align: right;
                }
               
                .coluna{
                    display: inline-block;
                    width: 50%;

                }

                .data{
                    text-align: right;
                }


            </style>

            <div>
                <img src='../../img/logo.png'/>
                <div class='titulo_empresa'>
                    <h1>AUTOMOPEÇA - CENTRO AUTOMOTIVO</h1>
                    <p>Rua da Empresa, Número 0000 - Centro</p>
                    <p>(00) 00000-0000 autompeca@email.com</p>
                    <p>CNPJ 000.000.000/0000-00</p>
                </div>
            </div>
            <p class='data'>Data de emissão: {$data_atual}</p>

            <fieldset><legend>CLIENTE/VEÍCULO</legend>
                <div class='coluna'>
                    <p> <strong>Cliente: </strong> {$servico_listado["Nome"]} </p>
                    <p> <strong>Carro: </strong> {$servico_listado["Carro"]} </p>
                    <p> <strong>Placa: </strong> {$servico_listado["Placa"]} </p>
                </div>
                <div class='coluna'>
                    <p> <strong>Data de Entrada: </strong> {$data_entrada} </p>
                    <p> <strong>Data de Saída: </strong> {$data_saida} </p>
                </div>
               
            </fieldset>
            
            <fieldset><legend>DESCRMINAÇÃO</legend>
                {$descriminacao}
            </fieldset>
            <h1 class='total'>Valor total: R$ {$servico_listado["Total"]}</h1:
            ";


/* Carrega seu HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();

$nome_arquivo =  $servico_listado["Nome"] . date(' d m Y his') .  $_GET['id'] . ".pdf";

$dompdf->stream(
    $nome_arquivo, /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
