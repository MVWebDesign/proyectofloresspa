<?php 
include('bdConect.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}

if (isset($_REQUEST["id"])) {
    $conexion->query("DELETE FROM tclientes 
    WHERE id = ".$_REQUEST["id"]." ");
    mysqli_close($conexion);
    include("clientes.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Se EliminĂ³ el Cliente Correctamente!',
                showConfirmButton: false,
                timer: 1500})
            </script>
            <?php
}else{
    mysqli_close($conexion);
    include("clientes.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'No se encontrĂ³ la consulta!'})
        </script>
    <?php
}
?>