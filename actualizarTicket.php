<?php 
include("bdConect.php");
$fecha = $_POST['fechaTDos'];
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------actualización de ingreso de datos del ticket------------------------
if (
    isset($_POST["numFactura"]) &&
    strlen($fecha) > 0 &&
    isset($_POST["montoTotal"]) 
    ){
    $conexion->query("UPDATE tfacturas SET
        NumeroFactura = '".$_POST["numFactura"]."',
        GananciaTotal = '".$_POST["montoTotal"]."',
        Fecha = '$fecha'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarTicket.php");
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
}elseif (
    isset($_POST["numFactura"]) &&
    isset($_POST["fechaT"]) &&
    isset($_POST["montoTotal"]) 
    ){
    $conexion->query("UPDATE tfacturas SET
        NumeroFactura = '".$_POST["numFactura"]."',
        GananciaTotal = '".$_POST["montoTotal"]."',
        Fecha = '".$_POST["fechaT"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarTicket.php");
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
    include("modificarTicket.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
        </script>
    <?php
}
?>