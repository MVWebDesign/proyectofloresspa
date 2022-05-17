<?php
require_once("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------validación de ingreso de datos de la compra------------------------
if( 
    isset($_POST["fechaC"]) &&
    isset($_POST["precioC"]) &&
    isset($_POST["cantidad"]) &&
    isset($_POST["invertido"]) &&
    isset($_POST["nombreP"])
){
    $conexion->query("INSERT INTO tcompras( Fecha, Cantidad, PrecioC, Invertido, TProductos_id ) 
    VALUES(
            '".$_POST["fechaC"]."',
            '".$_POST["cantidad"]."',
            '".$_POST["precioC"]."',
            '".$_POST["invertido"]."',
            '".$_POST["nombreP"]."'
        )");
        include("regCompra.php");
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Datos Ingresados Correctamente!',
            showConfirmButton: false,
            timer: 1500})
        </script>
        <?php
}else{
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Fallo al ingresar los datos!'})
        </script>
    <?php
    }
mysqli_close($conexion);
?>