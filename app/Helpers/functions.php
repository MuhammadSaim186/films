<?php

use Illuminate\Support\Facades\Auth;


// use Auth;
if (!function_exists("pre")) {
    function pre($data)
    {
        echo "<pre>";
        print_r(json_decode(json_encode($data)));
        die;
    }
}
if (!function_exists('get_date')) {
    function get_date($date, $format = 'd, M Y')
    {
        $new_date = new DateTime($date);
        return $new_date->format($format);
    }
}

if (!function_exists('get_full_time')) {
    function get_full_time($datetime)
    {
        return get_date($datetime, 'd, M Y @ h:i A');
    }
}

if (!function_exists('get_time')) {
    function get_time($datetime)
    {
        return get_date($datetime, 'h:i A');
    }
}



if (!function_exists("get_price")) {
    function get_price($price, $symbol = null)
    {
        if ($symbol) {
            $_symbol = $symbol;
        } else {
            $_symbol = "Rs ";
        }
        return $_symbol . '' . number_format($price, 2);
    }
}

if (!function_exists("newCount")) {
    function newCount($array)
    {
        if (is_array($array) || is_object($array)) {
            return count($array);
        } else {
            return 0;
        }
    }
}

if (!function_exists('dummy_image')) {
    function dummy_image($type = null)
    {
        switch ($type) {
            case 'user':
                return asset('public/images/user.jpg');
            case 'product':
                return asset('public/images/placeholder.png');
            default:
                return asset('images/dummy/4.jpg');
        }
    }
}


if (!function_exists('checkParams')) {
    function checkParams($array = NULL)
    {
        if (!$array) {
            echo json_encode(array("status" => "error", "message" => "Parameters Required"));
            exit;
        } else {
            $check = FALSE;
            $param_name = "";
            foreach ($array as $key => $value) {
                if (!array_key_exists($value, $_REQUEST) || trim(@$_REQUEST[$value]) == "") {
                    $param_name = $value;
                    $check = TRUE;
                }
            }
            if ($check) {
                echo json_encode(array("status" => "error", "message" => $param_name . " parameter is missing OR missing value"));
                exit;
            }
        }
    }
}

if (!function_exists("get_day")) {
    function get_day($date)
    {
        $timestamp = strtotime($date);
        $day = date('l', $timestamp);
        return $day;
    }
}



if (!function_exists('short_desc')) {
    function short_desc($content, $length = 40, $end = '...')
    {
        $text = strip_tags($content);
        if (strlen($text) > $length) {
            $new_text = substr($text, 0, $length);
            $new_text = trim($new_text);
            return $new_text . $end;
        } else {
            return $text;
        }
    }
}


if (!function_exists('to_json')) {

    function to_json($data)
    {
        echo json_encode($data);
    }
}


if (!function_exists('getAllMonths')) {
    function getAllMonths()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
    }
}

function encode($val)
{
    return Hashids::encode($val);
}

function decode($val)
{
    return Hashids::decode(@$val)[0];
}


if (!function_exists('print_image')) {
    function print_image($url, $dummy_type = 'categories')
    {
        if (is_null($url) || empty($url)) {
            return dummy_image($dummy_type);
        } else {
            return asset('public/uploads/' . $url);
        }
    }
}

function curl_get_file_contents($URL)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) return $contents;
    else return FALSE;
}
