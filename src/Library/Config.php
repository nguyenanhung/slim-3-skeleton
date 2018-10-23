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
    /**
     * Function getData
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/23/18 23:22
     *
     * @param string $path
     *
     * @return array|mixed
     */
    public static function getData($path = '')
    {
        if (is_file($path) && file_exists($path)) {
            return require($path);
        }

        return [];
    }
}
