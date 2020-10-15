<?php

require_once "../config/conexion.php";

session_start();


    if(isset($_POST['user']) && isset($_POST['pass'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];


        $q = "SELECT * from usuarios where nombre = '$username' and password = '$password'";
		$consultaUsuario= mysqli_query($conexion,$q);
		$row = mysqli_fetch_array($consultaUsuario);
        
        if($row == true){
            $rol = $row[3];
            $idMesero = $row[0];
            $_SESSION['idRol'] = $rol;
            $_SESSION['idMesero'] = $idMesero;
            switch($rol){
                case 1:
                echo '<script> alert("Bienvenido administrador");
				location.href = "../vistas/base.php"; 
				</script>';
            break;

            case 2:
            	echo '<script> alert("Bienvenido anfitrion");
				location.href = "../vistas/base.php"; 
				</script>';
            break;

            case 3:
            	echo '<script> alert("Bienvenido mesero");
				location.href = "../vistas/vistaMesero/Mesero.php"; 
				</script>';
            break;

                default:
            }
        }else{
            // no existe el usuario
            echo '<script> alert("Datos Incorrectos");
			location.href = "../vistas/login.php"; 
			</script>';
        }
        

    }


?>