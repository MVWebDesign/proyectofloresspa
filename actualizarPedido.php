<?php 
include("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------actualización de ingreso de datos de la producto------------------------
if (
    isset($_POST["cantidad"]) &&
    isset($_POST["fechaP"]) &&
    isset($_POST["estado"]) &&
    isset($_POST["producto"]) 
    ){
    $conexion->query("UPDATE tpedidos SET
        Cantidad = '".$_POST["cantidad"]."',
        FechaEntrega = '".$_POST["fechaP"]."',
        Estado = '".$_POST["estado"]."',
        TProductos_id = '".$_POST["producto"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarPedido.php");
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Datos Actualizados Correctamente!',
            showConfirmButton: false,
            timer: 1500})
        </script>
        <?php
}else{
    mysqli_close($conexion);
    include("modificarPedido.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
        </script>
    <?php
}
?>