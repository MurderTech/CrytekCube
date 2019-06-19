<?php
    if (session_start()){
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="animated.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery/jquery-3.3.1.min.js" type="text/javascript"></script> 
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
</head>
<body>
 
   <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <img id="menusito2" src="./imagenes/reanudar.png">
        </li>
    </ul>
    </nav>
   
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-6 col-md-12 ml-auto mr-auto">
                <div class="card border-bottom" id="panel">
                    <div class="card-body">
                        <img src="./imagenes/cube-outline.png" id="logo">
                        <h5 class="card-title" id="tittle">CrytekCube</h5>
                        <form action="class/logica.php" method="post">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" placeholder="Introduzca su nombre" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre de Usuario</label>
                            <input type="text" class="form-control" placeholder="Introduzca su nombre de usuario" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Introduzca una contraseña" name="password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Vuelva a introducir la contraseña" name="password1">
                        </div>
                        <button class="btn btn-primary" id="login" type="submit" name="creacuenta">Crear Cuenta CrytekCube</button>
                    </form>
                    </div>
                </div>                
            </div>
        </div>
    </div> 
</body>
<script>
    
$(document).ready(function(){
    function animateCss(element, animationName, callback) {
    node = document.querySelector(element)
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
    }
      
    $("#menusito2").click(function(){
        animateCss('#frame', 'bounceOutLeft',()=>{$('#frame').hide();
                                                  animateCss('#loginIn', 'bounceInRight');
                                                  $('#loginIn').show();
                                                 });
     });
    
   });
    
</script>
</html>