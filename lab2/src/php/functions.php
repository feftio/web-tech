<?php

function useMethod($method = 'SESSION') {
    if ($method == 'SESSION') {
        session_start();
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function show($variable) {
    if (isset($variable) && $variable != '') echo $variable;
}

function show_radio($variable, $radio) {
    if (isset($variable) && $variable == $radio) echo 'checked="checked"';
}

?>