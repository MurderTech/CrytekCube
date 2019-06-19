<?php 
session_start();
?>
 
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="animated.css">
    <script src="jquery/jquery-3.3.1.min.js" type="text/javascript"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
   
    <div id="frame" class="Login">
            
    </div> 
    <div id="loginIn">  
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <h4 id="menusito" style="color:lightgray"><i>Crear una cuenta CrytekCube</i></h4>
            </li>
        </ul>
        </nav>

        
        <div class="container">
            <div class="row pt-5">
                <div class="col-lg-6 col-md-12 ml-auto mr-auto">
                    <div class="card border-bottom" id="panel">
                        <div class="card-body">
                            <img src="./imagenes/cube-outline.png" id="logo">
                            <h1 class="card-title" id="tittle">CrytekCube</h1>
                            <form action="index.php" method="post">
                            <div class="form-group">
                                <label for="name">Nombre de Usuario</label>
                                <input type="text" class="form-control" placeholder="Introduzca su nombre de usuario" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Introduzca su contraseña" id="password" name="pass">
                            </div>
                            <button class="btn btn-primary" id="login" type="submit" name="validalogin">Iniciar Sesion</button>
                        </form>
                        <?php
                            
                            if (isset($_GET['inst'])){
                                if ($_GET['inst'] = 'logout'){
                                    session_destroy();
                                }
                            }

                            require_once("class/usuario.php");

                            $obj_usuario = new usuario();

                            if (array_key_exists('validalogin', $_POST)){

                                $realizado = $obj_usuario->login($_REQUEST["name"], $_REQUEST["pass"]);
                                if ($realizado){
                                    
                                    foreach ($realizado as $dato)
                                    {
                                        $_SESSION["USER"] = $dato["USUARIO"];
                                        $_SESSION["NOMBRE"] = $dato["NOMBRE"];
                                        $_SESSION["ROLL"] = $dato["ROLL"];
                                    }
                                    header("Location: inicio.php");
                                    //echo "ingresando";
                                }
                                else{
                                    echo "Usuario o contraseña incorrecta.";
                                }
                            } else {
                                if (isset($_SESSION["RESP"])){
                                    if ($_SESSION["RESP"]=="ok"){
                                        echo "Usuario creado correctamente. ";
                                    }
                                }
                            }

                        ?> 
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>     
</body>
<script>
  $(document).ready(function(){
    function animateCss(element, animationName, callback) {
    const node = document.querySelector(element)
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
    }
      
     $("#menusito").click(function(){
        
         animateCss('#loginIn', 'rollOut', ()=>{
                        $('#loginIn').hide();
                         $('#frame').load('crearcuenta.php')
                        $('#frame').show();
                        animateCss('#frame', 'rollIn');                                           
                   });
     });
     
   });
    
    
</script>
</html>