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
    <title>Ventas</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/tableStyles.css">
</head>
<body>
        <nav class="topnav" id="myTopnav">
            <a href="ventas.php">Tickets</a>
            <a href="modulos.php">Inicio</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i></a>
        </nav>

        <div>
            <div class="table-responsive-vertical">
            <table class="table table-bordered table-striped table-hover table-mc-light-blue">
            <thead>
            <tr>
            <th>Cantidad de Productos</th>
            <th>Tipo de Pago</th>
            <th>Fecha y Hora</th>
            <th>Importe</th>
            <th>Estado</th>
            <th>Cliente</th>
            <th>Producto y Precio</th>
            <th>No. Factura</th>
            <th>Vendedor</th>
            <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
    <?php
      $consulta = $conexion->query("SELECT * FROM tventas 
      LEFT JOIN tclientes ON tventas.TClientes_id = tclientes.id
      LEFT JOIN tproductos ON tventas.TProductos_id = tproductos.id
      LEFT JOIN tfacturas ON tventas.TFacturas_id = tfacturas.id
      LEFT JOIN tadministradores ON tventas.TAdministradores_id = tadministradores.id
      WHERE tventas.TFacturas_id = ".$_REQUEST["NumeroFactura"]." 
      ");
      
      $consulta2 = $conexion->query("SELECT * FROM tventas");       
      while ($row = $consulta->fetch_array() + $row2 = $consulta2->fetch_array()) {
            echo "<tr>";
            echo "<td data-title='Cantidad de Productos'> ".$row["Cantidad"]." </td>";
            echo "<td data-title='Tipo de Pago'> ".$row["TipoPago"]." </td>";
            echo "<td data-title='Fecha y Hora'> ".$row2["Fecha"]." </td>";
            echo "<td data-title='Importe'> ".$row["CantidadPago"]." </td>";
            echo "<td data-title='Estado'> ".$row["Estado"]." </td>";
            echo "<td data-title='Cliente'> ".$row["NombreCliente"]." ".$row["ApellidoCliente"]." </td>";
            echo "<td data-title='Producto y Precio'> ".$row["NombreProducto"]." ".$row["Precio"]." </td>";
            echo "<td data-title='No. Factura'> ".$row["NumeroFactura"]." </td>";
            echo "<td data-title='Vendedor'> ".$row["NombreUsuario"]." </td>";
            echo "<td data-title='Acciones'>
            <a style='color: #E8790A; text-decoration:none;' 
            href='modificarVenta.php?id=".$row2["id"]."'> <i class='fas fa-marker' title='Actualizar'></i> </a>
            <a style='color: red;'onclick='return confirmacion()' 
            href='eliminarVenta.php?id=".$row2["id"]." & idT=".$row["NumeroFactura"]."'> <i class='fas fa-trash-alt' title='Eliminar'></i> </a>
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
