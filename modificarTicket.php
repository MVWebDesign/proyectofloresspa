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
$ver = mysqli_query($conexion, "SELECT * FROM tfacturas
WHERE id = ".$_REQUEST["id"]."
");
$con = $ver->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualización de Ticket</title>
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
        <form action="actualizarTicket.php" method="post">
            <h2>Actualizar ticket</h2>
            <div class="form-group">
                <input type="hidden" class="form-control item" require name="id"
                value="<?php if(isset($con['id'])): echo $con['id']; endif; ?>">
                <input type="number" class="form-control item" maxlength="9" readonly name="numFactura"
                value="<?php if(isset($con['NumeroFactura'])): echo $con['NumeroFactura']; endif; ?>" 
                title="Número de la Factura">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control item" id="numeroUno" step="0.1"
                maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()"
                name="montoTotal2" value="<?php if(isset($con['GananciaTotal'])): echo $con['GananciaTotal']; endif; ?>">
                <input type="number" class="form-control item" id="resultado" step="0.1"
                maxlength="9" readonly title="Monto Total" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()"
                name="montoTotal" value="<?php if(isset($con['GananciaTotal'])): echo $con['GananciaTotal']; endif; ?>">
                <input type="number" class="form-control item" id="numeroDos" step="0.1"
                maxlength="9" title="Descuento" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()"
                placeholder="Descuento" name="descuento">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" readonly name="fechaT" value="<?php if(isset($con['Fecha'])): echo $con['Fecha']; endif; ?>" title="Fecha del ticket antigua">
                <input type="datetime-local" class="form-control item" name="fechaTDos" title="Fecha del Ticket">
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
function calcular(){
            try {
                var num1 = parseFloat(document.getElementById("numeroUno").value) || 0,
                    num2 = parseFloat(document.getElementById("numeroDos").value) || 0;
                    document.getElementById("resultado").value=num1-num2;
            } catch (e) {}
        }
</script>
<script type="text/javascript">
		// Initialize our function when the document is ready for events.
		jQuery(document).ready(function(){
			// Listen for the input event.
			jQuery("#numeroDos").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
</script>
</html>
