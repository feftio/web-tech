<?php

/**
 * random_str
 *
 * @param  int $len
 * @return string
 */
function random_str($len = 10) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charsLen = strlen($chars);
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $str .= $chars[rand(0, $charsLen - 1)];
    }
    return $str;
}

?>