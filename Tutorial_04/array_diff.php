<?php

/**
 * arrayDiff function
 *
 * @param array $arr1
 * @param array $arr2
 * @return void
 */
function arrayDiff($arr1, $arr2)
{
    $ans = [];
    if (empty($arr1)) {
        print_r($ans);
    } else {
        foreach ($arr1 as $value) {
            if (!in_array($value, $arr2)) {
                $ans[] = $value;
            }
        }
        echo "<pre>";
        print_r($ans);
    }
}
arrayDiff([1, 2, 2], [1]);
