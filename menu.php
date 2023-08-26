<?php
function menu()
{
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php"><img src="img/logo.svg" width="150px" height="60"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/Ranking.php">RANKING<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ferramentas
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/CLOUD.php">MARKET</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/TREND.php">TRENDS</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Português Brasil</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="GET" action="/search.php" enctype="multipart/form-data">
        <input class="form-control mr-sm-2" type="search" autocomplete="off" required minlength="3" maxlength="30" placeholder="Qual empresa?" aria-label="Search" name="pesquisa">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
      </form>
    </div>
  </nav>

  <?php
}
?>