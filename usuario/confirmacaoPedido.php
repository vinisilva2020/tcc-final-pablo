<?php
include '../config/conexao.php';



session_start();




// Teste da conexão
if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}


include 'funcoesCarrinho.php';

$produtosCarrinho = isset($_POST['produtos_carrinho']) ? $_POST['produtos_carrinho'] : [];

// Função para calcular o total do pedido
function calcularTotalPedido()
{
    global $conexao; // Certifique-se de que a conexão com o banco de dados está disponível

    $total = 0;

    $produtosNoCarrinho = obterProdutosNoCarrinho();
    foreach ($produtosNoCarrinho as $produtoId => $quantidade) {
        $sql = "SELECT preco FROM produto WHERE id_produto = $produtoId";
        $query = mysqli_query($conexao, $sql);
        $dadosProduto = mysqli_fetch_assoc($query);
        $precoProduto = $dadosProduto['preco'];

        $total += $precoProduto * $quantidade;
    }

    return number_format($total, 2, ',', '.');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
        /* Adicione estilos personalizados conforme necessário */
    </style>
</head>

<body>

<div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h2 class="mb-4">Confirmação de Pedido</h2>
                <p>O seu pedido foi finalizado com sucesso. Agradecemos por escolher Quitutes da Vivi!</p>

                <!-- Detalhes adicionais do pedido -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Detalhes do Pedido</h5>

                        <!-- Exiba os detalhes do carrinho -->
                        <?php
                        foreach ($produtosCarrinho as $produtoId => $quantidade) {
                            $sql = "SELECT nome_produto, preco FROM produto WHERE id_produto = $produtoId";
                            $query = mysqli_query($conexao, $sql);
                            $dadosProduto = mysqli_fetch_assoc($query);
                            $nomeProduto = $dadosProduto['nome_produto'];
                            $precoProduto = $dadosProduto['preco'];
                        ?>
                            <p><strong><?php echo $nomeProduto; ?></strong> - Quantidade: <?php echo $quantidade; ?> - Preço: R$ <?php echo number_format($precoProduto * $quantidade, 2, ',', '.'); ?></p>
                        <?php
                        }
                        ?>

                        <!-- Adicione outras informações do pedido conforme necessário -->

                        <p class="mt-3">Total: R$ <?php echo calcularTotalPedido(); ?></p>
                    </div>
                </div>

                <a href="index.php" class="btn btn-primary mt-3">Voltar para a Página Inicial</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

        <script>
    // Função para adicionar um produto ao carrinho
    function adicionarAoCarrinho(produtoId) {
        $.ajax({
            type: 'POST',
            url: 'adicionarAoCarrinho.php',
            data: { produtoId: produtoId },
            success: function (response) {
                Swal.fire({
                    title: 'Produto adicionado ao carrinho!',
                    icon: 'success'
                });
                // Atualiza a contagem do carrinho na página inicial
                $('#contadorCarrinho').text(response);
                // Atualiza o conteúdo do carrinho no modal
                $('#carrinho-content').load('carrinhoPedido.php');
            },
            error: function () {
                Swal.fire({
                    title: 'Erro ao adicionar produto ao carrinho!',
                    icon: 'error'
                });
            }
        });
    }

    $(document).ready(function () {
        // Carrega inicialmente o conteúdo do carrinho no modal
        $('#carrinho-content').load('carrinhoPedido.php');

        // Adiciona um evento de clique para o botão de finalizar pedido
        $('#btnFinalizarPedido').click(function (e) {
            e.preventDefault(); // Previne o comportamento padrão do formulário
            finalizarPedido();
        });
    });
</script
</body>
</html>
