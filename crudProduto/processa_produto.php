<?php
include_once('config/conexao.php');



if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = null;
    if (isset($_FILES['imagem'])) {
        echo "Existe imagem";
        $nome_arquivo = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];
        $nome_temporario = $_FILES['imagem']['tmp_name'];
        $destino = "imagens/" . $_FILES['imagem']['name'];
        $foto = "imagens/" . $nome_arquivo;
        move_uploaded_file($nome_temporario, $destino);
        $query = "INSERT INTO produto (nome_produto, descricao, preco, imagem) VALUES ('$nome', '$descricao', '$preco', '$foto')";
        // Execute a query
        $resultado = mysqli_query($conexao, $query);
        if ($resultado) {
            header("location:index.php");
        } else {
            echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
        }
    }
}

if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = null;
    if (isset($_FILES['imagem']) and $_FILES['imagem']['name'] != "") {
        echo "Existe imagem";
        $nome_arquivo = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];
        $nome_temporario = $_FILES['imagem']['tmp_name'];
        $destino = "imagens/" . $_FILES['imagem']['name'];
        $foto = "imagens/" . $nome_arquivo;
        move_uploaded_file($nome_temporario, $destino);
        $query = "UPDATE  produto SET nome_produto = '$nome', descricao = '$descricao', preco = '$preco', imagem = '$foto' WHERE id_produto = '$id' ";
        // Execute a query
        $resultado = mysqli_query($conexao, $query);
        if ($resultado) {
            header("location:admin/admin.php");
        } else {
            echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
        }
    } else {
        $query = "UPDATE  produto SET nome_produto = '$nome', descricao = '$descricao', preco = '$preco' WHERE id_produto = '$id' ";
        // Execute a query
        $resultado = mysqli_query($conexao, $query);
        if ($resultado) {
            header("location:admin/admin.php");
        } else {
            echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
        }
    }
}
?>