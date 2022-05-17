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
$ver = mysqli_query($conexion, "SELECT * FROM tclientes WHERE id = ".$_REQUEST['id']." ");
$conexion = $ver->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualización del Cliente</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
</head>
<body>
    <nav class="topnav" id="myTopnav">
        <a href="regClientes.php">Registro de Cliente</a>
        <a href="clientes.php">Clientes</a>
        <a href="modulos.php">Inicio</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i></a>
    </nav>
    <div class="registration-form">
        <form action="actualizarCliente.php" method="post">
            <h2>Actualizar cliente</h2>
            <div class="form-group">
                <input type="hidden" class="form-control item" require name="id"
                value="<?php if(isset($conexion['id'])): echo $conexion['id']; endif; ?>">
                <input type="text" class="form-control item" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" maxlength="30" name="nombre"
                value="<?php if(isset($conexion['NombreCliente'])): echo $conexion['NombreCliente']; endif; ?>" 
                title="Nombre(s)">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" maxlength="30" name="apellido"
                value="<?php if(isset($conexion['ApellidoCliente'])): echo $conexion['ApellidoCliente']; endif; ?>" 
                title="Apellido(s)">
            </div>
            <div class="form-group">
                <input type="number" class="form-control item" id="uno" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="telefono"
                value="<?php if(isset($conexion['NumeroTelefono'])): echo $conexion['NumeroTelefono']; endif; ?>" 
                title="Teléfono">
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" pattern="^[a-zA-ZÀ-ÿ0-9_\u00f1\u00d1]+([.][a-zA-ZñÑ0-9_]+)*@[a-zA-ZñÑ0-9_]+([.][a-zA-ZñÑ0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="40" id="email" name="correo"
                value="<?php if(isset($conexion['Correo'])): echo $conexion['Correo']; endif; ?>" 
                title="Correo">
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
    <script type="text/javascript">
		// Initialize our function when the document is ready for events.
		jQuery(document).ready(function(){
			// Listen for the input event.
			jQuery("#uno").on('input', function (evt) {
				// Allow only numbers.
				jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
			});
		});
	</script>
</body>
</html>
