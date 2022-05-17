<?php
include('bdConect.php'); 
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/tableStyles.css">
</head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="clientes.php">Clientes</a>
        <a href="regClientes.php">Registro de Cliente</a>
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
            <th>Nombres </th>
            <th>Apellidos </th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
    <?php
     $consulta = $conexion->query("SELECT * FROM tclientes");       
     while ($row = $consulta->fetch_array()) {
            echo "<tr>";
            echo "<td data-title='Nombres'> ".$row["NombreCliente"]." </td>";
            echo "<td data-title='Apellidos'> ".$row["ApellidoCliente"]." </td>";
            echo "<td data-title='Telefono'> ".$row["NumeroTelefono"]." </td>";
            echo "<td data-title='Correo'> ".$row["Correo"]." </td>";
            echo "<td data-title='Acciones'>
            <a style='color: #E8790A; text-decoration:none;' 
            href='modificarCliente.php?id=".$row["id"]."'> <i class='fas fa-marker' title='Actualizar'></i> </a>   
            <a style='color: red;'onclick='return confirmacion()' 
            href='eliminarCliente.php?id=".$row["id"]." '> <i class='fas fa-trash-alt' title='Eliminar'></i> </a>
                </td>";
            echo "</tr>";
     }
    ?>
            </tbody>
            </table>
            </div>
            </div>
    <script>
        	function confirmacion(){
        		if (confirm("¿Esta seguro(a) de eliminar este registro?")) {
        			return true;
        		} return false;
        	}
  </script>
     
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/formNav.js"></script>
</body>
</html>
