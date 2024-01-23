<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/3/18
 * Time: 13:49
 */
if (!function_exists('ipAddress')) {
    /**
     * Function ipAddress
     *
     * @param bool $convertToInteger
     *
     * @return bool|int|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/19/18 15:55
     *
     */
    function ipAddress($convertToInteger = false)
    {
        $ip_keys = [
            0 => 'HTTP_X_FORWARDED_FOR',
            1 => 'HTTP_X_FORWARDED',
            2 => 'HTTP_X_IPADDRESS',
            3 => 'HTTP_X_CLUSTER_CLIENT_IP',
            4 => 'HTTP_FORWARDED_FOR',
            5 => 'HTTP_FORWARDED',
            6 => 'HTTP_CLIENT_IP',
            7 => 'HTTP_IP',
            8 => 'REMOTE_ADDR'
        ];
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (ipValidate($ip)) {
                        if ($convertToInteger === true) {
                            return ip2long($ip);
                        }

                        return $ip;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Function ipValidate
     *
     * @param $ip
     *
     * @return bool
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/19/18 15:55
     *
     */
    function ipValidate($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return false;
        }

        return true;
    }
}
if (!function_exists('arrayToObject')) {
    /**
     * Hàm chuyển dữ liệu từ 1 mảng thành 1 object
     *
     * @param array $array
     * @param bool $str_to_lower
     *
     * @return array|bool|\stdClass
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/20/18 11:07
     *
     */
    function arrayToObject($array = [], $str_to_lower = false)
    {
        if (!is_array($array)) {
            return $array;
        }
        $object = new stdClass();
        if (count($array) > 0) {
            foreach ($array as $name => $value) {
                $name = trim($name);
                if ($str_to_lower === true) {
                    $name = strtolower($name);
                }
                if (!empty($name)) {
                    $object->$name = arrayToObject($value);
                }
            }

            return $object;
        }

        return false;
    }
}
