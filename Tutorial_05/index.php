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
 * readDocFile function
 *
 * @return string
 */
function readDocFile()
{
    $filename = "files/sample.doc";
    $docReader = \PhpOffice\PhpWord\IOFactory::createReader('MsDoc');
    $phpWord = $docReader->load($filename);

    $sections = $phpWord->getSections();
    $text = "";
    foreach ($sections as $section) {
        $elements = $section->getElements();

        foreach ($elements as $element) {
            if ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                $text .= $element->getText();
            }
        }
    }
    return $text;
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
 * @return string
 */
function readCsvFile()
{
    $filename = 'files/sample.csv';
    if (($handle = fopen($filename, 'r')) !== false) {
        $headers = fgetcsv($handle); // Read the header row
        $data = array();
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = array_combine($headers, $row); // Combine header row with data rows
        }
        fclose($handle);
        // Output the table header
        $html  = '<table class="table">';
        $html .= '<tr><th>' . implode('</th><th>', $headers) . '</th></tr>';
        // Loop through the data array and output each row
        foreach ($data as $row) {
            $html .= '<tr><td>' . implode('</td><td>', $row) . '</td></tr>';
        }
        // Output the table footer
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
            echo readDocFile();
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
            echo readCsvFile();
            ?>
        </div>
    </div>
</body>

</html>