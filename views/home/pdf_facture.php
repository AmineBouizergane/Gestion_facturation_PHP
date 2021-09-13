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
            <table cellpadding  ="6">
                <tr width="50%" align="right">
                    <td><strong> Facture N° : '.$numero.' </strong></td>
                </tr>
                <tr width="34%">
                    <td><strong>'.$societe.'</strong></td>
                </tr >
                <tr width="34%">
                    <td>ICE N° : '.$ice.'</td>
                </tr>
                
            </table>
        </td>
        <td  width="30%">
            <table  cellpadding  ="6">
                <tr width="34%">
                    <td></td>
                </tr>
                <tr width="34%">
                    <td align="right"> Bir Jdid  '.date("d/m/Y", $date).'</td>
                </tr >
            </table>
        </td>
    </tr>
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = <<<EOF
<table  width="100%"   cellpadding  ="3" align="left">
    <tr align="left" >
        <td  width="5%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;" ><strong>N°</strong></td>
        <td  width="40%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;" ><strong>Désignation des prestations</strong></td>
        <td  width="10%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"><strong>Unité</strong></td>
        <td  width="10%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"><strong>Qté</strong></td>
        <td  width="15%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;"><strong>Prix Unitaire H.T</strong></td>
        <td  width="20%" style="border-left:1px solid black;border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;" ><strong>Prix Total</strong></td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Ln(-6);
foreach($det_facture as $k=>$v) {


    $tbl = '
   <table cellspacing="0"    align="left"  >

                 <tr >
                     <td style="width: 5%;border-left:1px solid black;border-bottom:1px solid black;">  '.++$k.'</td>
                     <td style="width: 40%;border-left:1px solid black;border-bottom:1px solid black;"  align="left">  '.$v['produits'].'</td>
                     <td style="width: 10%;border-left:1px solid black;border-bottom:1px solid black;">  '.$v['unite'].'</td>
                     <td style="width: 10%;border-left:1px solid black;border-bottom:1px solid black;">  '.$v['qte'].'</td>
                     <td style="width: 15%;border-left:1px solid black;border-bottom:1px solid black;">  '.$v['prix_unitaire'].' DHS</td>
                     <td style="width: 20%;border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">  '.$v['prix_total'].' DHS</td>

                 </tr>

                 </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');

    $pdf->Ln(-4);
}

$pdf->Ln(4);

$tbl = <<<EOF
<table  width="100%"   cellpadding  ="3" align="left">
    <tr align="left" >
        <td  width="5%" ></td>
        <td  width="40%"></td>
        <td  width="10%"></td>
        <td  width="10%"></td>
        <td  width="15%">Total HT</td>
        <td  width="20%" align="center" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">$total_ht DHS</td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Ln(0);

$tbl = <<<EOF
<table  width="100%"   cellpadding  ="3" align="left">
    <tr align="left" >
        <td  width="5%" ></td>
        <td  width="40%"></td>
        <td  width="10%"></td>
        <td  width="10%"></td>
        <td  width="15%">TVA</td>
        <td  width="20%" align="center" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">$tva DHS</td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Ln(0);

$tbl = <<<EOF
<table  width="100%"   cellpadding  ="3" align="left">
    <tr align="left" >
        <td  width="5%" ></td>
        <td  width="40%"></td>
        <td  width="10%"></td>
        <td  width="10%"></td>
        <td  width="15%">Total TTC</td>
        <td  width="20%" align="center" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-top:1px solid black;">$total DHS</td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Ln(2);

$tbl = <<<EOF
<table class="first" width="100%"   cellpadding  ="3">
    <tr align="left">
        <td width="100%">Arrête la présence facture à la somme de</td>
    </tr>
    <tr align="left">
        <td width="100%">$total_en_lettre</td>
    </tr>
</table>
EOF;
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Output('Facture_N'.$numero.'_'.$societe.'.pdf', 'I');

exit();
//============================================================+
// END OF FILE
//============================================================+