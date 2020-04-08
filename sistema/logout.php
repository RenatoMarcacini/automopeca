<?php require("./components/header.php") ?>

<?php
    unset($_SESSION['email']);
    unset($_SESSION['cargo']);
    header("location: {$site_url}index.php");
?>