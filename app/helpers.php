<?php
// app/helpers.php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('encrypt_url')) {
    function encrypt_url($url)
    {
        return Crypt::encryptString($url);
    }
}

if (!function_exists('decrypt_url')) {
    function decrypt_url($encryptedUrl)
    {
        return Crypt::decryptString($encryptedUrl);
    }
}
