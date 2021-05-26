<?php 


require_once('../../../dbCoonection.php');
$objDb = new db();
$link = $objDb->connection_mysql();
$i = 1;

$sql = "select * from log";
$result = mysqli_query($link,$sql);
$html = '<table style="border: 1px solid black">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border: 1px solid black">#</th>';
$html .= '<th style="border: 1px solid black">Action</th>';
$html .= '<th style="border: 1px solid black">Description</th>';
$html .= '<th style="border: 1px solid black">User</th>';
$html .= '<th style="border: 1px solid black">Time</th>';
$html .= '</thead>';

$html .= '<tbody>';
while($qr = mysqli_fetch_assoc($result)){
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black">'.$i.'</td>'; 
    $html .= '<td style="border: 1px solid black">'.$action = $qr['action'].'</td>';
    $html .= '<td style="border: 1px solid black">'.$ds = $qr['description'].'</td>';   
    $html .= '<td style="border: 1px solid black">'.$user = $qr['usuario'].'</td>';
    $html .= '<td style="border: 1px solid black">'.$time = date('d/m/Y H:i:s', strtotime($qr['tempo'])).   '</td></tr>'; $i++; } 

    $html .= '</tbody>';
    $html .= '</table>';


        // while($qr = mysqli_fetch_assoc($result)){
        //         $html .= '<div>';
        //         $html .= '<span style="display: inline-block; margin-right: 10px;">'.$qr['id'].'</span>'; 
        //         $html .= '<span style="display: inline-block; margin-right: 10px;">'.$action = $qr['action'].'</span>';
        //         $html .= '<span style="display: inline-block; font-weight: bold; margin-right: 15px;">'.$ds = $qr['description'].'</span>';   
        //         $html .= '<span style="margin-right: 10px">'.$user = $qr['usuario'].'</span>';
        //         $html .= $time = $qr['tempo'];}
        //         $html .= '</div>';


    use Dompdf\Dompdf;
    require_once('./dompdf/dompdf/autoload.inc.php');
    
    $dompdf = new Dompdf();
    
    $dompdf->loadHtml("<h1> Main Log - Myschool </h1> '.$html.'");
    
    $dompdf->render();
    
    $dompdf->stream("MainLog.pdf", array("Attachment" => false));
    
    
    ?>

