<?php
include('bdConect.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Flores SPA</title>
	<link rel="stylesheet" type="text/css" href="css/navbarStyles.css">
</head>
<body>
	<header class="main-header">
    <img class="img-logo" src="archivos/logoSpa.png">
  <a class="main-logo">
    <strong>Flores SPA</strong>
  </a>
  <nav id="nav" class="main-nav">
    <div class="nav-links">
      <a class="link-item" href="clientes.php">Clientes</a>
      <a class="link-item" href="compras.php">Compras</a>
      <a class="link-item" href="ventas.php">Ventas</a>
      <a class="link-item" href="pedidos.php">Pedidos</a>
      <a class="link-item" href="proveedores.php">Proveedores</a>
      <a class="link-item" href="inventario.php">Inventario</a>
      <a class="link-item" href="rpInventario.php">Reportes</a>
      <a class="link-item sesion" href="cerrarSesion.php">Cerrar Sesión</a>
    </div>
  </nav>
  <button id="button-menu" class="button-menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
</header>
<script type="text/javascript" src="js/ham.js"></script>
</body>
</html>