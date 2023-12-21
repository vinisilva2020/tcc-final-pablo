<?php

session_start();

include '../config/conexao.php';


$nome = $_POST['nome'];

$senha = $_POST['senha'];


if (empty($nome) || empty($senha)) {
    $_SESSION['title'] = "Erro no Login";
    $_SESSION['icon'] = "error";
    header("location:../index.php");
    exit;
}


if (isset($_POST['fazer-login'])) {
    $sql = "SELECT * FROM usuario WHERE nome = '$nome' AND senha = '$senha' ";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        if ($dados['nivel'] < 1) {
            $_SESSION['id_usuario'] = $dados['id_usuario'];
            $_SESSION['nome'] = $dados['nome'];
            $_SESSION['senha'] = $dados['senha'];
            header("location:../index.php");
        } else {
            header("location:../admin/index.php");
        }
    } else {
        $_SESSION['title'] = "Erro no Login" . mysqli_error($conexao);
        $_SESSION['icon'] = "error";
        header("location:../index.php");
        die;
    }
}else {
    $_SESSION['title'] = "Erro no Login" . mysqli_error($conexao);
        $_SESSION['icon'] = "error";
        header("location:../index.php");
        die;
}



