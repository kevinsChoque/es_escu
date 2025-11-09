<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use DB;

class FcController extends Controller
{
    public function actShowFile_test(Request $r)
    {
        $idCat = $r->idCat;

        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, "Ficha catastral del ID: $idCat");

        // Devuelve el PDF directamente al navegador
        return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf');
    }
    public function actShowFile(Request $r)
    {
        // $f2 = TFormat2::find($idFo2);
        // dd($r->all());
        $cat = DB::table('catastro')->where('idCat', $r->idCat)->first();

        // dd($cat);

        $marco = 1;
    	$smarco = 0;
        $t = 8.1;
        $t = 9;
        $s = 5.4-1.8;
        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
// cabezera
        // $pdf->Image(public_path('img/emusap_logo.png'), 10, 10, 35, 15);

        $pdf->Image(public_path('img/emusap_logo_C.png'), 10, 5, 42, 18);

        $pdf->Image(public_path('img/img1.jpeg'), 144, 0, 66, 33);

        $pdf->Image(public_path('img/img2.jpeg'), 0, 268, 90, 30);

        $pdf->Image(public_path('img/nombre.jpeg'), 78, 12, 48, 9);
// ---

 // --- Marca de agua ---
        // $pdf->SetFont('Arial', 'B', 50);
        // $pdf->SetTextColor(230, 230, 230); // Color gris claro
        // $pdf->RotatedText(35, 190, 'CONFIDENCIAL', 45); // Texto como marca de agua

        // --- Imagen como firma de agua ---
    $pdf->Image(public_path('img/emusap_logo2.png'), 30, 30, 150, 0);

    // $pdf->SetAlpha(0.2); // 0.0 totalmente transparente, 1.0 opaco
    // // $pdf->Image('sello.png', 30, 50, 150);
    // $pdf->Image(public_path('img/emusap_logo.png'), 30, 30, 150, 0, 'PNG');
    // $pdf->SetAlpha(1); // volvemos a normal
    // test
// $pdf->Image(public_path('img/test.jpg'), 10, 190, 60, 99);
if ($cat && $cat->frontis && file_exists(public_path('storage/' . $cat->frontis))) {
    $pdf->Image(public_path('storage/' . $cat->frontis), 10, 190, 60, 99);
} else {
    // Imagen por defecto si no existe
    $pdf->Image(public_path('img/default.png'), 25, 220, 33, 33);
}
// $pdf->Image(public_path('img/test.jpg'), 76, 190, 60, 99);
if ($cat && $cat->agua && file_exists(public_path('storage/' . $cat->agua))) {
    $pdf->Image(public_path('storage/' . $cat->agua), 76, 190, 60, 99);
} else {
    $pdf->Image(public_path('img/default.png'), 91, 220, 33, 33);
}
// $pdf->Image(public_path('img/test.jpg'), 142, 190, 60, 99);
if ($cat && $cat->alc && file_exists(public_path('storage/' . $cat->alc))) {
    $pdf->Image(public_path('storage/' . $cat->alc), 142, 190, 60, 99);
} else {
    $pdf->Image(public_path('img/default.png'), 157, 220, 33, 33);
}
// test
// ---

        $pdf->Cell(190,15,'-',$smarco,1,'C');
        // $pdf->Cell(80,20,'-',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', 12);
        // $pdf->text(90,18,'EMUSAP ABANCAY S.A.');
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->text(81,22,'FICHA CATASTRAL');

        // $pdf->Rect(10, 24.69, 195, 230.1, 'D');
        // $pdf->Rect(10, 254.7, 195, 20, 'D');


// -------------------------
// -------------------------
// -------------------------
        $pdf->ln(0.9);
        // $pdf->SetDrawColor(0, 0, 150); // azul
        // // $pdf->SetFillColor(230, 240, 255);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 25, 190, 5.4, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);
        // $pdf->SetLineWidth(0);
        // Marco externo
// $pdf->SetDrawColor(0, 0, 0);
// $pdf->SetLineWidth(1);
// $pdf->Rect(10, 10, 190, 277, 'D');

// // Marco interno
// $pdf->SetDrawColor(100, 100, 100);
// $pdf->SetLineWidth(0.5);
// $pdf->Rect(15, 15, 180, 267, 'D');


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(27,$s,'Fecha de encuesta:',$smarco,0,'L');
        $pdf->Cell(29,$s,$cat->fechaEnc,$smarco,0,'L');
        $pdf->Cell(35,$s,'Nombre del encuestador:',$smarco,0,'L');
        $pdf->Cell(58,$s,utf8_decode($cat->nombreEnc),$smarco,0,'L');
        $pdf->Cell(27,$s,utf8_decode('Nª de ficha tecnica:'),$smarco,0,'L');
        $pdf->Cell(14,$s,$cat->ficha,$smarco,1,'C');

        $pdf->ln(1.8);

// $pdf->SetFont('Arial', 'B', 12);
// $pdf->SetFillColor(255, 230, 204);   // naranja claro
// $pdf->SetDrawColor(255, 153, 51);    // borde naranja
// $pdf->SetTextColor(102, 51, 0);      // texto marrón
// $pdf->Cell(0, 10, 'ALERTA O SECCION IMPORTANTE', 1, 1, 'C', true);
// ---------------------------------------------------
        $pdf->ln(1.8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 32, 195-5, 20, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190,$s,'1.- DATOS DE CONEXION',$smarco,1,'L');


        $pdf->Cell(55,$s,$cat->u1,$smarco,0,'C');
        $pdf->Cell(85,$s,$cat->u2,$smarco,0,'C');
        $pdf->Cell(50,$s,$cat->u3,$smarco,1,'C');

        $pdf->Cell(55,$s,'Tipo de cliente catastro',$marco,0,'C');
        $pdf->Cell(85,$s,'Situacion de la conexion',$marco,0,'C');
        $pdf->Cell(50,$s,'Condicion de la conexion',$marco,1,'C');

        $pdf->Cell(55,$s,$cat->u4,$smarco,0,'C');
        $pdf->Cell(85,$s,$cat->u5,$smarco,0,'C');
        $pdf->Cell(50,$s,$cat->u6,$smarco,1,'C');

        $pdf->Cell(55,$s,utf8_decode('Nª de inscripcion:'),$marco,0,'C');
        $pdf->Cell(85,$s,'Manzana:',$marco,0,'C');
        $pdf->Cell(50,$s,'Lote:',$marco,1,'C');
        $pdf->ln(1.8);


// -----------------------------------------------------
        $pdf->ln(1.8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 53.7, 195-5, 34.5, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190,$s,'2.- DATOS DEL USUARIO',$smarco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->d1),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->d2),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->d3),$smarco,1,'C');

        $pdf->Cell(55,$s,'Nombre o razon social:',$marco,0,'L');
        $pdf->Cell(85,$s,'Direccion (calle/jiron/av/psj):',$marco,0,'L');
        $pdf->Cell(50,$s,utf8_decode('Nª/Manzana/Lote:'),$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->d4),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->d5),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->d6),$smarco,1,'C');

        $pdf->Cell(55,$s,'Urbanizacion:',$marco,0,'L');
        $pdf->Cell(85,$s,'Departamento:',$marco,0,'L');
        $pdf->Cell(50,$s,'Provincia:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->d7),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->d8),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->d9),$smarco,1,'C');

        $pdf->Cell(55,$s,'Distrito:',$marco,0,'L');
        $pdf->Cell(85,$s,'Tipo de material vivienda:',$marco,0,'L');
        $pdf->Cell(50,$s,'Nª de pisos:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->d10),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->d11),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->d12),$smarco,1,'C');

        $pdf->Cell(55,$s,'Tipo de construccion:',$marco,0,'L');
        $pdf->Cell(85,$s,'Tipo de servicio:',$marco,0,'L');
        $pdf->Cell(50,$s,'Tipo de almacenamiento:',$marco,1,'L');
        $pdf->ln(1.8);

// ---------------------------------------------------------------------------------

        $pdf->ln(1.8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 89.7, 195-5, 38, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190,$s,'3.- DATOS DE CONEXION DE AGUA POTABLE:',$smarco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->t1),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->t2),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->t3),$smarco,1,'C');

        $pdf->Cell(55,$s,'Fecha de ins. de agua:',$marco,0,'L');
        $pdf->Cell(85,$s,'Diametro:',$marco,0,'L');
        $pdf->Cell(50,$s,'Material de conexion:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->t4),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->t5),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->t6),$smarco,1,'C');

        $pdf->Cell(55,$s,'Profundidad(m):',$marco,0,'L');
        $pdf->Cell(85,$s,'Nª de medidor:',$marco,0,'L');
        $pdf->Cell(50,$s,'Marca del medidor:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->t7),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->t8),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->t9),$smarco,1,'C');

        $pdf->Cell(55,$s,'Estado del medidor:',$marco,0,'L');
        $pdf->Cell(85,$s,'Material de tapa:',$marco,0,'L');
        $pdf->Cell(50,$s,'Estado de tapa:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->t10),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->t11),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->t12),$smarco,1,'C');

        $pdf->Cell(55,$s,'Material de la caja:',$marco,0,'L');
        $pdf->Cell(85,$s,'Estado de caja:',$marco,0,'L');
        $pdf->Cell(50,$s,'Ubicacion de conexion:',$marco,1,'L');

        $pdf->Cell(55,$s,'Observaciones:',$marco,0,'L');
        $pdf->Cell(135,$s,utf8_decode($cat->t13),$marco,1,'L');
        $pdf->ln(1.8);
// -------------------------------------------------------

        $pdf->ln(1.8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 129.3, 195-5, 27.3, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190,$s,'4.- DATOS DE CONEXION DE ALCANTARILLADO:',$smarco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->c1),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->c2),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->c3),$smarco,1,'C');

        $pdf->Cell(55,$s,'Fecha de ins. de desague:',$marco,0,'L');
        $pdf->Cell(85,$s,'Diametro:',$marco,0,'L');
        $pdf->Cell(50,$s,'Material de la conexion:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->c4),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->c5),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->c6),$smarco,1,'C');

        $pdf->Cell(55,$s,'Material de la tapa:',$marco,0,'L');
        $pdf->Cell(85,$s,'Estado de tapa:',$marco,0,'L');
        $pdf->Cell(50,$s,'Material de caja:',$marco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->c7),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->c8),$smarco,0,'C');
        $pdf->Cell(50,$s,'',$smarco,1,'C');

        $pdf->Cell(55,$s,'Estado de caja:',$marco,0,'L');
        $pdf->Cell(85,$s,'Ubicacion:',$marco,0,'L');
        $pdf->Cell(50,$s,'',$marco,1,'L');
        $pdf->ln(1.8);
// ------------------------------------------------------------------------------
$pdf->ln(1.8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 158.3, 195-5, 12.6, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190,$s,'5.- UNIDADES DE USO:',$smarco,1,'L');

        $pdf->Cell(55,$s,utf8_decode($cat->ci1),$smarco,0,'C');
        $pdf->Cell(85,$s,utf8_decode($cat->ci2),$smarco,0,'C');
        $pdf->Cell(50,$s,utf8_decode($cat->ci3),$smarco,1,'C');

        $pdf->Cell(55,$s,'Tarifa:',$marco,0,'L');
        $pdf->Cell(85,$s,'Nª de usos:',$marco,0,'L');
        $pdf->Cell(50,$s,'Actividad:',$marco,1,'L');

$pdf->ln(1.8);
// ---------------------------
$pdf->ln(1.8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(.5);         // grosor de línea
        $pdf->Rect(10, 172.6, 195-5, 12, 'DF');
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(0, 0, 0);

        $pdf->Cell(190,$s,'OBSERVACIONES:',$smarco,1,'L');
        $pdf->Cell(190,$s+3.5,utf8_decode($cat->ci4),$smarco,1,'L');

        return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf');
        $pdf->Output();

        exit;
    }
}
