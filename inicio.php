<?php session_start(); require_once("class/usuario.php");
if (isset($_SESSION["USER"])){
?>
<html lang="en">
<head>EvalError
   <script src="jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("h2").click(function(evento){
                var userlist = ($(this).text());
                
                
                
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Inicio</title>
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
        <a class="nav-link" href="inicio.php">CrytekCube<span class="sr-only">(current)</span></a>
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
      <button class="btn btn-primary" type="submit" name="buscador">Buscar</button>x
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
                                <label for="name">Comparte algo:</label>
                                <input type="text" class="form-control" placeholder="Comparte algo con tus amigos" id="name" name="comens">
                            
                                <div id='photos'>
                                     <input type="file" id="file" name="photo" accept=".jpg">   
                                </div><br>
                            </div>
                            <input class="btn btn-primary" id="compartir" type="submit" name="compartir" value="Compartir">
                        </form>
                        <hr><hr>
                        <?php
                            $obj_usuario = new usuario();
                            
                            $publicacion = $obj_usuario->listar_pub($_SESSION['USER']);
                        
                            if ($publicacion){
                                $idinc = 0;
                                foreach($publicacion as $pub){
                                    $user = base64_encode($pub['USUARIO']);
                                    echo "<a href='perfiluser.php?USER1=".$user."'>";
                                        if (is_file("archivos/perfil/".$pub['PIC'].".jpg")){
                                        echo "                    <img src='archivos/perfil/".$pub['PIC'].".jpg' class='ppicresult'>";
                                        } else {
                                        echo "                    <img src='archivos/perfil/userdefault.png' class='ppicresult'>";
                                        }
                                        echo "</a>";
                                    if($pub['PHOTO'] != ""){ //publicacion con foto.
                                        
                                        echo "<a href='perfiluser.php?USER1=".$user."'><h2 id='".$idinc."'>".$pub['USUARIO']."</h2></a><h5>Ha compartido una foto el ".$pub['FECHA']."</h5><br>";
                                        echo "<img src='".$pub['PHOTO']."' id='imgpub' style='width: 100%; border-radius: 10px;'>";
                                        echo "<h5>".$pub['COMENS']."<h5>";
                                        if ($pub['USUARIO'] == $_SESSION['USER']){
                                            echo "<a href='class/logica.php?IDEL=".$pub['ID']."&PIC=".$pub['PHOTO']."'><img src='archivos/icono/borrar.png' style='width:25px;heigth: 25px;'></a>";
                                        }
                                        echo "<br><hr>";
                                    }else{ //publicacion sin foto.
                                        echo "<a href='perfiluser.php?USER1=".$user."'><h2>".$pub['USUARIO']."<h2></a><h5>Ha compartido un estado el ".$pub['FECHA']."</h5><br>";
                                        echo "<input type='text' readonly id='comenpub' value='".$pub['COMENS']."'>";
                                        if ($pub['USUARIO'] == $_SESSION['USER']){
                                            echo "<a href='class/logica.php?IDEL=".$pub['ID']."' ><img src='archivos/icono/borrar.png' style='width:25px;heigth: 25px;'></a>";
                                        }
                                        echo "<br><hr>";
                                    }
                                $idinc++;
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