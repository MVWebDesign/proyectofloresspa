<?php
include('bdConect.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}

if (isset($_REQUEST["id"]) &&
    isset($_REQUEST["idT"])
) {
    $conexion->query("DELETE FROM tventas 
    WHERE id = ".$_REQUEST["id"]."");
    mysqli_close($conexion);
    $valor = $_GET["idT"];
    header("location:mostrarVentas.php?NumeroFactura=".$valor);
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Se EliminĂ³ el Ticket Correctamente!',
                showConfirmButton: false,
                timer: 1500})
            </script>
            <?php
}else{
    mysqli_close($conexion);
    include("ventas.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'No se encontrĂ³ la consulta!'})
        </script>
    <?php
}
?>