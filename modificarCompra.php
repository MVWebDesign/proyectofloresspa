<?php
include('bdConect.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//error_reporting(0);

?>
<?php 
$ver = mysqli_query($conexion, "SELECT * FROM tcompras
LEFT JOIN tproductos ON tcompras.TProductos_id = tproductos.id
WHERE tcompras.id = ".$_REQUEST["id"]."
");
$con = $ver->fetch_assoc();

$ver3 = mysqli_query($conexion, "SELECT * FROM tcompras
WHERE id = ".$_REQUEST["id"]."
");
$con3 = $ver3->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualización de Compra</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="regCompra.php">Registro de Compra</a>
        <a href="compras.php">Compras</a>
        <a href="modulos.php">Inicio</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>
    <div class="registration-form">
        <form action="actualizarCompra.php" method="post">
            <h2>Actualizar compra</h2>
            <div class="form-group">
                <input type="hidden" class="form-control item" require name="id"
                value="<?php if(isset($con3['id'])): echo $con3['id']; endif; ?>">
                <input type="text" class="form-control item" readonly name="fechaC" value="<?php if(isset($con['Fecha'])): echo $con['Fecha']; endif; ?>" title="Fecha de Compra Antigua">
                <input type="datetime-local" class="form-control item" name="fechaCDos" title="Fecha de Compra">
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" id="numeroDos" step="0.1"
                maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()"
                name="cantidad"
                value="<?php if(isset($con['Cantidad'])): echo $con['Cantidad']; endif; ?>" 
                title="Cantidad">
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" id="numeroUno" step="0.1"
                maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()" name="precioP"
                value="<?php if(isset($con['PrecioC'])): echo $con['PrecioC']; endif; ?>" 
                title="Precio del produto">
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" id="resultado" step="0.1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()" name="invertido"
                value="<?php if(isset($con['Invertido'])): echo $con['Invertido']; endif; ?>" 
                title="Cantidad invertida">
            </div>
            <div class="form-group">
                <select class="form-control selected" name="nombreP">
                    <option value="<?php if(isset($con['id'])): echo $con['id']; endif; ?>"><?php if(isset($con['NombreProducto'])): echo $con['NombreProducto']; endif; ?></option>
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tproductos");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["NombreProducto"]."</option>";
                    }
                    ?>
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
function calcular(){
            try {
                var num1 = parseFloat(document.getElementById("numeroUno").value) || 0,
                    num2 = parseFloat(document.getElementById("numeroDos").value) || 0;
                    document.getElementById("resultado").value=num1*num2;
            } catch (e) {}
        }
</script>

<script type="text/javascript">
		// Initialize our function when the document is ready for events.
		jQuery(document).ready(function(){
			// Listen for the input event.
			jQuery("#numeroUno, #numeroDos").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
</script>
</html>
