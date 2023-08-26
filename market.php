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

</head>
<body>

  <?php
  menu();
  $_SESSION['seguimento'] = $_GET['seguimento'];                        
  ?>

  <form action="" method="GET" enctype="multipart/form-data">
    <div class="Market_PC">

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Nome", "NPS", { role: "style" } ],

            <?php

            $comando = $pdo->prepare('SELECT * FROM tb_cliente where cli_seguimento = :s order by cli_nps DESC limit 10');
            $comando->bindValue(":s",$_SESSION['seguimento']);
            $comando->execute();

            while($dados_seguimento = $comando->fetch(PDO::FETCH_ASSOC))
            {
              $nome = $dados_seguimento['cli_nome'];
              $nps = $dados_seguimento['cli_nps'];

              ?>

              ["<?php echo $nome ?>", <?php echo $nps ?>, "#ffd432"],


            <?php } ?>

            ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
           { calc: "stringify",
           sourceColumn: 1,
           type: "string",
           role: "annotation" },
           2]);

          var options = {
            title: "<?php echo $_SESSION['seguimento']; ?>",
            width: 1500,
            height: 880,
            bar: {groupWidth: "80%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
        }
      </script>
      <div id="columnchart_values" style="width: 1500px; height: 880px;"></div>
    </div>
    <div class="Market_Celular">

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Nome", "NPS", { role: "style" } ],

            <?php

            $comando = $pdo->prepare('SELECT * FROM tb_cliente where cli_seguimento = :s order by cli_nps DESC limit 5');
            $comando->bindValue(":s",$_SESSION['seguimento']);
            $comando->execute();


            while($dados_seguimento = $comando->fetch(PDO::FETCH_ASSOC))
            {
              $nome = $dados_seguimento['cli_nome'];
              $nps = $dados_seguimento['cli_nps'];

              ?>

              ["<?php echo $nome ?>", <?php echo $nps ?>, "#ffd432"],


            <?php } ?>

            ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
           { calc: "stringify",
           sourceColumn: 1,
           type: "string",
           role: "annotation" },
           2]);

          var options = {
            title: "<?php echo $_SESSION['seguimento']; ?>",
            width: 360,
            height: 200,
            bar: {groupWidth: "50%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
          chart.draw(view, options);
        }
      </script>
      <div id="columnchart_values2" style="width: 360px; height: 200px;"></div>

    </div>
    <?php

    $comando = $pdo->prepare('SELECT * FROM tb_cliente where cli_seguimento = :s order by cli_nps DESC limit 5');
    $comando->bindValue(":s",$_SESSION['seguimento']);
    $comando->execute();
    ?>
    <div class="tabela_market_pc">
      <table class="table">
        <thead>
          <tr>

            <th>#</th>
            <th>Empresa</th>
            <th>NPS</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $contador=1; 
          while($dados_clientes = $comando->fetch(PDO::FETCH_ASSOC))
          {
            echo "<tr>";
            echo '<td>'.$contador++.'</td>';
            echo "<td><a href='CORE.php?pesquisa=".$dados_clientes['cli_nome']."'>".$dados_clientes['cli_nome']."</a></td>";
            echo "<td>".$dados_clientes['cli_nps']."</td>";
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