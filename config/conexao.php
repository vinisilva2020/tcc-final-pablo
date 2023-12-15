<?php
$servidor = "localhost";
$usuario = "root"; 
$senha = "";
$nomeDb = "tccp";

$conexao = mysqli_connect($servidor, $usuario, $senha, $nomeDb); 
if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}
