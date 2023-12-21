<?php
include '../config/conexao.php';
session_start();

if (!isset($_SESSION)) {
    header("location:../index.php");
    die;
}

$sql = "SELECT * FROM produto";
$query = mysqli_query($conexao, $sql);
$contagem = mysqli_num_rows($query);

$sql2 = "SELECT * FROM usuario";
$query2 = mysqli_query($conexao, $sql2);
$contagem2 = mysqli_num_rows($query2);

$sql3 = "SELECT * FROM pedido";
$query3 = mysqli_query($conexao, $sql3);
$contagem3 = mysqli_num_rows($query3);





// Verifica se o formulário de edição foi enviado
if (isset($_POST['atualizar-produto'])) {
    $edit_id = $_POST['edit_id'];
    $edit_nome_produto = mysqli_real_escape_string($conexao, $_POST['edit_nome_produto']);
    $edit_descricao = mysqli_real_escape_string($conexao, $_POST['edit_descricao']);
    $edit_preco = $_POST['edit_preco'];

    $edit_imagem = $_POST['edit_imagem'];

    // Atualiza o produto no banco de dados
    $update_sql = "UPDATE produto SET nome_produto='$edit_nome_produto', descricao='$edit_descricao', preco='$edit_preco' WHERE id_produto='$edit_id'";


    $update_query = mysqli_query($conexao, $update_sql);

    // Verifica se a atualização foi bem-sucedida e define a mensagem de sessão
    if ($update_query) {
        $_SESSION['title'] = 'Produto atualizado com sucesso';
        $_SESSION['icon'] = 'success';
    } else {
        $_SESSION['title'] = 'Erro ao atualizar o produto';
        $_SESSION['icon'] = 'error';
    }
    // Redireciona de volta para a página
    header("location: index.php");
    die;
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .border-green {
            border-bottom: 4px solid green;
        }

        .border-blue {
            border-bottom: 4px solid blue;
        }

        .border-red {
            border-bottom: 4px solid red;
        }
    </style>
</head>

<body>


    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>


    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gerenciamento</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../usuario/sair.php">Sair</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Pedidos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main class="container mt-5">
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



        <div class="bg-body-tertiary p-5 rounded">
            <h1>Controle administrativo</h1>

            <!-- Cards for user management, product management, and orders -->
            <div class="row mt-4">
                <!-- User Management Card -->
                <div class="col-md-4">
                    <div class="card shadow p-3 mb-5 bg-white rounded border-green">
                        <div id="card1" class="card-body">
                            <h5 class="card-title">Usuários Cadastrados</h5>
                            <p class="card-text">Total:
                                <?php echo $contagem2 ?>
                            </p>
                            <i class="bi bi-person-fill fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>

                <!-- Product Management Card -->
                <div class="col-md-4">
                    <div class="card shadow p-3 mb-5 bg-white rounded border-blue">
                        <div id="card2" class="card-body">
                            <h5 class="card-title">Produtos</h5>
                            <p class="card-text">Total:
                                <?php echo $contagem ?>
                            </p>
                            <i class="bi bi-box fs-1 text-success"></i>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="col-md-4">
                    <div class="card shadow p-3 mb-5 bg-white rounded border-red">
                        <div id="card3" class="card-body">
                            <h5 class="card-title">Pedidos</h5>
                            <p class="card-text">Total:
                                <?php echo $contagem3 ?>
                            </p>
                            <i class="bi bi-cart fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container mt-2">
        <div class="bg-transparent shadow p-5 rounded">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@getbootstrap">Cadastrar Produto</button>

            <h5 class="text-center text-white">Tabela de Produtos</h5>
            <table class="table table-hover table-striped table-shadow">
                <thead class="table-header">
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php
                    $sql = "SELECT * FROM  produto";
                    $query = mysqli_query($conexao, $sql);
                    while ($dados = mysqli_fetch_assoc($query)) {
                        $id = $dados['id_produto'];
                        $produto = $dados['nome_produto'];
                        $descricao = $dados['descricao'];
                        $img = $dados['imagem'];
                        $preco = $dados['preco'];




                        ?>
                        <tr>
                            <td>
                                <?php echo $produto ?>
                            </td>
                            <td>
                                <?php echo $descricao ?>
                            </td>
                            <td class="">
                                <img class="rounded-circle" src="<?php echo $img ?>" alt="Product Image" height="80px">
                            </td>
                            <td>
                                <?php echo $preco ?>
                            </td>

                            <td>
                                <a class="btn btn-outline-success" href="admin.php" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?php echo $id ?>"
                                    onclick="preencherModalEdicao(<?php echo $id ?>, '<?php echo addslashes($produto) ?>', '<?php echo addslashes($descricao) ?>', '<?php echo addslashes($img) ?>', '<?php echo $preco ?>')">Editar</a>
                                <a class="btn btn-outline-danger" href="admin.php?excluir=<?php echo $id ?>">Excluir</a>
                            </td>

                            <!-- ... -->
                            <div class="modal fade" id="editModal<?php echo $id ?>" tabindex="-1"
                                aria-labelledby="editModalLabel<?php echo $id ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-body-tertiary">
                                            <h1 class="modal-title fs-5" id="editModalLabel<?php echo $id ?>">Editar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php" enctype="multipart/form-data">
                                                <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $id ?>">
                                                <div class="mb-3">
                                                    <label for="edit_nome_produto" class="col-form-label">Produto:</label>
                                                    <input type="text" class="form-control" name="edit_nome_produto"
                                                        id="edit_nome_produto" value="<?php echo $produto ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit_descricao" class="col-form-label">Descrição:</label>
                                                    <input type="text" class="form-control" name="edit_descricao"
                                                        id="edit_descricao" value="<?php echo $descricao ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit_imagem" class="col-form-label">Imagem:</label>
                                                    <img src="<?php echo $img ?>" alt="Product Image"
                                                        id="edit_imagem_preview" style="max-width: 100%;">
                                                    <input type="file" class="form-control" name="edit_imagem"
                                                        id="edit_imagem">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit_preco" class="col-form-label">Preço:</label>
                                                    <input type="text" class="form-control" name="edit_preco"
                                                        id="edit_preco" value="<?php echo $preco ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Fechar</button>
                                                    <input type="submit" name="atualizar-produto" class="btn btn-primary"
                                                        value="Atualizar">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-body-tertiary">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="admin.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Produto:</label>
                            <input type="text" class="form-control" name="nome_produto"
                                placeholder="Insira o nome do produto" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Descrição:</label>
                            <input type="text" class="form-control" name="descricao"
                                placeholder="Insira a descrição do produto" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Imagem:</label>
                            <input type="file" class="form-control" name="imagem">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Preço:</label>
                            <input type="text" class="form-control" name="preco" placeholder="Insira o preço do produto"
                                id="recipient-name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" name="cadastrar-produto" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Função JavaScript para preencher o modal de edição com os dados existentes
        function preencherModalEdicao(id, produto, descricao, imagem, preco) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nome_produto').value = produto;
            document.getElementById('edit_descricao').value = descricao;
            document.getElementById('edit_imagem_preview').src = imagem; // Atualiza a imagem
            document.getElementById('edit_preco').value = preco;
            // Adicione aqui o código para preencher os outros campos conforme necessário
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>