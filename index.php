<?php
include('menu.php');
include('conexao.php');
include('script.php');
include('procedimentos.php');
include('rodape.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="A maneira mais rapida de avaliar a qualidade de atendimento de qualquer empresa ou marca!" >
  <meta name="author" content="Wan Matos, SmartWan">
  <meta name="robots" content="index, follow">
  <!-- Bootstrap CSS -->
  <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
  <link rel="stylesheet" href="stylo.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <title>SmartWan - Avaliar Empresas - NPS Grátis</title>
</head>
<body>
  <?php
  menu();
  ?>
  <form action="/search.php" method="POST" enctype="multipart/form-data">
    <div class="logo">
      <center><img src="img/logo.svg" width="500px" alt="LogoMarca"></center>
    </div>

    <div class="pesquisa">
      <input class="form-control" name="pesquisa" autocomplete="off" required minlength="3" maxlength="30" autofocus type="text" placeholder="Qual empresa deseja avaliar?" aria-label=".form-control-lg example">
      <button type="submit"  class="btn btn-primary">Pesquisar</button>
    </div>

    <?php
    script();
    rodape();
    ?> 
  </form>

</body>
</html>