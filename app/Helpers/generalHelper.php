<?php

if (!function_exists('debug')) {
    function debug($data, $is_exit = false)
    {
        if (is_array($data) || is_object($data)) {
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        } else
            echo "$data<br>";

        if ($is_exit)
            exit();
    }

}
if (!function_exists('encode')) {
    function encode($param)
    {
        return urlencode(base64_encode($param));
    }
}
if (!function_exists('decode')) {
    function decode($param)
    {
        return base64_decode(urldecode($param));
    }
}
if (!function_exists('include_helper')) {
    function include_helper($helperName = '')
    {
        $helper_path = app_path() . '/Http/Helpers/' . $helperName . 'Helper.php';
        if (file_exists($helper_path)) {
            require_once $helper_path;
        }
    }
}

if (!function_exists('model_path')) {
    function model_path($name)
    {
        $str = "App\\Http\\Models\\" . $name;
        return $str;
    }
}

if (!function_exists('no_image_placeholder')) {
    function no_image_placeholder()
    {
        return '<img src="' . base_url('images/noimage.png') . '"/>';
    }
}
if (!function_exists('formatPhone')) {
    function formatPhone($str)
    {
        if ($str != '') {
            $str = str_replace(array('-', ' ', '(', ')'), '', $str);
            $str = substr($str, -10);
            $str = '(' . substr($str, 0, 3) . ') ' . substr($str, 3, 3) . '-' . substr($str, 6, 5);

        }
        return $str;
    }
}

if (!function_exists('numericPhone')) {
    function numericPhone($str)
    {
        $str = str_replace(array('(', ')', '-', ' '), array('', '', '', ''), $str);
        return $str;
    }
}

