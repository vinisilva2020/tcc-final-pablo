<?php

include '../config/conexao.php';
include 'funcoesCarrinho.php';

session_start();





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Bootstrap Hero with Navbar Example</title>
  <style>
    .card:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease-in-out;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    * {
      font-family: sans-serif;
    }

    .hero {
      background-image: url("../imagens/como-comecar-seu-blog-de-comida-.png");
      filter: brightness(0.9);
      background-size: cover;
      background-position: center;
      color: #fff;
      text-align: center;
      height: 450px;
      padding: 120px 0;
    }

    .navbar .navbar-nav .nav-link:hover {
      color: red;
    }

    .lead {
      text-align: center;
    }

    .cardapio-title {
      background-color: #fff;
      /* Cor de fundo branca */
      border: 2px solid #000;
      /* Contorno preto */
      padding: 10px;
      /* Espaçamento interno */
      text-align: center;
      /* Alinhamento no centro */
      margin-bottom: 20px;
      /* Espaçamento inferior */
      border-radius: 15px;
      background-image: url('../imagens/6580567d9e1ff.jpg');
      /* Substitua pelo caminho da sua imagem */
      background-size: cover;
      /* Garante que a imagem cubra todo o elemento */
      background-position: center;
      /* Centraliza a imagem no elemento */
      color: #fff;
      /* Cor do texto, pode ser ajustada conforme necessário para legibilidade */
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
      /* Sombra do texto para melhor legibilidade */
      -webkit-text-stroke: 1px #000;
      /* Contorno preto ao redor do texto (para navegadores Webkit, como Chrome e Safari) */

      padding: 10px;
      text-align: center;
      margin-bottom: 20px;
    }


    #carrinho-content {
      margin-top: 20px;
    }

    #carrinho-content table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    #carrinho-content th,
    #carrinho-content td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    #carrinho-content th {
      background-color: #f2f2f2;
    }

    #carrinho-content button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #28a745;
      color: #fff;
      border: none;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../imagens/quitutes.png" alt="" width="80"> <span>
          Quitutes da <b class="text-danger">vivi</b>
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Página Inicial</a>
          </li>
          <?php
          if (!isset($_SESSION['id_usuario'])) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php } ?>

          <li class="nav-item">
            <a class="nav-link" href="../sobrenos.php">Sobre Nós</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../form-flip/index.php">Contato</a>
          </li>
          <?php
          if (isset($_SESSION['id_usuario'])) {
            ?>
            <li class="nav-item">
              <a class="nav-link text-danger" href="perfil.php">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="sair.php">Sair</a>
            </li>
          <?php } ?>

        </ul>
      </div>
    </div>
  </nav>
  <div class="m-2"></div>

  <div class="hero">
    <h1 class="display-4">Seja bem vindo</h1>
    <p class="lead">Atendimento focado em conforto para o cliente</p>
  </div>

  <section class="about section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
          <div class="section-img">
            <img src="quitutes.png" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-12 mt-md-5">
          <div class="about-text mt-lg-5">
          </div>
        </div>
      </div>
    </div>
  </section>
  <h2 class="p-2 cardapio-title">Cardápio</h2>

  <section class="section-padding">
    <div class="container col-md-9">
      <div class="row">
        <?php
        $sql = "SELECT * FROM produto";
        $query = mysqli_query($conexao, $sql);

        while ($dados = mysqli_fetch_assoc($query)) {
          $id = $dados['id_produto'];
          $produto = $dados['nome_produto'];
          $descricao = $dados['descricao'];
          $img = $dados['imagem'];
          $preco = $dados['preco'];
          ?>



          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="card shadow card-produto top-0 end-0 p-3">
              <img src="<?php echo $img; ?>" class="card-img-top" alt="<?php echo $produto; ?>">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo $produto; ?>
                </h5>
                <p class="card-text">
                  <?php echo $descricao; ?>.
                </p>
                <p class="card-text">Preço: R$
                  <?php echo $preco; ?>
                </p>

                <!-- Adiciona o botão "Adicionar ao Pedido" chamando a função JavaScript -->
                <?php if (isset($_SESSION['id_usuario'])) { ?>
                  <!-- Adiciona o botão "Adicionar ao Pedido" chamando a função JavaScript -->
                  <button id="btnAdicionarPedido" class="btn btn-primary"
                    onclick="adicionarAoCarrinho(<?php echo $id; ?>)">Adicionar ao Carrinho</button>
                <?php } ?>
              </div>
            </div>
          </div>

          <?php
        }
        ?>

      </div>
    </div>
  </section>



  <section class="section-padding">
    <div id="carrinho-content" class="container col-md-4">
      <?php
      if (isset($_SESSION['id_usuario'])) {
        $totalCarrinho = 0;
        ?>
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-4">Seu Carrinho</h2>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $produtosNoCarrinho = obterProdutosNoCarrinho();

                  foreach ($produtosNoCarrinho as $produtoId => $quantidade) {
                    $sql = "SELECT nome_produto, preco FROM produto WHERE id_produto = $produtoId";
                    $query = mysqli_query($conexao, $sql);
                    $dadosProduto = mysqli_fetch_assoc($query);
                    $nomeProduto = $dadosProduto['nome_produto'];
                    $precoProduto = $dadosProduto['preco'];
                    $subtotalProduto = $precoProduto * $quantidade;

                    // Adiciona o subtotal ao total do carrinho
                    $totalCarrinho += $subtotalProduto;
                    ?>
                    <tr>
                      <th scope="row">
                        <?php echo $produtoId; ?>
                      </th>
                      <td>
                        <?php echo $nomeProduto; ?>
                      </td>
                      <td>
                        <?php echo $quantidade; ?>
                      </td>
                      <td>R$
                        <?php echo number_format($subtotalProduto, 2, ',', '.'); ?>
                      </td>
                    </tr>
                    <?php
                  }

                  ?>
                </tbody>
              </table>
            </div>
            <p class="mt-3">Total do Carrinho: R$
              <?php echo number_format($totalCarrinho, 2, ',', '.'); ?>
            </p>
            <button class="btn btn-success" onclick="finalizarPedido()">Finalizar Pedido</button>
          </div>
        </div>
      </div>
      <?php
      }

      ?>
  </section>






  <div class="m-5"></div>
  <section class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php

          if (isset($_SESSION['title']) and !empty($_SESSION['title']) and isset($_SESSION['icon']) and !empty($_SESSION['icon'])) {
            ?>
            <script>
              Swal.fire
                ({
                  title: "<?php echo $_SESSION['title'] ?>",
                  icon: "<?php echo $_SESSION['icon'] ?>"
                });
            </script>
            <?php
            // Limpa as variáveis de sessão após exibição
            unset($_SESSION['title']);
            unset($_SESSION['icon']);
          }

          ?>

          <?php
          if (!isset($_SESSION['nome'])) {
            ?>
            <div class="text-center pb-5">
              <h2>Cadastre-se no nosso site </h2>
              <p>Para realizar pedidos no nosso sistema você deve realizar primeiro o seu cadastro</p>
            </div>
          </div>
        </div>
        <div class="row m-0">
          <div class="col-md-12 p-0 pt-4 p-4 pb-4">
            <form action="usuario.php" method="post" class="bg-light p-4 m-auto">
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <input class="form-control" required type="text" name="nome" placeholder="Seu nome completo">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <input class="form-control" required type="text" name="email" placeholder="Seu e-mail completo">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <input class="form-control" id="telefone" required type="text" name="telefone"
                      placeholder="Insira um numero valido (55)9999-9999">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <input class="form-control" required type="text" name="endereco"
                      placeholder="Seu endereço (valído em uruguaiana)">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <input class="form-control" required type="password" name="senha"
                      placeholder="Sua Senha (Sugerimos uma senha com mais de 8 digitos)">
                  </div>
                </div>
                <input name="cadastro" type="submit" class="btn btn-success btn-lg btn-block mt-3"></input>
              </div>
            </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <form id="formFinalizarPedido" action="confirmacaoPedido.php" method="post">
  <?php
    // Adicione campos ocultos para cada produto no carrinho
    $produtosNoCarrinho = obterProdutosNoCarrinho();
    foreach ($produtosNoCarrinho as $produtoId => $quantidade) {
    ?>
        <input type="hidden" name="produtos_carrinho[<?php echo $produtoId; ?>]" value="<?php echo $quantidade; ?>">
    <?php
    }
    ?>
</form>

<script>
    // Adicione um evento de clique para o botão de finalizar pedido
    document.getElementById('btnFinalizarPedido').addEventListener('click', function () {
        // Submeta o formulário ao clicar no botão
        document.getElementById('formFinalizarPedido').submit();
    });
</script>

  <footer class="bg-danger text-light text-center p-3">
    <p>&copy; 2023 Quitutes da Vivi. Todos os direitos reservados.</p>
  </footer>


  <script>
    $(document).ready(function () {
      $('#telefone').mask('(00) 0000-0000');
    });
  </script>

  <!-- ... (o restante do seu corpo HTML permanece o mesmo) ... -->

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
                $('#carrinho-content').load('carrinhoContent.php');
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
        $('#carrinho-content').load('carrinhoContent.php');

        // Adiciona um evento de clique para o botão de finalizar pedido
        $('#btnFinalizarPedido').click(function (e) {
            e.preventDefault(); // Previne o comportamento padrão do formulário
            finalizarPedido();
        });
    });
</script>



<script>
  function finalizarPedido() {
    $.ajax({
      type: 'POST',
      url: 'finalizarPedido.php',
      success: function (response) {
        Swal.fire({
          title: 'Pedido finalizado com sucesso!',
          icon: 'success'
        });

        // Limpa o carrinho após o pedido ser finalizado
        $.ajax({
          type: 'POST',
          url: 'limparCarrinho.php',
          success: function () {
            // Atualiza a contagem do carrinho na página inicial
            $('#contadorCarrinho').text('0');

            // Redireciona o usuário para a página de confirmação ou outra página desejada
            window.location.href = 'confirmacaoPedido.php'; // Ajuste o caminho conforme necessário
          },
          error: function () {
            Swal.fire({
              title: 'Erro ao limpar carrinho!',
              icon: 'error'
            });
          }
        });
      },
      error: function () {
        Swal.fire({
          title: 'Erro ao finalizar pedido!',
          icon: 'error'
        });
      }
    });
  }
</script>

  <script>
    $(document).ready(function () {
      // Função para obter e exibir o conteúdo atual do carrinho
      function atualizarConteudoCarrinho() {
        $.ajax({
          type: 'GET',
          url: 'carrinhoContent.php', // Substitua isso pelo caminho correto para o script que retorna o conteúdo do carrinho
          success: function (response) {
            // Exiba o conteúdo atual do carrinho
            $('#carrinho-content').html(response);
          },
          error: function () {
            console.error('Erro ao obter conteúdo do carrinho');
          }
        });
      }

      // Chame a função ao carregar a página para exibir o conteúdo inicial do carrinho
      atualizarConteudoCarrinho();

      // Adicione esta parte para atualizar o conteúdo do carrinho após adicionar um produto
      $('#btnAdicionarPedido').click(function (e) {
        e.preventDefault(); // Previne o comportamento padrão do formulário
        adicionarAoCarrinho(<?php echo $id; ?>);

        // Após adicionar ao carrinho, atualize o conteúdo do carrinho
        atualizarConteudoCarrinho();
      });
    });
  </script>


  <script>
    $(document).ready(function () {
      $('#btnAdicionarPedido').click(function (e) {
        e.preventDefault();
        var produtoId = <?php echo $id; ?>;

        adicionarAoCarrinho(produtoId);

        // Atualiza a contagem do carrinho e exibe o conteúdo
        $.ajax({
          type: 'GET',
          url: 'index.php',
          data: { atualizarCarrinho: true }, // Use um objeto para passar os dados
          success: function (response) {
            $('#carrinho-content').html(response);
          }
        });
      });

      // Verifica se a atualização do carrinho foi solicitada
      var atualizarCarrinho = '<?php echo isset($_GET["atualizarCarrinho"]) ? $_GET["atualizarCarrinho"] : ""; ?>';
      if (atualizarCarrinho === 'true') {
        // Exibe o conteúdo atual do carrinho quando a página for carregada
        $.ajax({
          type: 'GET',
          url: 'carrinhoContent.php', // Substitua isso pelo caminho correto para o script que retorna o conteúdo do carrinho
          success: function (response) {
            // Exiba o conteúdo atual do carrinho
            $('#carrinho-content').html(response);
          },
          error: function () {
            console.error('Erro ao obter conteúdo do carrinho');
          }
        });
      }
    });
  </script>


  <script>
    $(document).ready(function () {
      // Função para atualizar o conteúdo do contêiner do carrinho de compras
      function updateShoppingCartContent() {
        $.ajax({
          type: 'GET',
          url: 'confirmarPedido.php', // Substitua pelo caminho correto para o seu script
          success: function (response) {
            // Atualize o conteúdo do contêiner do carrinho de compras
            $('#shopping-cart-container').html(response);
          },
          error: function () {
            console.error('Erro ao atualizar o conteúdo do carrinho de compras');
          }
        });
      }

      // Chame a função para carregar inicialmente o conteúdo do carrinho de compras
      updateShoppingCartContent();

      // Adicione esta parte para atualizar o conteúdo do carrinho após adicionar um produto
      $('#btnAdicionarPedido').click(function (e) {
        e.preventDefault();
        var produtoId = <?php echo $id; ?>;

        adicionarAoCarrinho(produtoId);

        // Atualize o conteúdo do contêiner do carrinho de compras
        updateShoppingCartContent();
      });

      // ... (seus outros scripts) ...
    });
  </script>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
    integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>