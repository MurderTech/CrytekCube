<?php
    session_start(); require_once("class/usuario.php");
    $obj_usuario = new usuario();

    if (isset($_GET["USER1"])){
        ?>
        <script>
           
        </script>
        <?php
    }
    if (isset($_SESSION["USER"])){
        
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>
<html lang="en">
<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <script src="jquery/jquery-3.3.1.min.js" type="text/javascript"></script>   
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="jquery/recorte/css/imgareaselect-animated.css">
    <link rel="stylesheet" href="jquery/recorte/css/imgareaselect-default.css">
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
                            <div class="col-md-4">
                                <?php
                                echo "<figure>";
                                $foto = $obj_usuario->lee_pic(base64_decode($_GET['USER1']));
                                foreach ($foto as $F){
                                    $PIC = $F['PHOTO'];
                                }
        
                                if (is_file("archivos/perfil/".$PIC.".jpg")){
                                    echo '<img src="archivos/perfil/'.$PIC.'.jpg" class="ppic" id="ppict">';
                                } else {
                                    echo '<img src="archivos/perfil/userdefault.png" class="ppic" id="ppict">';
                                }
                                echo "</figure>";
                                echo "</div>";
        
                                $seguidores = $obj_usuario->calcula_seguidores(base64_decode($_GET['USER1']));
                                if ($seguidores){
                                    foreach($seguidores as $se)
                                        echo '<div class="col-md-4">
                                                <h3 class="followers">Seguidores: '.$se["SEGUIDORES"].'</h3>
                                            </div>';
                                }
                                //sleep(5);
                                
                                $seguidores2 = $obj_usuario->calcula_seguidos(base64_decode($_GET['USER1']));
                                if ($seguidores2){
                                    foreach($seguidores2 as $se)
                                        echo '<div class="col-md-4">
                                                <h3 class="followers">Seguidos: '.$se["SEGUIDOS"].'</h3>
                                            </div>';
                                }
        
                                ?>
                        </div>
                        <hr>
                <?php 

                if($_SESSION['USER'] == base64_decode($_GET['USER1'])){
                    ?>
                       <form action="class/logica.php" method="post" enctype="multipart/form-data" id='formchangepic'>
                        <div class="row">
                        <div class="col-sm-3">
                        <span class="changepic"><label for="file" id="fotonombre">Cambiar Foto</label></span>
                        <span class="file"><input type="file" id="file" name="perfilpic" accept=".jpg"></span>
                        </div>
                        <div class="col-sm-6" id='figurita'>
                        <label id='helpcut' style='display: none;'>Recorte la imagen:</label>
                        <img id='preview' class='preview' style='display: none;'>
                        </div>
                        <div class="col-sm-3">
                        <input type="button" name="changepic" class="btn btn-primary" value="Aceptar" id="recortar">
                        </div>
                        </div>
                        </form>
                        <hr>
                        <?php

                    echo "<h1>".base64_decode($_GET['USER1'])."</h1>";

                    echo '<form action="class/logica.php" method="post" enctype="multipart/form-data">
                        <div class="form-group" id="comparte">
                            <label for="name">Comparte algo:</label>
                            <input type="text" class="form-control" placeholder="Comparte algo con tus amigos" id="name" name="comens">
                            <div id="photos">
                                 <input type="file" id="file" name="photo" accept=".jpg">   
                            </div><br>
                        </div>
                        <input class="btn btn-primary" id="compartir" type="submit" name="compartir" value="Compartir">
                    </form>';
                } else {
                    echo "<h1>".base64_decode($_GET['USER1'])."</h1>";
                    
                    $seguir = $obj_usuario->consulta_amigo($_SESSION['USER'], base64_decode($_GET['USER1']));
                    
                    if($seguir){
                        echo '<form action="class/logica.php?AMG='.base64_decode($_GET['USER1']).'" method="post" enctype="multipart/form-data">
                        <input class="btn btn-primary" id="compartir" type="submit" name="seguiroNo" value="Dejar de Seguir">
                        <input type="hidden" name="noseguir" value"noseguir">
                        </form>';
                    } else {
                        echo '<form action="class/logica.php?AMG='.base64_decode($_GET['USER1']).'" method="post" enctype="multipart/form-data">
                        <input class="btn btn-primary" id="compartir" type="submit" name="seguiroNo" value="Seguir">
                        <input type="hidden" name="seguir" value"seguir">
                        </form>';   
                    }
                } ?>
                        <hr><hr>
                        <?php
                            
                            $publicacion = $obj_usuario->listar_pubxuser(base64_decode($_GET['USER1']));
                        
                        
                            if ($publicacion){
                                foreach($publicacion as $pub){
                                    if($pub['PHOTO'] != ""){ //publicacion con foto.
                                        echo "<h2>".$pub['USUARIO']."<h2><h5>Ha compartido una foto el ".$pub['FECHA']."</h5><br>";
                                        echo "<img src='".$pub['PHOTO']."' id='imgpub' style='width: 100%; border-radius: 10px;'>";
                                        echo "<h5>".$pub['COMENS']."<h5>";
                                        if ($pub['USUARIO'] == $_SESSION['USER']){
                                            echo "<a href='class/logica.php?IDEL=".$pub['ID']."&PIC=".$pub['PHOTO']."'><img src='archivos/icono/borrar.png' style='width:25px;heigth: 25px;'></a>";
                                        }
                                        echo "<br><hr>";
                                    }else{ //publicacion sin foto.
                                        echo "<h2>".$pub['USUARIO']."<h2><h5>Ha compartido un estado el ".$pub['FECHA']."</h5><br>";
                                        echo "<input type='text' readonly id='comenpub' value='".$pub['COMENS']."'>";
                                        if ($pub['USUARIO'] == $_SESSION['USER']){
                                            echo "<a href='class/logica.php?IDEL=".$pub['ID']."'><img src='archivos/icono/borrar.png' style='width:25px;heigth: 25px;'></a>";
                                        }
                                        echo "<br><hr>";
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
    <script src="jquery/recorte/js/jquery.imgareaselect.js"></script>
    <script type="application/javascript">
    jQuery('input[type=file]').change(function(){
     var filename = jQuery(this).val().split('\\').pop();
     var idname = jQuery(this).attr('id');
     console.log(jQuery(this));
     console.log(filename);
     console.log(idname);
     //$('#fotonombre').text(filename);
    $('#helpcut').fadeIn('slow');
    $('#preview').fadeIn('10000');
    });
    </script>
    
    <script type="text/javascript" lenguage="javascript">
        var x1=0, y1=0, x2=0, y2=0, anc=0, alt=0;
        
        $('#preview').imgAreaSelect({
            aspectRatio: '1:1',
            handles: true,
            fadeSpeed: 300,
            onSelectEnd: function(img, sel){
                x1 = sel.x1;
                y1 = sel.y1;
                x2 = sel.x2;
                y2 = sel.y2;
                anc = sel.width;
                alt = sel.height;
            }
        });
        
        $('#recortar').on('click', function(){
            if (anc == 0 || alt == 0) return;
            //alert("Dizque guarda");
            var Imagen = $("#preview").attr("src");
            var conW = $("#figurita").width();
            var conH = $("#figurita").height();
            
            var img = new Image();
            img.src = Imagen;

          
              var imgSize = {
                 w: img.width,
                 h: img.height
              };
            
            $.ajax({
                url:'class/logica.php',
                type:'POST',
                data:{
                    'x1':x1,
                    'y1':y1,
                    'x2':conW,
                    'y2':conH,
                    'anc':anc,
                    'alt':alt,
                    'imagen': Imagen,
                    'w':imgSize.w,
                    'h':imgSize.h
                },
                success: function(){
                    location.reload();
                    //alert('Salio bien');
                }, Error: function(){
                    //alert("Revento");
                    //alert('No mando a la BD');
                }
            });
        });

        function init() {
          var inputFile = document.getElementById('file');
          inputFile.addEventListener('change', mostrarImagen, false);
        }

        function mostrarImagen(event) {
          var file = event.target.files[0];
          var reader = new FileReader();
          reader.onload = function(event) {
            var img = document.getElementById('preview');
            img.src= event.target.result;
          }
          reader.readAsDataURL(file);
        }

        window.addEventListener('load', init, false);
    </script>
    
</body>
</html>
<?php
} else {
    printf("No hay una sesión activa.<br> <a href='index.php'>Iniciar Sesión</a>");  
}                              
?>