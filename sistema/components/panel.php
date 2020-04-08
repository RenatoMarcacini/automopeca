<?php
if (!isset($_SESSION['email'])) {
    header("location: {$site_url}index.php");
}

function simplificarData($data){
    echo date("d/m/Y", strtotime($data));
}

?>

<div class="container painel">
    <div class="row">
        <nav class="col-md-2">
            <ul class="list-group">
                <li class="list-group-item active text-center">Painel</li>
                <li class="list-group-item">Bem vindo <?php echo ($_SESSION['cargo']); ?></li>
                <a class="list-group-item list-group-item-action" href="<?php echo $site_url; ?>routes/cliente/cliente_lista.php"> <i class="fa fa-users" aria-hidden="true"></i> Clientes </a>
                <a class="list-group-item list-group-item-action" href="<?php echo $site_url; ?>routes/peca/peca_lista.php"> <i class="fa fa-wrench" aria-hidden="true"></i> Peças </a>
                <a class="list-group-item list-group-item-action" href="<?php echo $site_url; ?>routes/servico/servico_lista.php"> <i class="fa fa-file-text" aria-hidden="true"></i> Serviços </a>
                <a class="list-group-item list-group-item-action" href="<?php echo $site_url; ?>logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Sair </a>
            </ul>
        </nav>