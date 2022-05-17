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

$consul=("SELECT NumeroFactura FROM tfacturas ORDER BY id DESC LIMIT 1");
$result = $conexion->query($consul);
$row = $result->fetch_array(MYSQLI_ASSOC );
$factura = $row["NumeroFactura"];
$ganTotal = 0;
$valorTicket =  $factura+1;

$conexion->query("INSERT INTO tfacturas(NumeroFactura, GananciaTotal, Fecha)
VALUES(
'$valorTicket',
'$ganTotal',
'$FechaActual'
)");
include("ventas.php");
?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Ticket <?php echo $valorTicket ?> Generado Correctamente!',
            showConfirmButton: false,
            timer: 1500})
        </script>
        <?php
?>