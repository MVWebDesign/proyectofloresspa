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
        <a href="regVenta.html">Registro de Venta</a>
        <a href="ventas.php">Ventas</a>
        <a href="modulos.php">Inicio</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>
    <div class="registration-form">
        <form action="validarVenta.php" method="post">
            <h2>Registrar nueva venta</h2>
            <div class="form-group">
                <input type="number" class="form-control item" required id="numeroUno" title="Cantidad de Productos" step="0.01" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()" name="cantidad" placeholder="Cantidad del producto">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" readonly name="tipoPago" title="Tipo de Pago" value="Pago en Efectivo">
            </div>
            <div class="form-group">
                <input type="datetime-local" class="form-control item" required name="fechaV" title="Fecha de Venta">
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" id="resultado" title="Monto a Pagar" readonly step="0.01" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); calcular()" name="monto" placeholder="Cantidad a Pagar">
            </div>
            <div class="form-group">
                <select class="form-control selected" required name="estado">
                    <option value="Espera">En Espera</option>
                    <option value="Vendido">Vendido</option>
                    <option value="Cancelado">Cancelado</option>
                    <option value="Cambio">Cambio de Artículo</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control selected" required name="cliente" title="Cliente">
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tclientes");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["NombreCliente"]." ".$row["ApellidoCliente"]."</option>";
                    }
                    ?></select>
            </div>
            <div class="form-group">
                <select class="form-control selected" id="numeroDos" required name="producto" title="Producto">
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tproductos");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option id='NP' value='".$row["id"]."'>".$row["NombreProducto"]." $".$row["Precio"]."</option>";
                    }
                    ?></select>
            </div>
            <div class="form-group">
                <select class="form-control selected" required name="admin" title="Vendedor(a)">
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tadministradores");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["NombreUsuario"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <?php
                if(isset($_REQUEST["id"])){
                    $consulta = $conexion->query("SELECT * FROM tfacturas WHERE id = ".$_REQUEST["id"]."");
                    while ($row = $consulta->fetch_array()) {
                        echo "<input type='text' class='form-control item' readonly name='numFactura' title'Número de Factura' value='".$row["NumeroFactura"]."'>";
                    }
                }
                ?>
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
