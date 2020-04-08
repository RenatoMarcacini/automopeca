<?php
session_start();


require_once("../database/connection.php");

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email) && isset($password)) {
    $support = new Support();
    $sql = "SELECT Email, Cargo FROM usuarios WHERE Email = ? AND Senha = ?";

    $stmt = $support->connect->prepare($sql);
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $_SESSION['cargo'] = $row['Cargo'];
            break;
        }
        $_SESSION['email'] = $email;
        echo json_encode(true);
    } else {
        unset($_SESSION['email']);
        unset($_SESSION['cargo']);
        echo json_encode(false);
    }
    $stmt->close();
} else {
    echo json_encode(false);
}
