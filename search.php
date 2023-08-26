<?php
include('menu.php');
include('conexao.php');
include('script.php');
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

  <title>SmartWan - Resulado da Busca NPS</title>
</head>
<body>

  <?php
  script();
  menu();
  ?>

  <form action="" method="POST" enctype="multipart/form-data">

    <?php
    $pesquisa = $_POST['pesquisa'];
    $comando = $pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome = :n");
    $comando->bindValue(":n",$pesquisa);
    $comando->execute();

    $dados_clientes = $comando->fetch(PDO::FETCH_ASSOC);

    if(empty($dados_clientes))
    {
      $comando = $pdo->prepare("INSERT INTO tb_cliente(cli_nome) VALUES (:c)");
      $comando->bindValue(":c",$pesquisa);
      $comando->execute(); 
    }

    $comando = $pdo->prepare("SELECT * FROM tb_cliente WHERE MATCH (cli_nome,cli_seguimento) AGAINST(:n)");
    $comando->bindValue(":n",$pesquisa);
    $comando->execute();   

    ?>
    <div class="tabela_ranking">
      <table class="table">
        <thead>
          <tr>
            <th>Empresa</th>
            <th>NPS</th>
          </tr>
        </thead>
        <tbody>

          <?php
          while($dados_clientes = $comando->fetch(PDO::FETCH_ASSOC))
          {
            echo "<tr>";
            echo "<td><a href='CORE.php?pesquisa=".$dados_clientes['cli_nome']."'>".$dados_clientes['cli_nome']."</a></td>";
            echo "<td>".$dados_clientes['cli_nps']."</td>";
            echo "</tr>";

          }
          ?>
        </tbody>
      </table>
    </div>
  </form>
</body>
</html>