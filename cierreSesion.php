<?php
	session_start();
	session_destroy();
	header('Location: /fora/admin.php');
?>
