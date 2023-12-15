<?php


include("config/conexao.php");


if (isset($_GET['id_produto'])) {
    $id = $_GET['id_produto'];

    $sql = mysqli_query($conexao,"DELETE FROM produto WHERE id_produto = '$id'");

    if ($sql) {
    header("location:admin/admin.php");
    }else {
        echo "ERRO ao excluir produto".mysqli_error($conexao);
    }

}



?>