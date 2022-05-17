<?php
include("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tickets</title>
    <script src="https://kit.fontawesome.com/c02881bd13.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/tableStyles.css">
</head>
<body>
	<nav class="topnav" id="myTopnav">
        <a href="ventas.php">Tickets</a>
        <a href="generarTicket.php">Generar Nuevo Ticket</a>
        <a href="modulos.php">Inicio</a>
        <a class="cl" href="cerrarSesion.php">Cerrar Sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>

        <div>
            <div class="table-responsive-vertical">
            <table class="table table-bordered table-striped table-hover table-mc-light-blue">
            <thead>
            <tr>
            <th>Número de Factura</th>
            <th>Importe Total</th>
            <th>Fecha y Hora de la Factura</th>
            <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
    <?php
     $consulta = $conexion->query("SELECT * FROM tfacturas");       
        while ($row = $consulta->fetch_array()) {
            echo "<tr>";
            echo "<td data-title='Número de Factura'> ".$row["NumeroFactura"]." </td>";
            echo "<td data-title='Importe Total'> ".$row["GananciaTotal"]." </td>";
            echo "<td data-title='Fecha de la Factura'> ".$row["Fecha"]." </td>";
            echo "<td data-title='Acciones'>
            <a style='color: #30AC48; text-decoration:none;' 
            href='regVenta.php?id=".$row["id"]."'> <i class='fa-solid fa-circle-plus' title='Agregar'></i> </a> 
            <a style='color: #E8790A; text-decoration:none;' 
            href='modificarTicket.php?id=".$row["id"]."'> <i class='fa-solid fa-marker' title='Actualizar'></i> </a>
            <a style='color: red; text-decoration:none; 'onclick='return confirmacion()' 
            href='eliminarTicket.php?id=".$row["id"]."'> <i class='fa-solid fa-trash-can' title='Eliminar'></i> </a>
            <a style='color: #0486BA ; text-decoration:none;' 
            href='mostrarVentas.php?NumeroFactura=".$row["NumeroFactura"]."'> <i class='fa-solid fa-eye' title='Mostrar Ventas'></i> </a>
            </td>";
            echo "</tr>";
        }
    ?>
            </tbody>
            </table>
            </div>
            </div>

    <?php
     $consulta = $conexion->query("SELECT * FROM tfacturas ORDER BY NumeroFactura DESC");
        while ($row = $consulta->fetch_array()) {
            echo "<div class='container'>";
            echo "<div class='table-responsive-vertical'>";
            echo "<table class='table table-bordered table-striped table-hover table-mc-light-blue'>";
            echo "<thead>";
           
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        }     
    ?>
    <script>
        function confirmacion(){
        if (confirm("¿Esta seguro(a) de eliminar este registro?")) {
        return true;
        } 
        return false;
        }
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/formNav.js"></script>
</body>
</html>
