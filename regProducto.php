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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Producto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="regProducto.php">Registro de Producto</a>
        <a href="inventario.php">Inventario</a>
        <a href="modulos.php">Inicio</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>
    <div class="registration-form">
        <form action="validarProducto.php" method="post" enctype="multipart/form-data">
            <h2>Registrar nuevo producto</h2>
            <div class="form-group">
                <input type="number" class="form-control item" required id="uno" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="stock" placeholder="Stock del Producto">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" required name="nombreP" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" maxlength="45" placeholder="Nombre del Producto">
            </div>
            <div class="form-group">
                <input type="file" class="form-control item" required name="Imagen">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" required pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" maxlength="15" name="marca" placeholder="Marca">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" required pattern="^[a-zA-Z0-9À-ÿ\u00f1\u00d1]+(\s*[a-zA-Z0-9À-ÿ\u00f1\u00d1]*)*[a-zA-Z0-9À-ÿ\u00f1\u00d1]+$" maxlength="60" name="contenido" placeholder="Descripción del Producto" >
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" required id="dos" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio" placeholder="Precio">
            </div>
            <div class="form-group">
                <select class="form-control selected" required name="proveedor">
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tproveedores");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["Correo"]."</option>";
                    }
                    ?>
                </select>
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
		// Initialize our function when the document is ready for events.
		jQuery(document).ready(function(){
			// Listen for the input event.
			jQuery("#uno, #dos").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
	</script>
</body>
</html>
