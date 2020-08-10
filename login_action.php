<?php
session_start();
require './classes/Usuario.php';
require './config.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_VALIDATE_INT);

if($email && $senha) {
    $user = new Usuario($pdo);
    $select = $user->select($email);

    if($select) {
        /*
        * Se a função select da classe $user retornar true significa que existe
        * um email cadastrado no banco de dados,logo o usuário já é cadastrado
        * então este usuário é redirecionado para área restrita do sistema.
        */
        $_SESSION['email'] = $email;
        header("location: pagina-usuario.php");
        exit;
    } else {
        header("location:login.html");
        exit;
    }
} else {
    header("location:login.php");
    exit;
}