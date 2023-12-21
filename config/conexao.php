<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "tccpablo";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if ($conexao == FALSE) {
    echo "ERRO de conexao" . mysqli_connect_error();
}
$conexao = mysqli_connect($servidor, $usuario, $senha, $nomeDb);
if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}

?>