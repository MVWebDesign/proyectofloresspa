<?php 
require('fpdf/fpdf.php');
class PDF extends FPDF{
// Cabecera de página
function Header(){
    date_default_timezone_set('America/Mexico_City');
    $FechaActual=date("d/m/Y");
    // Logo
    $this->Image('archivos/logoSpa.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(110);
    // Título
    $this->Cell(60,30,utf8_decode('Productos de Belleza Flores Spa'),0,0,'C');
    $this->SetFont('Arial','',15);
    
    $this->SetFont('Times','B',18);
    $this->Ln(10);
    $this->Cell(170,60,utf8_decode('Reporte de Compras'),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->Cell(75,60,utf8_decode('Fecha:'),0,0,'R');
    $this->SetFont('Arial','I',12);
    $this->Cell(25,60,utf8_decode($FechaActual),0,0,'R');
    // Salto de línea
    $this->Ln(35);
    $this->SetFont('Arial','B',11);
    // Titulos de la tabla
    //$this->SetTextColor(220, 84, 36);
    $this->Cell(40, 10, 'Fecha', 1, 0, 'C', 0);
    $this->Cell(100, 10, 'Producto', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Precio', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Invertido', 1, 0, 'C', 0);
    $this->Cell(50, 10, 'Proveedor', 1, 0, 'C', 0);
    
    $this->Ln(10);
}
// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}
include("bdConect.php");
//$consulta = $conexion->query("SELECT * FROM tcompras");
$consulta = $conexion->query("SELECT * FROM tcompras  
LEFT JOIN tproveedores ON tcompras.TProovedores_id = tproveedores.id");
// Creación del objeto de la clase heredada
$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
while ($row = $consulta->fetch_assoc()) {
$pdf->Cell(40, 10,utf8_decode("$row[Fecha]"), 1, 0, 'C', 0);
$pdf->Cell(100, 10,utf8_decode("$row[NombreProducto]"), 1, 0, 'C', 0);
$pdf->Cell(30, 10, $row['Precio'], 1, 0, 'C', 0);
$pdf->Cell(30, 10, $row['Cantidad'], 1, 0, 'C', 0);
$pdf->Cell(30, 10, $row['Invertido'], 1, 0, 'C', 0);
$pdf->Cell(50, 10, $row['Correo'], 1, 1, 'C', 0);

}
$pdf->Output();
?>

