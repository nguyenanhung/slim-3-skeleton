<?php
/**
 * Project slim-3-skeleton.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/29/18
 * Time: 15:20
 */

namespace App\Library;

/**
 * Interface BaseModelInterface
 *
 * @package   App\Library
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface BaseModelInterface
{
    /**
     * Function setTable
     *
     * @param string $table
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:53
     *
     */
    public function setTable($table = '');

    /**
     * Function checkExists
     *
     * @param string $value
     * @param string $column
     * @param string $as
     * @param bool $distinct
     *
     * @return mixed
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/AGGREGATES.md#countcolumn---as--null-distinct--false
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:08
     *
     */
    public function checkExists($value = '', $column = 'id', $as = 'count', $distinct = FALSE);

    /**
     * Function getLatest
     *
     * @param string $column
     * @param null $as
     *
     * @return mixed
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/AGGREGATES.md#maxcolumn-as--null
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:07
     *
     */
    public function getLatest($column = 'created_at', $as = NULL);

    /**
     * Function getOldest
     *
     * @param string $column
     * @param null $as
     *
     * @return mixed
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/AGGREGATES.md#mincolumn-as--null
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:06
     *
     */
    public function getOldest($column = 'created_at', $as = NULL);

    /**
     * Function getAvg
     *
     * @param string $column
     * @param null $as
     *
     * @return mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:21
     *
     */
    public function getAvg($column = 'created_at', $as = NULL);

    /**
     * Function getInfo
     *
     * @param string $value
     * @param string $column
     * @param null|string|array $selectColumn
     *
     * @return mixed
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/SELECT.md
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:10
     *
     */
    public function getInfo($value = '', $column = 'id', $selectColumn = ['*']);

    /**
     * Function getValue
     *
     * @param string $value
     * @param string $column
     * @param string $columnOutput
     *
     * @return null|string
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/SELECT.md
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:11
     *
     */
    public function getValue($value = '', $column = '', $columnOutput = '');

    /**
     * Function getDistinctResult
     *
     * @param string|array $selectColumn
     *
     * @return array
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/SELECT.md#distinct
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 14:41
     *
     */
    public function getDistinctResult($selectColumn = '');

    /**
     * Function getResult
     *
     * @param array|string $wheres Mảng dữ liệu hoặc giá trị primaryKey cần so sánh điều kiện để update
     * @param array|string $selectColumn Mảng dữ liệu danh sách các field cần so sánh
     * @param null|string $options Mảng dữ liệu các cấu hình tùy chọn
     *                                          example $options = [
     *                                          'format' => null,
     *                                          'orderBy => [
     *                                          'id' => 'desc'
     *                                          ]
     *                                          ];
     *
     * @return array Mảng dữ liệu phù hợp với yêu cầu map theo biến format truyền vào
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/SELECT.md
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 14:45
     *
     */
    public function getResult($wheres = [], $selectColumn = '*', $options = NULL);

    /**
     * Function getSum
     *
     * @param string $column
     * @param string|null $as
     * @param array $wheres
     *
     * @return mixed
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:33
     *
     */
    public function getSum($column = '*', $as = 'count', $wheres = []);

    /**
     * Function add
     *
     * @param array $data
     *
     * @return null|string
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/INSERT.md
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 14:53
     *
     */
    public function add($data = []);

    /**
     * Function update
     *
     * @param array $data
     * @param array $wheres
     *
     * @return int
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/UPDATE.md
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 14:59
     *
     */
    public function update($data = [], $wheres = []);

    /**
     * Function delete
     *
     * @param string $values
     * @param string $columns
     *
     * @return int
     * @see   https://github.com/FaaPz/Slim-PDO/blob/master/docs/Statement/DELETE.md
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 15:02
     *
     */
    public function delete($values = '', $columns = '');
}
