<?php session_start();
require_once("class/usuario.php");
if (isset($_SESSION["USER"])){
?>
<html lang="en">
<head>
   <script src="jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .bg-default {
            background-color: #E0E2DB;
        }
        .grayscale { filter: grayscale(100%); }
        .contrast { filter: contrast(160%); }
    </style>
</head>
<body class="bg-default">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <a href="inicio.php"><img src="imagenes/cube-outline.png" id="logoini"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="inicio.php">CrytekCube</a>
      </li>
      <li class="nav-item">
        <?php 
          
            echo '<a class="nav-link" href="perfiluser.php?USER1='.base64_encode($_SESSION["USER"]).'">'.$_SESSION["NOMBRE"].'</a>';
        
        ?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?inst=logout">Cerrar Sesion</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="perfilbusca.php" method="post">
      <input class="form-control mr-sm-2" type="search" placeholder="Busca a alguien" aria-label="Search" name="BUSCA">
      <button class="btn btn-primary" type="submit" name="buscador">Buscar</button>
    </form>
  </div>
</nav>
   
    <div class="container" style="padding-top: 10%; padding-bottom: 10%;">
        <div class="row pt-5">
            <div class="col-lg-12 col-md- ml-auto mr-auto">
                <div class="card border-bottom" id="panel">
                    <div class="card-body" style="text-align: left !important;">
                        <div class="row">
                            <div class="col-md-3">
                                <img src='archivos/perfil/userdefault.png' class='ppic'>
                            </div>
                        </div>
                        
                            <div class="form-group" id="comparte">
                                <?php
                                    echo "<h1>Mostrando resuldados para:</h1><br>
                                    <label class='resultlabel'>'".$_REQUEST['BUSCA']."'</label><br>";
                                ?>
                            </div>
                            
                        
                        <hr><hr>
                        <?php
                            $obj_usuario = new usuario();
                            
                            $usuario = $obj_usuario->listar_buscaUser($_REQUEST['BUSCA']);
                        
                            if ($usuario){
                                ?>
                                <div class="row" id='titlediv'>
                                    <div class="col-4">
                                        <label class='usertitle' style='margin-top: 15%;'>Foto de Perfil</label>
                                    </div>
                                    <div class="col-4">
                                        <label class='usertitle' style='margin-top: 15%'>Usuario</label>
                                    </div>
                                    <div class="col-4">
                                        <label class='usertitle' style='margin-top: 15%'>Nombre</label>
                                    </div>
                                </div>
                                <?php
                                foreach($usuario as $pub){
                                    echo "<a href='perfiluser.php?USER1=". base64_encode($pub['usuario'])."'>
                                            <div class='row' id='userdiv'>
                                                <div class='col-sm-4'>";
                                    if (is_file("archivos/perfil/".$pub['photo'].".jpg")){
                                    echo "                    <img src='archivos/perfil/".$pub['photo'].".jpg' class='ppicresult'>";
                                    } else {
                                    echo "                    <img src='archivos/perfil/userdefault.png' class='ppicresult'>";             
                                    }
                                    echo "      </div>
                                                <div class='col-sm-4'>
                                                        <label class='user' style='margin-top: 15%'>".strtoupper($pub['usuario'])."</label>
                                                </div>
                                                <div class='col-sm-4'>
                                                        <label class='user' style='margin-top: 15%'>".strtoupper($pub['nombre'])."</label>
                                                </div>
                                            </div>
                                        </a><br>";
                                }
                            }
                        ?>
                    </div>    
                </div>                
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>  
</body>
</html>
<?php
} else {
    printf("No hay una sesión activa.<br> <a href='index.php'>Iniciar Sesión</a>");  
}                              
?>