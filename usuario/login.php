<?php
include("conexao/conectar.php");
error_reporting(0);
session_start();
?>
<?php

if (isset($_POST['login'])) {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];


    $sql = "SELECT * FROM usuario WHERE nome ='$usuario';";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $dados = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $dados['senha'])) {
            session_start();
            $_SESSION["id_usuario"] = $dados['id_usuario'];
            $_SESSION["nome"] = $dados['nome'];
            $_SESSION["nivel"] = $dados['nivel'];


            if ($_SESSION['permissao'] == 1) {
                header("location:admin/admin.php");
            } else {
                header("location:index.php");
            }
        }
    } else {
    }
}
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
        .bg-red {
            background-color: #FF0000;
            /* Red background color */
        }

        .btn-white {
            background-color: #FFFFFF;
            /* White button background color */
            color: #FF0000;
            /* Red text color */
        }

        .btn-white:hover {
            background-color: #CCCCCC;
            /* Light gray background color on hover */
        }
    </style>
</head>

<body class="bg-red"> <!-- Add a class for the red background -->
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form action="fazerLogin.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" name="nome" id="username"
                            placeholder="Insira Seu Nome de Usuário">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">senha</label>
                        <input type="password" name="senha" class="form-control" id="password"
                            placeholder="Insira sua senha">
                    </div>
                    <input type="submit" value="Logar" name="fazer-login" class="btn btn-white btn-block">
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>