<?php

if (!function_exists('custom_public_path')) {
    function custom_public_path($path = '')
    {
        if (app()->environment('production')) {
            return $_SERVER['DOCUMENT_ROOT'] . ($path ? '/' . $path : '');
        } else {
            return public_path($path ? '/' . $path : '');
        }
    }
}