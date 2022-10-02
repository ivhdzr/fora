<?php
	include('server/inc/conexion.php');

	$opt = $_REQUEST['opt'];

	switch($opt) {

		//Dar de baja
		case "1":

			$email = $_REQUEST['email'];

			$sql = "CALL dardebaja('Baja por administrador', '$email', @res)";

			$consulta = $conexion->query($sql);

			if($consulta > 0) {
				header("Location: /fora/moduloAdmin.php");
			} else {
				echo "Error al realizar el proceso. <a href='moduloAdmin.php'>VOLVER</a>";
			}

			break;

		// Borrar registro de bajas
		case "2":

			$id = $_REQUEST['id'];

			$sql = "DELETE FROM baja WHERE id_baja = '$id'";

			$consulta = $conexion->query($sql);

			if($consulta > 0) {
				header("Location: /fora/moduloBajas.php");
			} else {
				echo "Error al realizar el proceso. <a href='moduloAdmin.php'>VOLVER</a>";
			}

			break;

		// Borrar administrador

		case "3":

			$email = $_REQUEST['email'];

			$sql = "DELETE FROM administrador WHERE email = '$email'";

			$consulta = $conexion->query($sql);

			if($consulta > 0) {
				header("Location: /fora/moduloGestion.php");
			} else {
				echo "Error al realizar el proceso. <a href='moduloAdmin.php'>VOLVER</a>";
			}

			break;


	} // fin del switch


?>