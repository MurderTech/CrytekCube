
<?php
session_start();

    require_once("usuario.php");

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

    
    $obj_usuario = new usuario();
    
    if (array_key_exists('creacuenta', $_POST)){
        if (($_REQUEST["name"] <> "") and ($_REQUEST["username"] <> "") and ($_REQUEST["password"] <> "") and ($_REQUEST["password1"] <> "") and 
            ($_REQUEST["password"] == $_REQUEST["password1"])){
            
            
            $pass = hash('md5', $_REQUEST["password"]);
            
            $realizado = $obj_usuario->crear_usuario($_REQUEST["name"], $_REQUEST["username"], $pass);
            if ($realizado == "ok"){
                $_SESSION["RESP"]=$realizado;
                header("Location: ../index.php");
            }else {
                $_SESSION["RESP"]=$realizado;
                header("Location: ../crearcuenta.php");
            }
        } else {
            header("Location: ../crearcuenta.php"); 
        }
    }

    if(array_key_exists('x1', $_POST)){       
        
                    $x1 = $_POST["x1"];
                    $y1 = $_POST["y1"];
                    $x2 = $_POST["x2"];
                    $y2 = $_POST["y2"];
                    $anc = $_POST["anc"];
                    $alt = $_POST["alt"];
                    $img = $_POST["imagen"];
                    $wd  = $_POST["w"];
                    $hg  = $_POST["h"];
        
        echo $x1 ." / ". $y1 ." / ". $x2 ." / ". $y2 ." / ". $anc ." / ". $alt;
        
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $data1 = imagecreatefromstring($data);

        $Destino = imagecreatetruecolor($x2,$y2);
                    
        Imagecopyresized($Destino, $data1, 0, 0, 0, 0, $x2, $y2, $wd, $hg); 
        imagejpeg($Destino, "../archivos/perfil/recortetemp.jpg", 100);
        
        $mnjOrigen = imagecreatefromjpeg("../archivos/perfil/recortetemp.jpg");
        
                    
        $mnjDestino = imagecreatetruecolor($anc, $alt);
        imagecopyresampled(
            $mnjDestino,
            $mnjOrigen,
            0,
            0,
            $x1,
            $y1,
            $anc,
            $alt,
            $anc,
            $alt
        );
        
        $foto = $_SESSION['USER'] . rand(1,1000);
        imagejpeg($mnjDestino, "../archivos/perfil/".$foto.".jpg", 100);
        
        $foto1 = $obj_usuario->lee_pic($_SESSION['USER']);
        foreach ($foto1 as $F){
            $PIC = $F['PHOTO'];
        }
        if ($PIC <> ""){
            $link = "../archivos/perfil/".$PIC.".jpg"; 
            unlink($link);   
        }
        
        
        echo $obj_usuario->changepic($foto ,$_SESSION['USER']);

    }

    if(array_key_exists('compartir', $_POST)){
        if(empty($_FILES['photo']['tmp_name']) && ($_REQUEST["comens"]=='')){
        }else{
        
            if(is_uploaded_file($_FILES['photo']['tmp_name']))
            {
                $nombredirectorio = "archivos/";
                $nombrearchivo = $_FILES['photo']['name'];
                $nombrecompleto = $nombredirectorio . $nombrearchivo;

                if (is_file($nombrecompleto))
                {
                    $mTipo = exif_imagetype($_FILES['photo']['tmp_name']);
                    if (($mTipo != IMAGETYPE_JPEG) && ($mTipo != IMAGETYPE_PNG))
                    {
                        //echo "No es una imagen el archivo seleccionado";
                    } else
                    {
                        $idunico = time();
                        $nombrearchivo = $idunico . "-" . $nombrearchivo;
                        //echo "Archivo repetido, se cambiara el nombre a $nombrearchivo.<br><br>";
                    }
                }
                $mTipo = exif_imagetype($_FILES['photo']['tmp_name']);
                    if (($mTipo != IMAGETYPE_JPEG) && ($mTipo != IMAGETYPE_PNG))
                    {
                        //echo "No es un archivo valido";
                    }else
                    {
                        $fotopub = "../" . $nombredirectorio . $nombrearchivo;
                        move_uploaded_file ($_FILES['photo']['tmp_name'], $fotopub);

                        $realizado = $obj_usuario->subir_pub($_SESSION["USER"], $_REQUEST["comens"], $nombredirectorio . $nombrearchivo);
                        header("Location: ../inicio.php");

                    }
            }
            else
                $realizado = $obj_usuario->subir_pub($_SESSION["USER"], $_REQUEST["comens"], null);
        }
        header("Location: ../inicio.php");
    }

    if(array_key_exists('seguiroNo', $_POST)){
        if(array_key_exists('seguir', $_POST)){
            //insertar registro en amigos
            $obj_usuario->agregar_amigo($_SESSION['USER'], $_GET['AMG']);
            
        }
        if(array_key_exists('noseguir', $_POST)){
            //quitar registro en amigos
            $obj_usuario->eliminar_amigo($_SESSION['USER'], $_GET['AMG']);
        }
        header("Location: ../perfiluser.php?USER1=".base64_encode($_GET['AMG']));
    }

    if (array_key_exists('IDEL', $_GET)){
        if (array_key_exists('PIC', $_GET)){
            $link = "../".$_GET['PIC']; 
            unlink($link);//borra la imagen del server para liberar memoria
        }
        $obj_usuario->borrar_pub($_GET['IDEL']);
        header("Location: ../inicio.php");
    }


?>