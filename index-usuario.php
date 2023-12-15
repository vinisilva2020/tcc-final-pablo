<?php
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
    * {
      font-family: sans-serif;
    }

    .hero {
      background-image: url('como-comecar-seu-blog-de-comida-.png');
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
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="quitutes.png" alt="" width="80"> <span>
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
            <a class="nav-link" href="#">Página Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="usuario/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>
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
            <h2 class="p-2">Cardapio</h2>
            <p>No quitutes da vivi, não apenas alimentamos o corpo, mas também nutrimos a alma com o prazer de uma
              refeição extraordinária. A sua jornada gastronômica começa aqui, e estamos ansiosos para torná-la
              inesquecível. Agradecemos por escolher o nosso restaurante, onde cada refeição é uma celebração do sabor e
              da excelência culinária. Bom apetite!</p>
            <a href="" class="btn btn-dark mt-5">Visualizar</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
          <div class="section-img">
            <img src="quitutes.png" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-12 mt-md-5">
          <div class="about-text mt-lg-5">
            <h2 class="p-2">Cardapio</h2>
            <p>No quitutes da vivi, não apenas alimentamos o corpo, mas também nutrimos a alma com o prazer de uma
              refeição extraordinária. A sua jornada gastronômica começa aqui, e estamos ansiosos para torná-la
              inesquecível. Agradecemos por escolher o nosso restaurante, onde cada refeição é uma celebração do sabor e
              da excelência culinária. Bom apetite!</p>
            <a href="" class="btn btn-dark mt-5">Visualizar</a>
          </div>
        </div>
      </div>

    </div>
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
          <div class="text-center pb-5">
            <h2>Cadastre-se no nosso site </h2>
            <p>Para realizar pedidos no nosso sistema você deve realizar primeiro o seu cadastro</p>
          </div>
        </div>
      </div>
      <div class="row m-0">
        <div class="col-md-12 p-0 pt-4 p-4 pb-4">
          <form action="usuario/usuario.php" method="post" class="bg-light p-4 m-auto">
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
              <input type="submit" class="btn btn-success btn-lg btn-block mt-3"></input>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script>


    $(document).ready(function () {
      $('#telefone').mask('(00) 0000-0000');
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