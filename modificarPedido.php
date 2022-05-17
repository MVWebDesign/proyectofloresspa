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
<?php 
$ver = mysqli_query($conexion, "SELECT * FROM tpedidos
LEFT JOIN tproductos ON tpedidos.TProductos_id = tproductos.id
LEFT JOIN tinventarios ON tproductos.TInventarios_id = tinventarios.id
WHERE tpedidos.id = ".$_REQUEST["id"]."
");
$con = $ver->fetch_assoc();

$ver3 = mysqli_query($conexion, "SELECT * FROM tpedidos
WHERE id = ".$_REQUEST["id"]."
");
$con3 = $ver3->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualización de Pedido</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="pedidos.php">Pedidos</a>
        <a href="modulos.php">Inicio</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>
    <div class="registration-form">
        <form action="actualizarPedido.php" method="post">
            <h2>Actualizar pedido</h2>
            <div class="form-group">
                <input type="hidden" class="form-control item" require name="id"
                value="<?php if(isset($con3['id'])): echo $con3['id']; endif; ?>">
                <input type="number" class="form-control item" readonly name="cantidad"
                value="<?php if(isset($con['Cantidad'])): echo $con['Cantidad']; endif; ?>" 
                title="Cantidad de Productos">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" readonly name="fechaP" value="<?php if(isset($con['FechaEntrega'])): echo $con['FechaEntrega']; endif; ?>" title="Fecha de Pedido Antigua">
            </div>
            <div class="form-group">
                <select class="form-control selected" name="estado">
                    <option value="<?php if(isset($con['Estado'])): echo $con['Estado']; endif; ?>"><?php if(isset($con['Estado'])): echo $con['Estado']; endif; ?>
                    </option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Atendido">Atendido</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control selected" readonly name="producto">
                    <option value="<?php if(isset($con['id'])): echo $con['id']; endif; ?>"><?php if(isset($con['NombreProducto'])): echo $con['NombreProducto']; endif; ?></option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="create-account"><span class="icon-refresh"></span>Actualizar
                <span></span><span></span><span></span><span></span>
                </button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/formNav.js"></script>
</body>
<script type="text/javascript">
		// Initialize our function when the document is ready for events.
		jQuery(document).ready(function(){
			// Listen for the input event.
			jQuery("#numeroUno").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
</script>
</html>
