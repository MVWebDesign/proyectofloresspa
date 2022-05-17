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
echo '<script>window.location="pruebaDos.php"</script>';
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
<title>Tutorial | Carro de Compra Simple con PHP y MySQL</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="width:800px;">
<h3 align="center">Carro de Compra Simple con PHP y MySQL</h3>
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
<div class="thumbnail">
<img style="width:80px; height:80px;" src="<?php echo $row["Imagen"]; ?>" />
<div class="caption">
<h4 class="text-info text-center"><?php echo $row["NombreProducto"]; ?></h4>
<h4 class="text-danger text-center">$ <?php echo $row["Precio"]; ?></h4>
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
<div style="clear:both"></div>
<h3>Detalle de la orden</h3>
<div class="table-responsive">
<table class="table table-bordered">
<tr>
<th width="40%">Descripción</th>
<th width="10%" class='text-center'>Cantidad</th>
<th width="20%" class='text-right'>Precio</th>
<th width="15%" class='text-right'>Total</th>
<th width="5%"></th>
</tr>
<?php
if(!empty($_SESSION["shopping_cart"]))
{
$total = 0;
foreach($_SESSION["shopping_cart"] as $keys => $values)
{
?>
<tr>
<td><?php echo $values["item_name"]; ?></td>
<td class='text-center'><?php echo $values["item_quantity"]; ?></td>
<td class='text-right'>$ <?php echo $values["item_price"]; ?></td>
<td class='text-right'>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
<td><a href="pruebaDos.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Eliminar</span></a></td>
</tr>
<?php
$total = $total + ($values["item_quantity"] * $values["item_price"]);
}
?>
<tr>
<td colspan="3" align="right">Total</td>
<td align="right">$ <?php echo number_format($total, 2); ?></td>
<td></td>
</tr>
<?php
}
?></table>
</div>
</div>
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