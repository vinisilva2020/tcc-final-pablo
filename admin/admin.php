<?php

session_start();

if (!isset($_SESSION)) {
    header("location:../index.php");
    die;
}


include '../config/conexao.php';


if (isset($_POST['cadastrar-produto'])) {

    $nome = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = null;

    if (isset($_FILES['imagem'])) {

        echo "Existe imagem";

        $nome_arquivo = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];

        $nome_temporario = $_FILES['imagem']['tmp_name'];
        $destino = "../imagens/" . $_FILES['imagem']['name'];


        $foto = "../imagens/" . $nome_arquivo;

        move_uploaded_file($nome_temporario, $destino);


        $query = "INSERT INTO produto (nome_produto, descricao, preco, imagem) VALUES ('$nome', '$descricao', '$preco', '$foto')";
        // Execute a query
        $resultado = mysqli_query($conexao, $query);
        if ($resultado) {
            $_SESSION['title'] = "Produto Cadastrado!!";
            $_SESSION['icon'] = "success";
            header("location:index.php");
            die;

        } else {
            echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
        }

    }

}
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM produto WHERE id_produto = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
        $_SESSION['title'] = "Produto excluido!!";
        $_SESSION['icon'] = "success";
        header("location:index.php");
        die;
    }

}


?>