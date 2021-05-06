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

    if (!function_exists('isCheckIn')) {
        /**
         * Utility method to return true only if already checkin
         *
         * @return  bool  true if string is not null and not an empty string
         */
        function isCheckIn()
        {
            return intval(session('is_checkin', 0));
        }
    }
}
function theme_tinyMCE_script($config = array())
{
    $config = ($config) ? $config : theme_tinyMCE_default_config();
    $toolBar = (isset($config['toolbar']) && $config['toolbar']) ? true : false;
    $readOnly = (isset($config['readonly']) && $config['readonly']) ? true : false;
    $script = '';
    $script .= '<script type="text/javascript">';
    $script .= 'jQuery(function () {
        tinymce.init({
            selector: "' . $config['selector'] . '",
            /*  mode: "exact", //textareas*/
            ' . ((isset($config['editor_selector']) && $config['editor_selector'] != '') ? ('mode: "specific_textareas",editor_selector : "' . $config['editor_selector'] . '",') : '') . '
            indentation : "' . $config['indentation'] . '",
              /*elements: "email_body",*/
            fontsize_formats: "' . $config['fontsize_formats'] . '",
            theme: "' . $config['theme'] . '",
            ' . ((isset($config['height']) && $config['height'] > 0) ? 'height:' . $config['height'] . ',' : '') . '
             //height: 500,
            plugins: ' . $config['plugins'] . ',
            /*font_size_style_values: "' . $config['font_size_style_values'] . '",*/
            toolbar1: "' . $config['toolbar1'] . '",
            menubar: false,
            toolbar_items_size: "' . $config['toolbar_items_size'] . '",
            readonly : ' . ((isset($readOnly) && $readOnly) ? 'true' : 'false') . ',
            toolbar : ' . ((isset($toolBar) && $toolBar) ? 'true' : 'false') . ',
            convert_urls:true,
            relative_urls:false,
            remove_script_host:false,
            browser_spellcheck: true,
            contextmenu: false,
            branding: false,
            setup: function (ed) {
                ed.on(\'init\', function () {
                    // Font Size and Family Change According to the t #1617
                    this.getDoc().body.style.fontSize = \'11pt\';
                    this.getDoc().body.style.fontFamily = \'Verdana\';
                });
            }
        });
    });';
    if (($config['is_tiny_mce_modal']) != '')
        $script .= "jQuery('#" . $config['is_tiny_mce_modal'] . "').on('hide.bs.modal', function () {
    tinymce.remove('.tinymce-modal');
    });";
    $script .= '</script>';
    return $script;
}

function theme_tinyMCE_default_config()
{
    $config = array();
    $config['selector'] = "textarea";
    $config['indentation'] = "20pt";
    $config['fontsize_formats'] = "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 31pt 32pt 33pt 34pt 35pt 36pt";
    $config['theme'] = "silver";
    $config['plugins'] = '["lists", "preview code", "textcolor"]';
    $config['font_size_style_values'] = "10pt, 11pt, 12pt, 13pt, 18pt, 24pt, 36pt";
    $config['toolbar1'] = "bold italic underline | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect forecolor backcolor bullist numlist /*preview*/ code  undo redo ";
//    $config['toolbar1'] = "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview";
    $config['toolbar_items_size'] = "small";
    $config['is_tiny_mce_modal'] = '';
    $config['readonly'] = false;
    $config['toolbar'] = true;
    return $config;
}

if (!function_exists('minutesToReadableFormat')) {
    function minutesToReadableFormat($timeInMinutes=0)
    {
        $minutes = $timeInMinutes > 0 ? ($timeInMinutes % 60) : 0;
        $hours = $timeInMinutes > 60 ? intval((($timeInMinutes - $minutes) / 60)) : 0;
        $minutes = sprintf("%02d", $minutes);
        $hours = sprintf("%02d", $hours);
        return "$hours:$minutes";
    }
}
