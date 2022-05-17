<?php
include("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
date_default_timezone_set('America/Mexico_City');
$FechaActual=date("Y-m-d H:i");

$consulta = $conexion->query("SELECT * FROM tproductos
LEFT JOIN tinventarios ON tproductos.TInventarios_id = tinventarios.id");
//---------------------------validación de ingreso de datos de la compra------------------------
while ($row = $consulta->fetch_array()) {
    $valorStock = $row["Stock"];
    $valorEstado = "Pendiente";
    $id = $row["id"];

    $obt = "SELECT * FROM tpedidos
    LEFT JOIN tproductos ON tpedidos.TProductos_id = tproductos.id WHERE Estado = '$valorEstado' AND TProductos_id = '$id'";
    $valor=mysqli_query($conexion,$obt);
    $longitud = mysqli_num_rows($valor);

        if ($valorStock <= 10 && $valorStock > 0 && $longitud == 1) {
        $conexion->query("UPDATE tpedidos SET
                Cantidad = '$valorStock',
                FechaEntrega = '$FechaActual',
                Estado = '$valorEstado',
                TProductos_id = '$id'
            ");
            }elseif ($valorStock <= 10 && $valorStock > 0) {
                $conexion->query("INSERT INTO tpedidos( Cantidad, FechaEntrega, Estado, TProductos_id ) 
                VALUES(
                        '$valorStock',
                        '$FechaActual',
                        '$valorEstado',
                        '$id'
                    )");
                    }
            
    }
    include("pedidos.php");
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Datos Ingre!',
            showConfirmButton: false,
            timer: 1500})
        </script>
        <?php
mysqli_close($conexion);
?>