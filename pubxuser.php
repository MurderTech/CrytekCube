<?php session_start(); require_once("class/usuario.php");?>
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
        <a class="nav-link" href="perfil.php"><?php if(isset($_SESSION["NOMBRE"])){ echo $_SESSION["NOMBRE"]; } else echo"Sin Usuario"; ?><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?inst=logout">Cerrar Sesion</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="pubxuser.php" method="post">
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
                        <form action="class/logica.php" method="post" enctype="multipart/form-data">
                            <div class="form-group" id="comparte">
                                <h1 style="text-align: center;"><?php echo $_REQUEST["BUSCA"]; ?></h1><br>
                                
                            </div>
                        </form>
                        <hr><hr>
                        <?php
                            $obj_usuario = new usuario();
                            
                            $publicacion = $obj_usuario->listar_pubxuser($_REQUEST["BUSCA"]);
                        
                            if ($publicacion){
                                foreach($publicacion as $pub){
                                    if($pub['PHOTO'] != ""){ //publicacion con foto.
                                        echo "<h2>".$pub['USUARIO']."<h2><h5>Ha compartido una foto el ".$pub['FECHA']."</h5><br>";
                                        echo "<img src='".$pub['PHOTO']."' id='imgpub' style='width: 100%; border-radius: 10px;'>";
                                        echo "<h5>".$pub['COMENS']."<h5><br><hr>";
                                    }else{ //publicacion sin foto.
                                        echo "<h2>".$pub['USUARIO']."<h2><h5>Ha compartido un estado el ".$pub['FECHA']."</h5><br>";
                                        echo "<input type='text' readonly id='comenpub' value='".$pub['COMENS']."'><br><hr>";
                                    }
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