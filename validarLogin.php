<?php
$usuario = $_POST['usuario']; 
$contrasena = $_POST['contrasena'];
session_start();
$_SESSION['usuario'] = $usuario;

include('bdConect.php');

$consulta = "SELECT*FROM tadministradores WHERE NombreUsuario = '$usuario' and Contrasena = '$contrasena'";
$resultado = mysqli_query($conexion,$consulta);

$filas = mysqli_num_rows($resultado);
if($filas){
    header("location:modulos.php");
    
}else {
    ?>
    <?php
    include("login.html");
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire('Fallo al iniciar sesión')
    </script>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>