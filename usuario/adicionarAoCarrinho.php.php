<?php
session_start();
include 'funcoesCarrinho.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produtoId'])) {
    $produtoId = $_POST['produtoId'];

    // Se o carrinho não existir, cria um array vazio
    $carrinho = isset($_COOKIE['carrinho']) ? unserialize($_COOKIE['carrinho']) : array();

    // Adiciona o produto ao carrinho (usando o ID como chave e a quantidade como valor)
    if (isset($carrinho[$produtoId])) {
        $carrinho[$produtoId]++;
    } else {
        $carrinho[$produtoId] = 1;
    }

    // Armazena o carrinho no cookie
    setcookie('carrinho', serialize($carrinho), time() + 3600, '/'); // Expire em 1 hora (ajuste conforme necessário)

    // Retorna a quantidade total de produtos no carrinho
    echo array_sum($carrinho);
} else {
    echo 'Erro ao processar a requisição.';
}
?>
