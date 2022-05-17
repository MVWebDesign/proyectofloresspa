<?php 
include("bdConect.php");
$fecha = $_POST['fechaCDos'];
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------actualización de ingreso de datos de la compra------------------------
if (
    strlen($fecha)>0 &&
    isset($_POST["nombreP"]) &&
    isset($_POST["precioP"]) &&
    isset($_POST["cantidad"]) &&
    isset($_POST["invertido"]) 
    ){
    $conexion->query("UPDATE tcompras SET
    Fecha = '$fecha',
    Cantidad = '".$_POST["cantidad"]."',
    PrecioC = '".$_POST["precioP"]."',
    Invertido = '".$_POST["invertido"]."',
    TProductos_id = '".$_POST["nombreP"]."'
    WHERE 
    id = ".$_REQUEST["id"]." 
    ");
    mysqli_close($conexion);
    include("modificarCompra.php");
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
    isset($_POST["fechaC"]) &&
    isset($_POST["nombreP"]) &&
    isset($_POST["precioP"]) &&
    isset($_POST["cantidad"]) &&
    isset($_POST["invertido"])
    ){
    $conexion->query("UPDATE tcompras SET
        Fecha = '".$_POST["fechaC"]."',
        Cantidad = '".$_POST["cantidad"]."',
        PrecioC = '".$_POST["precioP"]."',
        Invertido = '".$_POST["invertido"]."',
        TProductos_id = '".$_POST["nombreP"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarCompra.php");
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
    include("modificarCompra.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
        </script>
    <?php
}
?>