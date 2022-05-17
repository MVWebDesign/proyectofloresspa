<?php
include('bdConect.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
} 
?>
<?php 
$ver = mysqli_query($conexion,"SELECT * FROM tventas 
LEFT JOIN tclientes ON tventas.TClientes_id = tclientes.id
LEFT JOIN tproductos ON tventas.TProductos_id = tproductos.id
LEFT JOIN tfacturas ON tventas.TFacturas_id = tfacturas.id
LEFT JOIN tadministradores ON tventas.TAdministradores_id = tadministradores.id
WHERE tventas.id = ".$_REQUEST["id"]." 
");
$con = $ver->fetch_assoc();

$ver2 = mysqli_query($conexion,"SELECT * FROM tventas 
LEFT JOIN tclientes ON tventas.TClientes_id = tclientes.id
WHERE tventas.id = ".$_REQUEST["id"]." 
");
$con2 = $ver2->fetch_assoc();

$ver3 = mysqli_query($conexion, "SELECT * FROM tventas
WHERE id = ".$_REQUEST["id"]."
");
$con3 = $ver3->fetch_assoc();

$ver4 = mysqli_query($conexion,"SELECT * FROM tventas 
LEFT JOIN tproductos ON tventas.TProductos_id = tproductos.id
WHERE tventas.id = ".$_REQUEST["id"]." 
");
$con4 = $ver4->fetch_assoc();

$ver5 = mysqli_query($conexion,"SELECT * FROM tventas 
LEFT JOIN tfacturas ON tventas.TFacturas_id = tfacturas.id
WHERE tventas.id = ".$_REQUEST["id"]." 
");
$con5 = $ver5->fetch_assoc();

$ver6 = mysqli_query($conexion,"SELECT * FROM tventas 
LEFT JOIN tadministradores ON tventas.TAdministradores_id = tadministradores.id
WHERE tventas.id = ".$_REQUEST["id"]." 
");
$con6 = $ver6->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Venta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="ventas.php">Tickets</a>
        <a href="modulos.php">Inicio</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>
    <div class="registration-form">
        <form action="actualizarVenta.php" method="post">
            <h2>Registrar nueva venta</h2>
            <div class="form-group">
                <input type="hidden" class="form-control item" required name="id"
                value="<?php if(isset($con3['id'])): echo $con3['id']; endif; ?>">
                <input type="hidden" class="form-control item" required name="cantidad2"
                value="<?php if(isset($con['Cantidad'])): echo $con['Cantidad']; endif; ?>">
                <input type="number" class="form-control item" id="numeroUno" title="Cantidad de Productos" step="0.01" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()" name="cantidad" 
                value="<?php if(isset($con['Cantidad'])): echo $con['Cantidad']; endif; ?>"
                title="Cantidad del producto">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" readonly name="tipoPago" title="Tipo de Pago" value="Pago en Efectivo">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" readonly name="fechaV1" value="<?php if(isset($con['Fecha'])): echo $con['Fecha']; endif; ?>" title="Fecha de Venta Antigua">
                <input type="datetime-local" class="form-control item" name="fechaV2" title="Fecha de Venta">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control item" require name="monto2"
                value="<?php if(isset($con['CantidadPago'])): echo $con['CantidadPago']; endif; ?>">
                <input type="number" class="form-control item" id="resultado" title="Monto a Pagar" readonly step="0.01" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()" name="monto"
                value="<?php if(isset($con['CantidadPago'])): echo $con['CantidadPago']; endif; ?>"
                title="Importe"
                >
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control item" required name="estado2"
                value="<?php if(isset($con['Estado'])): echo $con['Estado']; endif; ?>">
                <select class="form-control selected" name="estado">
                    <option value="<?php if(isset($con['Estado'])): echo $con['Estado']; endif; ?>">
                    <?php if(isset($con['Estado'])): echo $con['Estado']; endif; ?>
                    </option>
                    <option value="En Espera">En Espera</option>
                    <option value="Vendido">Vendido</option>
                    <option value="Cancelado">Cancelado</option>
                    <option value="Cambio de Articulo">Cambio de Artículo</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control selected" name="cliente" title="Cliente">
                    <option value="<?php if(isset($con2['id'])): echo $con2['id']; endif; ?>">
                    <?php if(
                    isset($con2['NombreCliente']) &&
                    isset($con2['ApellidoCliente'])): 
                    echo "".$con2["NombreCliente"]." ".$con2["ApellidoCliente"].""; endif; ?></option>
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tclientes");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["NombreCliente"]." ".$row["ApellidoCliente"]."</option>";
                    }
                    ?></select>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control item" required name="producto2"
                value="<?php if(isset($con4['id'])): echo $con4['id']; endif; ?>">
                <select class="form-control selected" id="numeroDos" name="producto" title="Producto">
                <option value="<?php if(isset($con4['id'])): echo $con4['id']; endif; ?>">
                    <?php if(
                    isset($con4['NombreProducto']) &&
                    isset($con4['Precio'])): 
                    echo "".$con4["NombreProducto"]." $".$con4["Precio"].""; endif; ?></option>
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tproductos");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option id='NP' value='".$row["id"]."'>".$row["NombreProducto"]." $".$row["Precio"]."</option>";
                    }
                    ?></select>
            </div>
            <div class="form-group">
                <select class="form-control selected" name="admin" title="Vendedor(a)">
                <option value="<?php if(isset($con6['id'])): echo $con6['id']; endif; ?>">
                    <?php if(
                    isset($con6['NombreUsuario'])): 
                    echo "".$con6["NombreUsuario"].""; endif; ?></option>
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tadministradores");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["NombreUsuario"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" readonly name="numFactura" title="Número de Factura"  
                value="<?php if(isset($con5['NumeroFactura'])): echo $con5['NumeroFactura']; endif; ?>"
                >
            </div>
            <div class="form-group">
                <button type="submit" class="create-account"><span class="icon-plus"></span>Registrar
                <span></span><span></span><span></span><span></span>
                </button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/formNav.js"></script>

    <script type="text/javascript">
        function calcular(){
            try {
                var num1 = parseFloat(document.getElementById("numeroUno").value) || 0;
                var precio = document.getElementById("numeroDos");
                var selected = precio.options[precio.selectedIndex].text;
                var res = selected.replace(/[^0-9]/ig,"");
                    document.getElementById("resultado").value=num1*res;
            } catch (e) {}
        }
    </script>
    <script type="text/javascript">
		// Initialize our function when the document is ready for events.
		jQuery(document).ready(function(){
			// Listen for the input event.
			jQuery("#numeroUno, #dos").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
	</script>


</body>
</html>
