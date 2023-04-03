<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container d-flex flex-column align-items-center my-5 text-center">
        <div class="alert py-1 text-center <?php echo $_SESSION['alertColor']; ?> " role="alert" style="width:24rem;">
            <p>
                <?php echo $_SESSION['message'];
                ?>
            </p>
        </div>
        <div class="card col-md-4" style="width:24rem;">
            <h4 class="card-header">
                Upload Image
            </h4>
            <div class="card-body text-start">
                <form class="form p-3 needs-validation" novalidate method="post" action="upload.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="folderName" class="form-label">Folder Name</label>
                        <input type="text" class="form-control  <?php echo (!empty($_SESSION['folderNameError'])) ? 'is-invalid' : ''; ?>" id="folderName" aria-describedby="validationError" name="folderName" required placeholder="Enter Folder Name">
                        <span id="validationError" class="invalid-feedback">
                            <?php echo $_SESSION['folderNameError']; ?>
                        </span>
                    </div>
                    <label for="image" class="form-label mt-3">Choose Image</label>
                    <input type="file" class="form-control  <?php echo (!empty($_SESSION['imageError'])) ? 'is-invalid' : ''; ?>" id="image" name="image">
                    <div id="validationError" class="invalid-feedback">
                        <?php echo $_SESSION['imageError']; ?>
                    </div>
                    <button type="submit" name="upload" class="btn btn-primary mt-4 w-100">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    $dir = "images/";
    $folders = scandir($dir);
    $image_paths = array();
    foreach ($folders as $folder) {
        if (!in_array($folder, array(".", ".."))) {
            $files = scandir($dir . $folder . "/");
            foreach ($files as $file) {
                if (!in_array($file, array(".", ".."))) {
                    $image_paths[] = array(
                        "image_name" => basename($file),
                        "image_path" => $dir . $folder . "/" . $file
                    );
                }
            }
        }
    }
    echo "<div class='row mx-5 bg-light'>";
    foreach ($image_paths as $image) {
        $image_name = $image['image_name'];
        $image_path = $image['image_path'];
        $localhost = $_SERVER['HTTP_HOST'] . "/";
        echo "<div class='col-sm-4'>";
        echo "<div class='card m-3 '>";
        echo "<img class='card-img-top' src='" . $image_path . "' alt='" . $image_name . "' style='max-height: 200px; object-fit: cover;'>";
        echo "<div class='card-body text-center '>";
        echo "<h5 class='card-text text-primary'>" . $image_name . "</h5>";
        echo "<p class='card-text text-primary'>" . $localhost . $image_path . "</p>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='image_path' value='" . $image_path . "'>";
        echo "<button type='submit' class='btn btn-danger w-100' name='delete'>Delete</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";

    if (isset($_POST['delete'])) {
        $image_path = $_POST['image_path'];
        unlink($image_path);
        $_SESSION['message'] = 'Image deleted successfully';
        header('Location:index.php');
    }
    ?>
</body>

</html>

<?php
unset($_SESSION['message']);
unset($_SESSION['alertColor']);
unset($_SESSION['folderName']);
unset($_SESSION['imageError']);
unset($_SESSION['folderNameError']);

?>