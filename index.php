<?php
session_start();
include("bdConect.php");
if(isset($_POST["add_to_cart"]))
{
if(isset($_SESSION["shopping_cart"]))
{
$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
if(!in_array($_GET["id"], $item_array_id))
{
$count = count($_SESSION["shopping_cart"]);
$item_array = array(
'item_id' => $_GET["id"],
'item_name' => $_POST["hidden_name"],
'item_price' => $_POST["hidden_price"],
'item_quantity' => $_POST["quantity"]
);
$_SESSION["shopping_cart"][$count] = $item_array;
}
else
{
echo '<script>alert("El producto ya se encuentra agregado")</script>';
 
}
}
else
{
$item_array = array(
'item_id' => $_GET["id"],
'item_name' => $_POST["hidden_name"],
'item_price' => $_POST["hidden_price"],
'item_quantity' => $_POST["quantity"]
);
$_SESSION["shopping_cart"][0] = $item_array;
}
}
if(isset($_GET["action"]))
{
if($_GET["action"] == "delete")
{
foreach($_SESSION["shopping_cart"] as $keys => $values)
{
if($values["item_id"] == $_GET["id"])
{
unset($_SESSION["shopping_cart"][$keys]);
echo '<script>window.location="index.php"</script>';
}
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/productos.css">
    <link rel="stylesheet" href="css/tableStyles.css">
    <script src="https://kit.fontawesome.com/c02881bd13.js" crossorigin="anonymous"></script> 
</head>
<body>
    <nav class="topnav" id="myTopnav">
      <a href="index.php">Inicio</a>
      <a href="#products">Productos</a>
      <a href="#contactanos">Contáctanos</a>
      <a href="#direccion">Dirección</a>
      <a class="panel" href="login.html">Panel de Administrador <span style="font-weight: 600;" class="icon-lock"></span></a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i></a>
  </nav>
  <div class="block">
    <!-- <img loading="lazy" src="archivos/logoSpa.svg"> -->
  </div>
  <div id="products" class="titulo-p">
    <h2>Productos</h2>
  </div>


<div class="container-article">
<?php
$query = "SELECT * FROM tproductos ORDER BY id ASC";
$result = mysqli_query($conexion, $query);
if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
?>
<div class="col-md-4">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?action=add&id=<?php echo $row["id"]; ?>">
<div class="box-article">
<img style="width:120px; height:120px;" src="<?php echo $row["Imagen"]; ?>" />
<div class="caption">
<h4 class="text-white text-center"><?php echo $row["NombreProducto"]; ?></h4>
<h5 class="text-white text-center"><?php echo $row["Descripcion"]; ?></h5>
<h4 class="text-black text-center">$ <?php echo $row["Precio"]; ?></h4>
<input type="number" name="quantity" class="form-control" value="1" />
<p class='text-center'>
<input type="submit" name="add_to_cart" class="btn btn-success " value="Agregar al carro" /></p>
<input type="hidden" name="hidden_name" value="<?php echo $row["NombreProducto"]; ?>" />
<input type="hidden" name="hidden_price" value="<?php echo $row["Precio"]; ?>" />
</div>
</div>
</form>
</div>
<?php
}
}
?>
</div>
<div class="container" style="width:800px;">
<div style="clear:both"></div>
<div class="orden">
<h3>Detalles del Pedido</h3>
</div>
<div>
<div class="table-responsive-vertical">
<table class="table table-bordered table-striped table-hover table-mc-light-blue">
<thead>
<tr>
<th>Tipo de Pago</th>
<th>Descripción</th>
<th class='text-center'>Cantidad</th>
<th class='text-right'>Precio</th>
<th class='text-right'>Total</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
if(!empty($_SESSION["shopping_cart"]))
{
$total = 0;
foreach($_SESSION["shopping_cart"] as $keys => $values)
{
?>
<tr>
<td data-title='Tipo de Pago'>En Efectivo</td>
<td data-title='Descripcion'><?php echo $values["item_name"]; ?></td>
<td data-title='Cantidad' class='text-right'><?php echo $values["item_quantity"]; ?></td>
<td data-title='Precio' class='text-right'>$ <?php echo $values["item_price"]; ?></td>
<td data-title='Total' class='text-right'>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Eliminar</span></a></td>
</tr>
<?php
$total = $total + ($values["item_quantity"] * $values["item_price"]);
}
?>
<tr>
<td colspan="4" align="right">Total</td>
<td align="right">$ <?php echo number_format($total, 2); ?></td>
<td></td>
</tr>
<?php
}
?>
</tbody>
</table>
<div class="order-container">
      <div class="personal-data">
          <h3>Datos Personales</h3>
      </div>
      <form>
        <div class="form-row">
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Nombre">
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Apellido">
          </div>
          <div class="col-md-6">
            <input type="number" class="form-control" placeholder="Telefono">
          </div>
          <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Correo">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Generar Pedido</button>
      </form>
    </div>
</div>
</div>
</div>

<div id="direccion" class="location">
  <div class="location-info">
    <h2>Donde</h2>
    <h2>Encontrarnos</h2>
  </div>
  <div class="container-fluid">
    <div class="map-responsive">
      <iframe src="https://maps.google.com/maps?q=Jos%C3%A9%20V%C3%A1zquez%20Galv%C3%A1n%20205,%20San%20Francisco,%2048280%20Ixtapa,%20Jal.&t=&z=13&ie=UTF8&iwloc=&output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
  
</div>
    
<!--Footer-->
<footer id="contactanos">
  <div class="container-footer animated">
    <div class="box-footer">
      <div class="logo">
        <img
          src="archivos/logoSpa.png"
          alt=""
        />
      </div>
      <div class="terms">
        <p>
          La tienda flores Spa es un negocio que ha surgido recientemente!
          Ofrecemos diferentes productos de belleza.
        </p>
      </div>
    </div>
    <div class="box-footer">
      <h2>Menú</h2>
      <a href="index.php">Inicio</a>
      <a href="#products">Productos</a>
      <a href="#contactanos">Contáctanos</a>
      <a href="#direccion">Dirección</a>
    </div>

    <div class="box-footer">
      <h2>Contacto</h2>
      <a href="#"> Teléfono</a>
      <a href="#"> Correo</a>
    </div>
  </div>
  <div class="box-copy">
    <hr />
    <p>
      Todos los derechos reservados © 2022
      <b>Desarrollado por Daniel, Marcos y Jaime</b>
    </p>
  </div>
</footer>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/formNav.js"></script>
</body>
</html>
<?php

// Máxima duración de sesión activa en hora
define( 'MAX_SESSION_TIEMPO', 900 * 1 );

// Controla cuando se ha creado y cuando tiempo ha recorrido 
if ( isset( $_SESSION[ 'ULTIMA_ACTIVIDAD' ] ) && 
    ( time() - $_SESSION[ 'ULTIMA_ACTIVIDAD' ] > MAX_SESSION_TIEMPO ) ) {

    // Si ha pasado el tiempo sobre el limite destruye la session
    destruir_session();
}

$_SESSION[ 'ULTIMA_ACTIVIDAD' ] = time();

// Función para destruir y resetear los parámetros de sesión
function destruir_session() {

    $_SESSION = array();
    if ( ini_get( 'session.use_cookies' ) ) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - MAX_SESSION_TIEMPO,
            $params[ 'path' ],
            $params[ 'domain' ],
            $params[ 'secure' ],
            $params[ 'httponly' ] );
    }

    @session_destroy();
}
