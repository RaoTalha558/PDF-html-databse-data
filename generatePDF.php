<?php 
require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

// $html = '<h1 style="color:blue;">  Html to Pdf Coverter </h1>'; khud print krwana k liye
$html = file_get_contents('pdf.html'); //iska kaam ye ha k jo apki html file print krwani ha pdf main uska path de dou

$dompdf->loadHtml($html);
$dompdf->setPaper('A4','landscape');
$dompdf->render();

// $dompdf->stream("new file", array('Attachment'=>0)); or ye  sirf ek dafa he download ho pdf bar bar na hou 

$pdf = $dompdf->output();  
file_put_contents("newfilegen.pdf", $pdf); //output main jo dompdf aa rha hai usko apna pass store krwana k liye

?>