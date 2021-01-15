<?php

if (!function_exists('themeSidebar')) {
    function themeSidebar()
    {
        $parentMenus = menuRole();
    }
}
if (!function_exists('menuRole')) {
    function menuRole()
    {
        return 0;
    }
}
