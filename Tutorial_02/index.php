<?php

/**
 * makeDiamondShape function
 *
 * @param int $row
 * @return void
 */
function makeDiamondShape($row)
{
    if ($row <= 0) {
        echo '$row parameter must be greater than 0.';
    } elseif (is_string($row)) {
        echo '$row parameter must be number.';
    } elseif ($row % 2 == 0) {
        echo '$row parameter must be odd number.';
    } else {
        $half = floor($row / 2);
        //upper
        for ($i = 1; $i <= $half + 1; $i++) {
            //space
            for ($space = $half; $space >= $i; $space--) {
                echo "&nbsp;&nbsp;";
            }
            //star
            for ($star = 0; $star < $i * 2 - 1; $star++) {
                echo "*";
            }
            echo "<br>";
        }
        //lower
        for ($i = 1; $i <= $half; $i++) {
            //space
            for ($space = 0; $space < $i; $space++) {
                echo "&nbsp;&nbsp;";
            }
            //star
            for ($star = $row - ($i * 2); $star > 0; $star--) {
                echo "*";
            }
            echo "<br>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Pattern</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Diamond Pattern</h1>
    <div class="diamond-blk">
        <?php makeDiamondShape(0); ?>
    </div>
</body>

</html>