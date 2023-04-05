<?php
require 'vendor/autoload.php';
/**
 * readTxtFile function
 *
 * @return string
 */
function readTxtFile()
{
    $txtPath = "files/sample.txt";
    $txtContent = nl2br(file_get_contents($txtPath));
    return $txtContent;
}
/**
 * readWord function
 *
 * @param string $filename
 * @return string
 */
function readWord($filename)
{
    if (file_exists($filename)) {
        if (($fh = fopen($filename, 'r')) !== false) {
            $headers = fread($fh, 0xA00);

            // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
            $n1 = (ord($headers[0x21C]) - 1);

            // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
            $n2 = ((ord($headers[0x21D]) - 8) * 256);

            // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
            $n3 = ((ord($headers[0x21E]) * 256) * 256);

            // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
            $n4 = (((ord($headers[0x21F]) * 256) * 256) * 256);

            // Total length of text in the document
            $textLength = ($n1 + $n2 + $n3 + $n4);

            $extracted_plaintext = fread($fh, $textLength);
            return nl2br($extracted_plaintext);
        }
    }
}

/**
 * readExcelFile function
 *
 * @return void
 */
function readExcelFile()
{
    // Load the Excel file
    $inputFileName = 'files/sample.xlsx';
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

    // Get the data from the Excel file
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    // Display the data in a table
    $html = "<table class='table'>";
    foreach ($rows as $row) {
        $html .= "<tr>";
        foreach ($row as $cell) {
            $html .= "<td>" . $cell . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    echo $html;
}
/**
 * readCsvFile function
 *
 * @param string $filename
 * @return string
 */
function readCsvFile($filename)
{
    $html = '';
    if (($handle = fopen($filename, 'r')) !== false) {
        $headers = fgetcsv($handle); // Read the header row
        $html  = '<table class="table">';
        $html .= '<tr>';
        foreach ($headers as $header) {
            $html .= '<th>' . $header . '</th>';
        }
        $html .= '</tr>';
        while (($row = fgetcsv($handle)) !== false) {
            $html .= '<tr>';
            foreach ($row as $value) {
                $html .= '<td>' . $value . '</td>';
            }
            $html .= '</tr>';
        }
        fclose($handle);
        $html .= '</table>';
    }
    return $html;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial_05</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="card p-4 mt-5" style="margin:0 100px">
        <div class="txt-file mb-5">
            <h1 class="fs-3">Text File</h1>
            <hr>
            <?php
            echo readTxtFile();
            ?>
        </div>
        <div class="doc-file mb-5">
            <h1 class="fs-3">Document File</h1>
            <hr>
            <?php
            echo readWord('files/sample.doc');
            ?>
        </div>
        <div class="excel-file mb-5">
            <h1 class="fs-3">Excel File</h1>
            <hr>
            <?php
            readExcelFile();
            ?>
        </div>
        <div class="csv-file mb-5">
            <h1 class="fs-3">CSV File</h1>
            <hr>
            <?php
            echo readCsvFile('files/sample.csv');
            ?>
        </div>
    </div>
</body>

</html>