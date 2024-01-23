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
 * @package   App\Library
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Config
{
    /**
     * Function getData
     *
     * @param string $path
     *
     * @return array|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 23:22
     *
     */
    public static function getData($path = '')
    {
        if (is_file($path) && file_exists($path)) {
            return require($path);
        }

        return [];
    }

    /**
     * Function getConfig
     *
     * @param string $file
     *
     * @return array|mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-11-29 17:02
     *
     */
    public static function getConfig($file = '')
    {
        $path = realpath(__DIR__ . '/../config/') . DIRECTORY_SEPARATOR;
        $configFile = $path . $file;
        if (is_file($configFile) && file_exists($configFile)) {
            return require($configFile);
        }

        return [];
    }

    /**
     * Function getSettings
     *
     * @return array
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 23:58
     *
     */
    public static function getSettings()
    {
        $file = __DIR__ . '/../settings.php';
        if (is_file($file) && file_exists($file)) {
            $result = require(__DIR__ . '/../settings.php');

            return $result['settings'];
        }

        return [];
    }
}
