<?php

$key = 'success';
$message = '';

if (isset($_SESSION['error'])) {
    $key = 'error';
}

if (isset($_SESSION[$key])) {
    $message = '<div class="row flex-center text-'.$key.'">'.$_SESSION[$key].'</div>';

    unset($_SESSION[$key]);
}
