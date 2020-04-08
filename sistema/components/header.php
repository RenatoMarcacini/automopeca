<?php 
    session_start(); 
    $site_url = "http://localhost/automopeca/";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AutomaPeca Serviço</title>

    <link rel="stylesheet" href="<?php echo $site_url; ?>css/style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>

<body>


    <nav class="cabecalho teste navbar navbar-expand-lg navbar-light ">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa fa-car" aria-hidden="true"></i> AutomaPeca</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    <?php
                        if(isset($_SESSION["email"])){
                            echo "<a class='nav-item nav-link' href='{$site_url}logout.php'>Sair <i class='fa fa-sign-in' aria-hidden='true'></i> </a>";
                        } 
                        else{
                            echo "<a class='nav-item nav-link' href='{$site_url}index.php'>Login <i class='fa fa-sign-in' aria-hidden='true'></i> </a>";
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </nav>