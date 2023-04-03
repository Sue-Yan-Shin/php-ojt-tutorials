<?php
$message = '';
$alertColor = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['birthdate'])) {
    $birthdate = $_POST['birthdate'];
    $ans = calculateAge($birthdate);
    if ($ans == 'invalid') {
      $alertColor = 'alert-danger';
      $message = "Date must not greater than or equal to tomorrow";
    } else {
      $alertColor = 'alert-success';
      $message = "Your age is " . $ans->y . " years, " . $ans->m . " months, and " . $ans->d . " days.";
    }
  } else {
    $alertColor = 'alert-danger';
    $message = "Date is required.";
  }
}
/**
 * calculateAge function
 *
 * @param string $birthdate
 * @return mixed Either a string or an array depends on the condition
 */
function calculateAge($birthdate)
{
  $today = new DateTime();
  $entered_date = new DateTime($birthdate);
  if ($entered_date <= $today) {
    $diff = $today->diff($entered_date);
    return $diff;
  } else {
    return 'invalid';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Age Calculator</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="libs/bootstrap-5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container d-flex flex-column align-items-center mt-5 text-center">
    <div class="alert py-1 text-center <?php echo $alertColor; ?> " role="alert" style="width:24rem;">
      <p><?php echo $message; ?></p>
    </div>
    <div class="card" style="width:24rem;">
      <h4 class="card-header">  
        Age Calculator
      </h4>
      <div class="card-body">
        <form class="form p-3" method="post">
          <label for="birthdate">Date of Birth:</label for="birthdate">
          <input type="date" id="birthdate" name="birthdate">
      </div>
      <button type="submit" class="btn btn-primary m-2">Calculate</button>
      </form>
    </div>
  </div>

</body>

</html>