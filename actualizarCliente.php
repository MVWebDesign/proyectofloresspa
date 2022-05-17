<?php 
include("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------actualización de ingreso de datos del cliente------------------------
if (
    isset($_POST["nombre"]) &&
    isset($_POST["apellido"]) &&
    isset($_POST["telefono"]) &&
    isset($_POST["correo"])
    ){
    $conexion->query("UPDATE tclientes SET
        NombreCliente = '".$_POST["nombre"]."',
        ApellidoCliente = '".$_POST["apellido"]."',
        NumeroTelefono = '".$_POST["telefono"]."',
        Correo = '".$_POST["correo"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarCliente.php");
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
    include("modificarCliente.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
        </script>
    <?php
}
?>