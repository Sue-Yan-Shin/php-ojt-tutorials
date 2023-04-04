<?php
session_start();

// get all the QR code images from the images folder
$qrImagePath = glob("images/*.png");
if (!empty($qrImagePath)) {
  // add the newly generated image path at the beginning of the array
  $newImagePath = "images/qr_" . $name . ".png";
  //array_unshift($qrImagePath, $newImagePath);
  $qrImagePath = array_merge(array($newImagePath), $qrImagePath);

}

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
        <!--<div class="alert py-1 text-center <?php echo $_SESSION['alertColor']; ?> " role="alert" style="width:24rem;">
            <p>
              <?php //echo $_SESSION['message'];
                ?>
            </p>
        </div>-->
        <div class="card col-md-4" style="width:24rem;">
            <h4 class="card-header">
                QR Code Generator
            </h4>
            <div class="card-body text-start">
                <form class="form p-3 needs-validation" novalidate method="post" action="generate.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="qrName" class="form-label">QR Name</label>
                        <input type="text" class="form-control  <?php echo (!empty($_SESSION['qrNameError'])) ? 'is-invalid' : ''; ?>" id="qrName" aria-describedby="validationError" name="qrName" required placeholder="Enter QR Name">
                        <span id="validationError" class="invalid-feedback">
                            <?php echo $_SESSION['qrNameError']; ?>
                        </span>
                    </div>
                    <button type="submit" name="generate" class="btn btn-primary mt-4 w-100">Generate</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    var_dump( $_SESSION['generatedImg']);
          echo '<img src=" images/'. $_SESSION['generatedImg'] .'" class="" />';    
// display the QR code images in a 3-column grid using Bootstrap
echo '<div class="container w-75 bg-light">';
echo '<h3 class="m-4">QR List</h3>';
echo '<div class="row">';
foreach ($qrImagePath as $qr_image) {
    echo '<div class="col-sm-4">';
    echo '<div class="card m-4 w-75 text-center pb-3">';
    echo '<img src="' . $qr_image . '" class=""  />';
    echo "<h6> $qr_image </h6>";
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
?>
</body>
</html>