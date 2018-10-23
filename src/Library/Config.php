<?php
/**
 * Project slim-3-skeleton.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/23/18
 * Time: 23:14
 */

namespace App\Library;

/**
 * Class Config
 *
 * @package App\Library
 */
class Config
{
    const CONFIG_PATH = 'config';
    const CONFIG_EXT  = '.php';

    /**
     * Function getData
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 23:15
     *
     * @param $configName
     *
     * @return array|mixed
     */
    public static function getData($configName)
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . self::CONFIG_PATH . DIRECTORY_SEPARATOR . $configName . self::CONFIG_EXT;
        if (is_file($path) && file_exists($path)) {
            return require($path);
        }

        return [];
    }
}
