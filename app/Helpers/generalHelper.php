<?php

use Carbon\Carbon;

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
if (!function_exists('date_filter')) {
    function date_filter($date_from = '', $date_to = '', $compare_date = 'created_at', $dataFormat = 'Y-m-d')
    {
        if ($date_from == '')
            $date_from = date($dataFormat);
        if ($date_to == '' || $date_to == '0000-00-00')
            $date_to = date($dataFormat);
        $date = date_create_from_format($dataFormat, $date_from);
        $date_from = $date->format($dataFormat);
        $date = date_create_from_format($dataFormat, $date_to);
        $date_to = $date->modify('+1 day')->format($dataFormat);
        $where = [[$compare_date, '>=', "$date_from"], [$compare_date, '<=', "$date_to"]];
        return $where;
    }
}

if (!function_exists('calculateDateRange')) {

    function calculateDateRange($requestData)
    {
        $dateFilter = '';
        if (isset($requestData['from_date']) && !empty($requestData['from_date']) && isset($requestData['to_date']) && !empty($requestData['to_date'])) {
            $dateFilter = date_filter($requestData['from_date'], $requestData['to_date']);
        } elseif (isset($requestData['to_date']) && !empty($requestData['to_date'])) {

            $dateFilter = date_filter('00-00-0000', $requestData['to_date']);
        } elseif (isset($requestData['from_date']) && !empty($requestData['from_date'])) {

            $dateFilter = date_filter($requestData['from_date'], '00-00-0000');
        } else {
            $dateFilter = '';
        }
        return $dateFilter;
    }
}

if (!function_exists('currentMonthDates')) {
    function currentMonthDates()
    {
        return array('from' => date('m-01-Y'), 'to' => date('m-d-Y'));
    }
}

if (!function_exists('historyDateFilter')) {
    function historyDateFilter($period = '')
    {
        $filters = [];
        switch ($period) {
            case "Current Month":
                $filters = [['checkin', '>=', Carbon::now()->startOfMonth()->format('Y-m-d')]];
                break;
            case "Previous Month":
                $filters = date_filter(Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d'), Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d'), 'checkin');
                break;
            case "Current Week":
                $filters = date_filter(Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->format('Y-m-d'), Carbon::now()->format('Y-m-d'), 'checkin');
                break;
            case "Previous Week":
                $filters = date_filter(Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'), Carbon::now()->subWeek()->addDay()->format('Y-m-d'), 'checkin');
                break;
        }
        return $filters;
    }
}

