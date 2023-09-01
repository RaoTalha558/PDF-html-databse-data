<?php
require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$con = mysqli_connect('localhost', 'root', '', 'pdf');

$query = "SELECT * FROM user";
$res = mysqli_query($con, $query);

if (mysqli_num_rows($res) > 0) {
    $html = '<style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: center;
                }
                th {
                    background-color: #f2f2f2;
                }
              </style>';
              
    $html .= '<table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>';
    
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['email'] . '</td>
                  </tr>';
    }
    
    $html .= '</table>'; 

    $dompdf = new Dompdf();    
    $dompdf->loadHtml($html);
    $dompdf->render();
    
    $pdf = $dompdf->output();
    $file = 'downloaded.pdf';
    file_put_contents($file, $pdf);
   
} else {
    echo "Data Not Found";
}

if (isset($_GET['download']) && $_GET['download'] == 1) {
    $file = 'downloaded.pdf';
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file . '"');
    readfile($file);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Download</title>
</head>
<body>
    <a href="?download=1">Download PDF</a>
</body>
</html>
