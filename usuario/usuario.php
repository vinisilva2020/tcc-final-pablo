<?php

session_start();

include '../config/conexao.php';


$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$senha = $_POST['senha'];

$hash = password_hash($senha, PASSWORD_DEFAULT);



$sql = "INSERT INTO usuario(nome,email,telefone,endereco,senha) VALUES ('$nome','$email','$telefone','$endereco','$hash')";


$query = mysqli_query($conexao, $sql);

if ($query) {
    $_SESSION['title'] = "Cadastrado com sucesso!!";
    $_SESSION['icon']  = "success";
    header("location:../index-usuario.php");
    die;
}else {
    $_SESSION['title'] = "Erro no cadastro".mysqli_error($conexao);
    $_SESSION['icon']  = "error";
    header("location:../index-usuario.php");
    die;
}

?>