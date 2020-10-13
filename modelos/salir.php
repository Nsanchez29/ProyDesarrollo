<?php

session_start();

session_destroy();

echo '<script> alert("Hasta luego");
			location.href = "../vistas/login.php"; 
			</script>';

die();
?>