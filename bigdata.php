<?php
include('menu.php');
include('conexao.php');
include('script.php');
include('procedimentos.php');
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
  <?php
  menu();
  $pesquisa = $_GET['pesquisa'];
  ?>
  <form action="" method="GET" enctype="multipart/form-data">

    <?php
    $comando = $pdo->prepare("SELECT * FROM tb_cliente where cli_nome = :n");
    $comando->bindValue(":n",$pesquisa);
    $comando->execute();
    $dados_clientes = $comando->fetch(PDO::FETCH_ASSOC)
    ?>
    <div class="display_bigdata">
      <?php
      echo '<div class="BIGDATA_DADOS">'.$dados_clientes['cli_nome'].'</div>';
      echo '<div class="BIGDATA_DADOS"><a href="MARKET.php?seguimento='.$dados_clientes["cli_seguimento"].'">'.$dados_clientes["cli_seguimento"].'</a></div>';
      echo '<div class="BIGDATA_DADOS">NPS '.number_format($dados_clientes['cli_nps'],1).'</div>';
      ?>
    </div>
    <div class="tabela_bigdata">
      <table class="table">
        <thead>
          <tr>
            <th>Empresa</th>
            <th>Nota</th>
            <th>data</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $comando = $pdo->prepare("SELECT * FROM tb_avaliacao where ava_cliente = :n order by ava_data desc LIMIT 10");
          $comando->bindValue(":n",$pesquisa);
          $comando->execute();
          while($dados_clientes = $comando->fetch(PDO::FETCH_ASSOC))
          {
            echo "<tr>";
            echo "<td>".$dados_clientes['ava_cliente']."</td>";
            echo "<td>".$dados_clientes['ava_nota']."</td>";
            echo "<td>".$dados_clientes['ava_data']."</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
    script();
    ?>  
  </form>
</body>
</html>