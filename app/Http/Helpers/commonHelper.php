<?php
$a = 1;
function test()
{
    global $a;
    echo $a;
}

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return (loggedinId() > 0) ? true : false;
    }
}

if (!function_exists('appIdMask')) {
    function appIdMask($userId = 0)
    {
        $maskKey = tokenKey() . '_' . $userId;
        return encode($maskKey);
    }
}

if (!function_exists('loggedinId')) {
    function loggedinId()
    {
        return session('user_id', '0');
    }
}

if (!function_exists('loggedinName')) {
    function loggedinName()
    {
        return session('first_name', '');
    }
}

if (!function_exists('userRoleId')) {
    function userRoleId()
    {
        return intval(session('role_id', 0));
    }
}

if (!function_exists('adminRoleId')) {
    function adminRoleId()
    {
        return intval(session('admin_role_id', 1));
    }
}

if (!function_exists('appAssets')) {
    function appAsset($path)
    {
        $flag = config('custom.app_ssl');
        return asset($path, $flag);
    }
}

if (!function_exists('generate_random_string')) {
    /**
     * Description: The following is used to generate a string of respective length
     * @param $length
     * @return string
     */
    function generate_random_string($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $clen = strlen($chars) - 1;
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $chars[mt_rand(0, $clen)];
        }
        return ($id);
    }
}
