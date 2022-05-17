<?php 
include("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------actualización de ingreso de datos del proveedor------------------------

if (
    isset($_POST["nombre"]) &&
    isset($_POST["apellido"]) &&
    isset($_POST["telefono"]) &&
    isset($_POST["direccion"]) &&
    isset($_POST["correo"]) &&
    isset($_POST["empresa"])
    ){
    $conexion->query("UPDATE tproveedores 
    SET
        Nombre = '".$_POST["nombre"]."',
        Apellido = '".$_POST["apellido"]."',
        Telefono = '".$_POST["telefono"]."',
        Direccion = '".$_POST["direccion"]."',
        Correo = '".$_POST["correo"]."',
        Empresa = '".$_POST["empresa"]."'
        WHERE 
        id = ".$_REQUEST["id"]." 
        ");
        mysqli_close($conexion);
        include("modificarProv.php");
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
    include("modificarProv.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Los datos no se actualizaron!'})
        </script>
    <?php
}
?>