<?php

require_once "../config/conexion.php";

session_start();


    if(isset($_POST['user']) && isset($_POST['pass'])){
        $username = $_POST['user'];
        $password = sha1($_POST['pass']);


        $q = "SELECT * from usuarios where username = '$username' and password = '$password' and estado = 1";
		$consultaUsuario= mysqli_query($conexion,$q);
		$row = mysqli_fetch_array($consultaUsuario);
        
        if($row == true){
            $rol = $row[4];
            $idMesero = $row[0];
            $_SESSION['idRol'] = $rol;
            $_SESSION['idMesero'] = $idMesero;
            switch($rol){
                case 1:
                echo '<script> alert("Bienvenido Administrador");
				location.href = "../vistas/vistaAdmin/Admin.php"; 
				</script>';
            break;

            case 2:
            	echo '<script> alert("Bienvenido Anfitrion");
				location.href = "../vistas/vistaAnfitrion/Anfitrion.php"; 
				</script>';
            break;

            case 3:
            	echo '<script> alert("Bienvenido Mesero");
				location.href = "../vistas/vistaMesero/Mesero.php"; 
				</script>';
            break;

            case 4:
                echo '<script> alert("Bienvenido Cocinero");
                location.href = "../vistas/vistaCocinero/Cocinero.php"; 
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