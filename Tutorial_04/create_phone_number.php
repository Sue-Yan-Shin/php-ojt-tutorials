<?php
/**
 * createPhoneNumber function
 *
 * @param array $numberArray
 * @return void
 */
function createPhoneNumber($numberArray)
{
    $str = implode($numberArray);
    $code = substr($str, 0, 3);
    $first = substr($str, 3, 3);
    $last = substr($str, 6);
    echo "($code) $first-$last";
}
createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 0]);
