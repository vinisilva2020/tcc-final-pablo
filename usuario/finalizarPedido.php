<?php
// finalizarPedido.php

include '../config/conexao.php';
session_start();
include 'funcoesCarrinho.php';



// Verifica se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
    exit("Usuário não autenticado");
}

// Recupera os produtos do carrinho
$produtosNoCarrinho = obterProdutosNoCarrinho();

// Insira o código aqui para adicionar os detalhes do pedido ao banco de dados
// Pode envolver a criação de uma nova tabela 'pedidos' e inserção dos produtos, quantidade, usuário, etc.

// Exemplo de como limpar o carrinho após o pedido ser finalizado
setcookie('carrinho', '', time() - 3600, '/'); // Define um tempo de expiração no passado para excluir o cookie

?>