<?php

session_start();

if (isset($_POST['upload'])) {
    $max_size = 2000;
    $folderName = $_POST['folderName'];
    $image = $_FILES['image'];
    $imgName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    if (!empty($folderName) && !empty($image['name'])) {
        // Get the extension of the file
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Check if the extension is valid for an image file
        if (!in_array($extension, array('jpg', 'jpeg', 'png'))) {
            $_SESSION['imageError'] = 'Image extension must be jpg,jpeg or png.';
            header('Location: index.php');
            exit();
        }
        if (filesize($imgName) >= $max_size) {
            $_SESSION['imageError'] = 'Image File size must be less than 2000';
            header('Location: index.php');
            exit();
        }
        $targetDir = 'images/' . $folderName . '/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);  //create directory if not exist
        }
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        // check if same image name exist in folder
        if (file_exists($targetFile)) {
            $_SESSION['imageError'] = 'Image file already exists. Change the name of the image.';
            header('Location: index.php');
            exit();
        }
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {  // upload file
            $_SESSION['message'] = 'Image uploaded successfully.';
            $_SESSION['alertColor'] = 'alert-success';
            unset($_SESSION['folderName']);
            //unset($_SESSION['image']);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['message'] = 'Uploading Failed! Try again.';
            $_SESSION['alertColor'] = 'alert-danger';
            header('Location: index.php');
            exit();
        }
    } else {
        if (empty($folderName)) {
            $_SESSION['folderNameError'] = 'Folder name is required.';
        }
        if (empty($imageName)) {
            $_SESSION['imageError'] = 'Image is required.';
        }
        header('Location: index.php');
    }
}
