<nav class=" navbar-expand-lg purple-bar d-flex" >
  
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto order-0 ">
      <li class="nav-item princ ">
        <a class="nav-link princ" href="index.php">HOME</a>
      </li>
      <li class="nav-item princ">
        <a class="nav-link princ" href="metricas.php">MÉTRICAS</a>
      </li>
      <li class="nav-item princ">
        <a class="nav-link princ" href="http://www.mesquita.rj.gov.br/">VOLTAR AO SITE PMM</a>
      </li>
      

      <li class="nav-item princ">
         
    <?php  
        if(isset($_SESSION['email']) && $permissao == 0) {
           echo '<a href="pagina-usuario.php" class="nav-link princ" >ENVIAR REQUERIMENTOS</a>';
        }else if($permissao == 1 || $permissao == 2){
            echo '<a href="admin.php" class="nav-link princ">PÁGINA DO ADMINISTRADOR</a>';
        } else {
            echo '<a href="newlogin.php" class="nav-link princ">FAÇA LOGIN</a>';
        }
    ?>
    </li>
    <li class="nav-item">
      <?php
            if(isset($_SESSION['email'])) 
            {
            echo '<a href="sair.php" class="nav-link princ"  >SAIR</a>';
            }
        ?>
      </li>

    </ul>
  </div>
</nav>