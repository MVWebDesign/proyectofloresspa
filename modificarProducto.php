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
$ver = mysqli_query($conexion, "SELECT * FROM tproductos
LEFT JOIN tinventarios ON tproductos.TInventarios_id = tinventarios.id
WHERE tproductos.id = ".$_REQUEST["id"]."
");
$con = $ver->fetch_assoc();

$ver2 = mysqli_query($conexion, "SELECT * FROM tproductos
LEFT JOIN tproveedores ON tproductos.TProveedores_id = tproveedores.id
WHERE tproductos.id = ".$_REQUEST["id"]."
");
$con2 = $ver2->fetch_assoc();

$ver3 = mysqli_query($conexion, "SELECT * FROM tproductos
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
    <title>Actualización de Producto</title>
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
        <form action="actualizarProducto.php" method="post" enctype="multipart/form-data">
            <h2>Actualizar producto</h2>
            <div class="form-group">
                <input type="hidden" class="form-control item" require name="id"
                value="<?php if(isset($con3['id'])): echo $con3['id']; endif; ?>">
                <input type="hidden" class="form-control item" require name="ids"
                value="<?php if(isset($con['id'])): echo $con['id']; endif; ?>">
                <input type="number" class="form-control item" id="uno" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="stock"
                value="<?php if(isset($con['Stock'])): echo $con['Stock']; endif; ?>"
                placeholder="Stock del Producto">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" maxlength="45" name="nombreP"
                value="<?php if(isset($con['NombreProducto'])): echo $con['NombreProducto']; endif; ?>" 
                title="Nombre del producto">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control item" maxlength="200" name="imagen1"
                value="<?php if(isset($con['Imagen'])): echo $con['Imagen']; endif; ?>">
                <input type="file" class="form-control item" name="Imagen2">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" maxlength="15" name="marca"
                value="<?php if(isset($con['Marca'])): echo $con['Marca']; endif; ?>" 
                title="Marca del producto">
            </div>
            <div class="form-group">
            <input type="text" class="form-control item" pattern="^[a-zA-Z0-9À-ÿ\u00f1\u00d1]+(\s*[a-zA-Z0-9À-ÿ\u00f1\u00d1]*)*[a-zA-Z0-9À-ÿ\u00f1\u00d1]+$" maxlength="60" name="descripcion"
                value="<?php if(isset($con['Descripcion'])): echo $con['Descripcion']; endif; ?>" 
                title="Descripción del producto">
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" id="dos" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio"
                value="<?php if(isset($con['Precio'])): echo $con['Precio']; endif; ?>" title="Precio del Producto"
                placeholder="Precio del Producto">
                <input type="hidden" class="form-control item" require name="idStock"
                value="<?php if(isset($con['id'])): echo $con['id']; endif; ?>">
            </div>
            <div class="form-group">
                <select class="form-control selected" name="proveedor" title="Cliente">
                    <option value="<?php if(isset($con2['id'])): echo $con2['id']; endif; ?>">
                    <?php if(isset($con2['Correo'])): echo "".$con2["Correo"].""; endif; ?></option>
                    <?php
                    $consulta = $conexion->query("SELECT * FROM tproveedores");
                    while ($row = $consulta->fetch_array()) {
                        echo "<option value='".$row["id"]."'>".$row["Correo"]."</option>";
                    }
                    ?></select>
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
			jQuery("#uno, #dos").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
</script>
</html>
