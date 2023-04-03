<?php

/**
 * drawChessBorad function
 *
 * @param int $rows
 * @param int $cols
 * @return void
 */
function drawChessBorad($rows, $cols)
{
    if ($rows <= 0 && $cols <= 0) {
        echo '$rows and $cols parameter must be greater than 0.';
    } elseif (!is_int($rows) && !is_int($cols)) {
        echo '$rows and $cols parameter must be numbers.';
    } elseif ($rows <= 0 &&  !is_int($cols)) {
        echo '$rows parameter must be greater than 0.$cols parameter must be number.';
    } elseif (!is_int($rows) && $cols <= 0) {
        echo '$rows parameter must be number.$cols parameter must be greater than 0.';
    } elseif ($rows <= 0) {
        echo '$rows parameter must be greater than 0.';
    } elseif ($cols <= 0) {
        echo '$cols parameter must be greater than 0.';
    } elseif (!is_int($rows)) {
        echo '$rows parameter must be number.';
    } elseif (!is_int($cols)) {
        echo '$cols parameter must be number.';
    } else {
        for ($i = 1; $i <= $rows; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $cols; $j++) {
                $color = ($i + $j) % 2 == 0 ? 'white' : 'black';
                echo "<td class=$color></td>";
            }
            echo "</tr>";
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
    <title>ChessBoard</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="chess">
        <h1>Chessboard</h1>
        <table>
            <?php drawChessBorad(8, 8) ?>
        </table>
    </div>
</body>

</html>