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

  <title>Qualidade de Atendimento em NPS</title>
</head>
<body>

  <?php
  menu();                        
  ?>
  <form action="" method="GET" enctype="multipart/form-data">

    <?php

    if(!empty($_GET['pesquisa']))
    {
      $pesquisa = $_GET['pesquisa'];
      $comando = $pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome = :n");
      $comando->bindValue(":n",$pesquisa);
      $comando->execute();

      $resultado = $comando->fetch(PDO::FETCH_ASSOC);
      $_SESSION['cli_id'] = $resultado['cli_id'];
      $_SESSION['cli_nome'] = $resultado['cli_nome'];
      $_SESSION['cli_seguimento'] = $resultado['cli_seguimento'];

      if(!empty($_SESSION['cli_nome'])) 
      {
        echo '<div class="titulo">'.$_SESSION['cli_nome'].'</div>';
        Avaliacao();
        echo '<div class="botao_avaliar"><button type="submit" class="btn btn-primary">Avaliar</button></div>';
      }
      else
      {
        echo '<div class="titulo">'.$pesquisa.'</div>';
        $comando = $pdo->prepare("INSERT INTO tb_cliente(cli_nome) VALUES (:c)");
        $comando->bindValue(":c",$pesquisa);
        $comando->execute();
        Avaliacao();
        $comando = $pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome = :n");
        $comando->bindValue(":n",$pesquisa);
        $comando->execute();

        $resultado = $comando->fetch(PDO::FETCH_ASSOC);

        $_SESSION['cli_id'] = $resultado['cli_id'];
        $_SESSION['cli_nome'] = $resultado['cli_nome'];
        $_SESSION['cli_seguimento'] = $resultado['cli_seguimento'];
        //$estrela = $_GET['estrela'];
        echo '<div class="botao_avaliar"><button type="submit" class="btn btn-primary">Avaliar</button></div>';
      }

    }

    if(!empty($_GET['estrela']))
    {
      $_SESSION['estrela'] = $_GET['estrela'];

      if($_SESSION['estrela'] <4)
      {
        $comando = $pdo->prepare("UPDATE tb_cliente set cli_detratores=cli_detratores+1,cli_quantidade=cli_quantidade+1 where cli_id = :i;");
        $comando->bindValue(":i",$_SESSION['cli_id']);
        $comando->execute();
      }
      else if($_SESSION['estrela']<5)
      {
        $comando = $pdo->prepare("UPDATE tb_cliente set cli_neutros=cli_neutros+1,cli_quantidade=cli_quantidade+1 where cli_id = :i;");
        $comando->bindValue(":i",$_SESSION['cli_id']);
        $comando->execute();
      }
      else
      {
        $comando = $pdo->prepare("UPDATE tb_cliente set cli_promotores=cli_promotores+1,cli_quantidade=cli_quantidade+1 where cli_id = :i;");
        $comando->bindValue(":i",$_SESSION['cli_id']);
        $comando->execute();
      }

      $comando = $pdo->prepare("UPDATE tb_cliente set cli_nps=(((cli_promotores-cli_detratores)/cli_quantidade)*100) where cli_id = :i;");
      $comando->bindValue(":i",$_SESSION['cli_id']);
      $comando->execute();


      $comando = $pdo->prepare("INSERT INTO tb_avaliacao(ava_cliente_id,ava_cliente,ava_seguimento,ava_nota) VALUES (:i,:c,:s,:n)");
      $comando->bindValue(":i",$_SESSION['cli_id']);
      $comando->bindValue(":c",$_SESSION['cli_nome']);
      $comando->bindValue(":s",$_SESSION['cli_seguimento']);
      $comando->bindValue(":n",$_SESSION['estrela']);
      $comando->execute();
    }

    if(!empty($_GET['estrela']))
    {

      $pesquisa = $_SESSION['cli_nome'];

      $comando = $pdo->prepare("SELECT * FROM tb_cliente WHERE cli_nome = :n");
      $comando->bindValue(":n",$pesquisa);
      $comando->execute();
      $resultado = $comando->fetch(PDO::FETCH_ASSOC);
      $_SESSION['cli_id'] = $resultado['cli_id'];
      $_SESSION['cli_nome'] = $resultado['cli_nome'];
      $_SESSION['cli_nps'] = $resultado['cli_nps'];
      $_SESSION['cli_seguimento'] = $resultado['cli_seguimento'];
      $_SESSION['cli_promotores'] = $resultado['cli_promotores'];
      $_SESSION['cli_neutros'] = $resultado['cli_neutros'];
      $_SESSION['cli_detratores'] = $resultado['cli_detratores'];
      ?>

      <div class="dashboard">

        <div class="dash_nome">
          <?php echo '<a href="BIGDATA.php?pesquisa='.$_SESSION["cli_nome"].'">'.$_SESSION["cli_nome"].'</a>'; ?> 
        </div>
        <div class="dash_seguimento">
          <?php echo '<a href="MARKET.php?seguimento='.$_SESSION["cli_seguimento"].'">'.$_SESSION["cli_seguimento"].'</a>'; ?> 
        </div>
        <div class="dash_nps">
          <?php echo "NPS ".$_SESSION['cli_nps']; ?>
        </div>

        <div class="propaganda3_pc">
          <center><a href="/Ranking.php"><img src="img/rank.png" width="881px" height="201"></a></center>
        </div>

      </div>

      <?php
    }
    script();
    ?>  
  </form>
</body>
</html>






