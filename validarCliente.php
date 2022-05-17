<?php
require_once("bdConect.php");
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}
//---------------------------validación de ingreso de datos del cliente------------------------
$telefonoA = $_POST['telefono'];
$correoA = $_POST['correo'];
// comprovar telefono
$consulta = "SELECT*FROM tclientes WHERE NumeroTelefono = '$telefonoA'";
$resultado = mysqli_query($conexion,$consulta);
$filas = mysqli_num_rows($resultado);
// comprovar correo
$consulta2 = "SELECT*FROM tclientes WHERE Correo = '$correoA'";
$resultado2 = mysqli_query($conexion,$consulta2);
$filas2 = mysqli_num_rows($resultado2);
if( 
    isset($_POST["nombre"]) &&
    isset($_POST["apellido"]) &&
    isset($_POST["telefono"]) != $filas &&
    isset($_POST["correo"]) != $filas2
){
    $conexion->query("INSERT INTO tclientes(NombreCliente, ApellidoCliente, NumeroTelefono, Correo ) 
    VALUES(
            '".$_POST["nombre"]."',
            '".$_POST["apellido"]."',
            '".$_POST["telefono"]."',
            '".$_POST["correo"]."'
        )");
        include("regClientes.php");
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
}elseif ($filas || $filas2){
    if ($filas) {
    ?> <?php
    include("regClientes.php");
    ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'El teléfono ingresado ya existe!'})
        </script>
    <?php 
    }elseif($filas2){
    ?> <?php
    include("regClientes.php");
    ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'El correo ingresado ya existe!'})
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
}
mysqli_free_result($resultado);
mysqli_free_result($resultado2);
mysqli_close($conexion);
?>