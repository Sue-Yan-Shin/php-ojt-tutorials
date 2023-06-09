<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container d-flex flex-column align-items-center my-5 text-center">
        <div class="card col-md-4" style="width:24rem;">
            <h4 class="card-header">
                QR Code Generator
            </h4>
            <div class="card-body text-start">
                <form class="form p-3 needs-validation" novalidate method="post" action="generate.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="qrName" class="form-label">QR Name</label>
                        <input type="text" class="form-control  <?php echo (!empty($_SESSION['qrNameError'])) ? 'is-invalid' : ''; ?>" id="qrName" aria-describedby="validationError" name="qrName" value="<?php echo !empty($_SESSION['qrName']) ? $_SESSION['qrName'] : ""; ?>" required placeholder="Enter QR Name">
                        <span id="validationError" class="invalid-feedback">
                            <?php echo (!empty($_SESSION['qrNameError'])) ? $_SESSION['qrNameError'] : ''; ?>
                        </span>
                    </div>
                    <button type="submit" name="generate" class="btn btn-primary mt-4 w-100">Generate</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-2 text-center m-auto mb-4">
        <div class="card text-center <?php echo empty($_SESSION['generatedImg']) ? 'collapse' : '' ?> ">
            <img src="images/<?php echo (!empty($_SESSION['generatedImg'])) ? $_SESSION['generatedImg'] : '' ?>   " alt="" style="width:200px;">
        </div>
    </div>

    <div class="card w-75 m-auto">
        <h3 class="card-header">QR List</h3>
        <div class="card-body row">
            <?php
            $dir = 'images/';
            foreach (glob($dir . "*") as $image) {
                echo '<div class="col-sm-4">
                            <div class="card m-4">
                            <img src="' . $image . '">
                            <p class="text-center">' . basename($image) . '</p>
                            </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</body>

</html>
<?php
unset($_SESSION['qrName']);
unset($_SESSION['qrNameError']);
unset($_SESSION['generatedImg']);

?>