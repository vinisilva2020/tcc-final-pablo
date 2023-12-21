<?php

session_start();

include '../config/conexao.php';

if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];




    $sql = "INSERT INTO usuario(nome,email,telefone,endereco,senha) VALUES ('$nome','$email','$telefone','$endereco','$senha')";


    $query = mysqli_query($conexao, $sql);

    if ($query) {
        $_SESSION['title'] = "Cadastrado com sucesso!!";
        $_SESSION['icon'] = "success";
        header("location:../index.php");
        die;
    } else {
        $_SESSION['title'] = "Erro no cadastro" . mysqli_error($conexao);
        $_SESSION['icon'] = "error";
        header("location:../index.php");
        die;
    }
}


if (isset($_POST['editar-usuario'])) {
    $id = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];

    $sql = "UPDATE usuario SET nome = '$nome' , email = '$email' ,telefone = '$telefone', endereco = '$endereco' , senha = '$senha' WHERE id_usuario = '$id' ";


    $query = mysqli_query($conexao, $sql);

    if ($query) {
        $_SESSION['title'] = "Seu perfil foi alterado!!";
        $_SESSION['icon'] = "success";
        header("location:../index.php");
        die;
    } else {
        $_SESSION['title'] = "Erro no Perfil" . mysqli_error($conexao);
        $_SESSION['icon'] = "error";
        header("location:../index.php");
        die;
    }
}

if (isset($_POST['excluir'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM usuario WHERE id_usuario = '$id'";
    $query = mysqli_query($conexao, $sql);

    if ($query) {
        session_destroy();
        header("location:../index.php");
        die;
    }
}


?>