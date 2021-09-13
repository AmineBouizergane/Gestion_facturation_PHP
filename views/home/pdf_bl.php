<?php

require('tcpdf/tcpdf.php');
class MYPDF extends TCPDF
{
    public function Header()
    {
        $image_file = K_PATH_IMAGES.'logo2.jpg';
        $this->Image($image_file, 10, 0, 190, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

        public function Footer()
    {
        $complex_cell_border = array(
            'T' => array('width' => 0.5, 'color' => array(63,72,204))
         );
         //Where T,B,R, and L are Top, Bottom, Right and Left respectively.
        $this->SetTextColor(63,72,204);
        $this->SetFont('helvetica', '', 10);
        $this->SetY(280);
        $this->Cell(0, 0, 'OMEGAPAVE S.A.R.L au Capital de 2 500 000 DH, Siège Social : Bir Jdid – Maroc, Tél : +212 6 61 29 68 99,',$complex_cell_border, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 10);
        $this->SetY(285);
        $this->Cell(0, 0, 'R.C Casablanca : 335707, N°d’identifiant Fiscal : 15264980, ICE : 001578365000028, Patente N° 37959783,', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 10);
        $this->SetY(290);
        $this->Cell(0, 0, 'CNSS : 4736700 , Email : omegapave.ma@gmail.com, Site web : www.omega-pave.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }







}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(_FILE_) . '/lang/eng.php')) {
    require_once(dirname(_FILE_) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('dejavusans', '', 10);
$pdf->AddPage();

$tbl ='
<table class="first" width="100%"   cellpadding  ="6" >
    <tr align="left">
        <td  width="70%" >
            <table cellpadding  ="6" style="margin-top:30px">
                <tr width="34%">
                    <td>Bon de livraison N° : '.$numero_bl.'</td>
                </tr>
                <tr width="34%">
                    <td>Date de livraison N° : '.date("d/m/Y", $date).'</td>
                </tr >
                
            </table>
        </td>
        <td  width="30%" border="1">
            <table  cellpadding  ="6">
                <tr width="34%" border="1">
                    <td> '.$societe.'</td>
                </tr>
                <tr width="34%">
                    <td align="right"> '.$destination.'</td>
                </tr >
            </table>
        </td>
    </tr>
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');
$tbl = '
<table  width="100%"   cellpadding  ="3">
    <tr align="left">
        <td  width="20%" >Bon de sortie N°:</td>
        <td  width="50%"></td>
        <td  width="15%" >Ref:</td>
        <td  width="15%" >'.$ref.'</td>
    </tr>
</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

$rows = 0;

$tbl = <<<EOF
<table  width="100%"   cellpadding  ="3" align="left">
    <tr align="left" >
        <td  width="20%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;" ><strong>Code Article</strong></td>
        <td  width="50%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"><strong>Designation</strong></td>
        <td  width="15%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"><strong>Unité</strong></td>
        <td  width="15%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"><strong>Quantité</strong></td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Ln(-6);
foreach($det_bl as $k=>$v) {


    $tbl = '
   <table cellspacing="0"    align="left"  >

                 <tr >
                     <td style="width: 20%;border-left:1px solid black;">  '.$v['code_article'].'</td>
                     <td style="width: 50%;border-left:1px solid black;"  align="left">  '.$v['designation'].'</td>
                     <td style="width: 15%;border-left:1px solid black;">  '.$v['unite'].'</td>
                     <td style="width: 15%;border-left:1px solid black;border-right:1px solid black;">  '.$v['qte'].'</td>

                 </tr>

                 </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    $rows++;
    $pdf->Ln(-4);
}


for($i = 0; $i <= (26 - $rows); $i++){


    $tbl = <<<EOD
   <table cellspacing="0"    align="left"  >

                 <tr >
                     <td style="width: 20%;border-left:1px solid black;">                      </td>
                     <td style="width: 50%;border-left:1px solid black;"  align="left">           </td>
                     <td style="width: 15%;border-left:1px solid black;">                           </td>
                     <td style="width: 15%;border-left:1px solid black;border-right:1px solid black;">                           </td>

                 </tr>

                 </table>
EOD;
    $pdf->writeHTML($tbl, true, false, false, false, '');
    $rows++;
    $pdf->Ln(-4);
}

$tbl = <<<EOD
   <table cellspacing="0"    align="left"  >

                 <tr >
                     <td style="width: 20%;border-left:1px solid black;border-bottom:1px solid black;">                      </td>
                     <td style="width: 50%;border-left:1px solid black;border-bottom:1px solid black;"  align="left">           </td>
                     <td style="width: 15%;border-left:1px solid black;border-bottom:1px solid black;">                           </td>
                     <td style="width: 15%;border-left:1px solid black;border-bottom:1px solid black;border-right:1px solid black;">                           </td>

                 </tr>

                 </table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$rows++;
$pdf->Ln(-2);



$tbl = <<<EOF
<table class="first" width="100%"   cellpadding  ="3">
    <tr align="left">
        <td width="20%"><strong>Transpoteur : </strong></td>
        <td width="80%">$transporteur</td>
    </tr>
    <tr>
        <td width="20%"><strong>Camion : </strong></td>
        <td width="80%">$camion</td>
    </tr >
    <tr>
        <td width="20%"><strong>Destination : </strong></td>
        <td width="80%">$destination</td>
    </tr >
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = <<<EOF
<table class="first" width="100%"   cellpadding  ="3">
    <tr align="left">
        <td width="100%">Toutes les palettes non rendues seront facturées au prix de 50 DHS par palette HORS TAXE </td>
    </tr>
    <tr align="left">
        <td width="100%">Aucune reclamation ne sera accetpée après 48h de livraison </td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');


$tbl = <<<EOF
<table class="first" width="100%"   cellpadding  ="3">
     <tr align="center">
        <td width="50%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;">Responsable Logistique </td>
        <td width="50%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;">Cachet + Signature Client </td>
    </tr>
    <tr align="left">
        <td width="50%;" height="200px" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"> </td>
        <td width="50%" height="200px" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"> </td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');



$pdf->Output('BL'.$numero.'_'.$societe.'.pdf', 'I');

exit();
//============================================================+
// END OF FILE
//============================================================+