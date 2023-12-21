<?php

include '../config/conexao.php';

session_start();

if (isset($_SESSION)) {
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE id_usuario = '$id'";
    $query = mysqli_query($conexao, $sql);

    $usuario = mysqli_fetch_assoc($query);

    $nome = $usuario['nome'];
    $senha = $usuario['senha'];
    $email = $usuario['email'];
    $telefone = $usuario['telefone'];
    $endereco = $usuario['endereco'];

} else {
    header("location:../index.php");
    die;
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .header-section {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        hr {
            border-top: 1px solid #dee2e6;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>

    </style>
</head>

<body>

    <div class="container-fluid py-3">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Início</a></li>
                        <li class="breadcrumb-item"><a href="pedidos.php">Pedidos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
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

                <div class="card mb-4">
                    <div class="card-header">
                        Informações do Usuário
                    </div>
                    <form action="usuario.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nome de Usuário</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id_usuario" value="<?php echo $id ?>">
                                    <input class="form-control" value="<?php echo $nome ?>" name="nome" type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Senha</p>
                                </div>
                                <div class="col-sm-9">

                                    <input class="form-control" value="<?php echo $senha ?>" name="senha" type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">E-mail</p>
                                </div>
                                <div class="col-sm-9">

                                    <input class="form-control" value="<?php echo $email ?>" name="email" type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Telefone</p>
                                </div>
                                <div class="col-sm-9">

                                    <input class="form-control" value="<?php echo $telefone ?>" name="telefone"
                                        type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Endereço</p>
                                </div>
                                <div class="col-sm-9">

                                    <input class="form-control" value="<?php echo $endereco ?>" name="endereco"
                                        type="text">
                                </div>
                            </div>
                            <input class="btn mt-3  btn-primary" type="submit" name="editar-usuario">
                            
                    <button type="button" class="btn mt-3 btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Excluir sua conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar sua conta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="usuario.php">
          <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" id="recipient-name">
            <input class="btn btn-danger" type="submit" value="Excluir sua conta" name="excluir">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>