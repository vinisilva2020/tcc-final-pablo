<?php



// Função para adicionar um produto ao carrinho
function adicionarAoCarrinho($produtoId)
{
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
}

// Função para obter a quantidade total de produtos no carrinho
function obterQuantidadeTotalCarrinho()
{
    $carrinho = isset($_COOKIE['carrinho']) ? unserialize($_COOKIE['carrinho']) : array();
    return array_sum($carrinho);
}



// Função para obter produtos no carrinho
function obterProdutosNoCarrinho()
{
    $carrinho = isset($_COOKIE['carrinho']) ? unserialize($_COOKIE['carrinho']) : array();
    return $carrinho;
}


// ... Seu código anterior ...

function obterConteudoCarrinho()
{
    // Recupere os produtos do carrinho e exiba
    $produtosNoCarrinho = obterProdutosNoCarrinho();
    
    foreach ($produtosNoCarrinho as $produtoId => $quantidade) {
        // Exiba as informações do produto usando o $produtoId, se necessário
        echo "Produto ID: $produtoId, Quantidade: $quantidade<br>";
    }
}

// ... Seu código anterior ...
?>









?>