<?php 
include('bdConect.php');
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header("location:404.html");
    die();
}

$query = "SELECT * FROM tproductos WHERE  id = ".$_REQUEST['idprincipal']."";  
$resultado = $conexion->query($query);

$obtC = "SELECT * FROM tcompras WHERE TProductos_id = ".$_REQUEST['idprincipal']."";
$valor=mysqli_query($conexion,$obtC);
$longitud = mysqli_num_rows($valor);

if (isset($_REQUEST["idprincipal"]) &&
    isset($_REQUEST["idStock"])
    ){
    while($ruta=$resultado->fetch_assoc()){
        if ($longitud < 1) {
        $ruta["Imagen"]; /*aqui esta la ruta */
        $borrar=$ruta["Imagen"]; 
        unlink($borrar); 
    

    $conexion->query("DELETE FROM tproductos 
    WHERE id = ".$_REQUEST["idprincipal"]." ");

    $conexion->query("DELETE FROM tinventarios 
    WHERE id = ".$_REQUEST["idStock"]." ");
    
    
    mysqli_close($conexion);
    include("inventario.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Se Eliminó el Producto Correctamente!',
                showConfirmButton: false,
                timer: 1500})
            </script>
            <?php
        }else{
            mysqli_close($conexion);
            include("inventario.php");
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Este producto no puede ser eliminado porque se encuentra en una compra!'})
                </script>
            <?php
        }
    }    
}else{
    mysqli_close($conexion);
    include("inventario.php");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'No se encontró la consulta!'})
        </script>
    <?php
}
?>