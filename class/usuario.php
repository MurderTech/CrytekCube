<?php 

require_once('modeloPF.php');

class usuario extends modeloCredencialesBD{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function crear_usuario($Nombre, $Usuario, $Pass){
        parent::__construct();
        $instruccion = "CALL sp_crear_usuario('".$Nombre."', '".$Usuario."', '".$Pass."')";
        $realizado=$this->_db->query($instruccion);
       echo $instruccion;
        echo $realizado;
     if($realizado){
        return "ok";   
     }
        else
            return "error";
    }
    
    public function login($Usuario, $Pass){
        parent::__construct();
        $pass = hash('md5', $Pass);
        
        $instruccion = "CALL sp_login('".$Usuario."', '".$pass."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
     if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
         } else {
     }
            
    }
    
    public function subir_pub($Usuario, $Comen, $Photo){
        parent::__construct();
        $instruccion = "CALL sp_subir_pub('".$Usuario."', '".$Comen."', '".$Photo."')";
        $realizado=$this->_db->query($instruccion);
    }
    
    public function listar_pub($user){
        parent::__construct();
        $instruccion = "CALL sp_listar_pub('".$user."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }

    }
    
    public function listar_pubxuser($user){
        parent::__construct();
        $instruccion = "CALL sp_listar_pubxuser('".$user."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }

    }
    
    public function listar_buscaUser($user){
        parent::__construct();
        $instruccion = "CALL sp_buscar_usuario('".$user."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }

    }
    
    public function calcula_seguidos($user){
        parent::__construct();
        $instruccion = "CALL sp_seguidos('".$user."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }

    }
    
    public function calcula_seguidores($user){
        parent::__construct();
        $instruccion = "CALL sp_seguidores('".$user."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }

    }
    
    public function consulta_amigo($user, $amigo){
        parent::__construct();
        $instruccion = "CALL sp_consulta_amigo('".$user."', '".$amigo."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }

    }
    
    public function agregar_amigo($user, $amigo){
        parent::__construct();
        $instruccion = "CALL sp_agregar_amigo('".$user."', '".$amigo."')";
        $realizado=$this->_db->query($instruccion);
       echo $instruccion;
        echo $realizado;
     if($realizado){
        return "ok";   
     }
        else
            return "error";
    }
    
    public function eliminar_amigo($user, $amigo){
        parent::__construct();
        $instruccion = "CALL sp_eliminar_amigo('".$user."', '".$amigo."')";
        $realizado=$this->_db->query($instruccion);
       echo $instruccion;
        echo $realizado;
     if($realizado){
        return "ok";   
     }
        else
            return "error";
    }
    
    public function borrar_pub($IDE){
        parent::__construct();
        $instruccion = "CALL sp_borrar_pub('".$IDE."')";
        $realizado=$this->_db->query($instruccion);
       echo $instruccion;
        echo $realizado;
     if($realizado){
        return "ok";   
     }
        else
            return "error";
    }
    
    public function changepic($pic, $usr){
        parent::__construct();
        $instruccion = "CALL sp_changepic('".$pic."','".$usr."')";
        $realizado = $this->_db->query($instruccion);
        if($realizado){
        return "ok";   
        }else
        return "error:" . $this->_db->error;
    }
    
    public function lee_pic($usr){
        parent::__construct();
        $instruccion = "CALL sp_lee_pic('".$usr."')";
        $consulta = $this->_db->query($instruccion);
        $realizado = $consulta->fetch_all(MYSQLI_ASSOC);
        if($realizado){
            return $realizado;
            $realizado->close();
            $this->$_db->close();
        } else {
        
        }
    }
    
}

?>