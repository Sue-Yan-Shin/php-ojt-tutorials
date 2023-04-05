<?php
session_start();

// include the library
require "libs/phpqrcode/qrlib.php";
if (isset($_POST['generate'])) {
    // get the input from the user
    $name = $_POST["qrName"];
    //old value
    $_SESSION['qrName'] = $name;
    if (!empty($name)) {
        if (file_exists('images/' . $name . '.png')) {
            $_SESSION['qrNameError'] = "QR name already existed.";
            header("Location: index.php");
            exit();
        }
        // generate the QR code
        $_SESSION['generatedImg'] = $name . ".png";
        QRcode::png($name, "images/" . $_SESSION['generatedImg']);
        header('Location: index.php');
    } else {
        $_SESSION['qrNameError'] = "QR name field is required";
        header('Location:index.php');
    }
}
