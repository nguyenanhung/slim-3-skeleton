<?php
/**
 * Project slim-3-skeleton.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/29/18
 * Time: 11:45
 */

namespace App\Library;

/**
 * Class BaseModel
 *
 * @package   App\Library
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class BaseModel implements BaseModelInterface
{
    const OPERATOR_EQUAL_TO = '=';
    const OP_EQ = '=';
    const OPERATOR_NOT_EQUAL_TO = '!=';
    const OP_NE = '!=';
    const OPERATOR_LESS_THAN = '<';
    const OP_LT = '<';
    const OPERATOR_LESS_THAN_OR_EQUAL_TO = '<=';
    const OP_LTE = '<=';
    const OPERATOR_GREATER_THAN = '>';
    const OP_GT = '>';
    const OPERATOR_GREATER_THAN_OR_EQUAL_TO = '>=';
    const OP_GTE = '>=';
    const OPERATOR_IS_LIKE = 'like';
    const OPERATOR_IS_NULL = 'is null';
    const OPERATOR_IS_NOT_NULL = 'is not null';
    const ORDER_ASCENDING = 'asc';
    const ORDER_DESCENDING = 'desc';
    const PRIMARY_KEY = 'id';

    /** @var object \FaaPz\PDO\Database */
    protected $db;
    /** @var string Table to Setup */
    protected $table;

    /**
     * BaseModel constructor.
     *
     * @param string $db
     */
    public function __construct($db = '')
    {
        $this->db = Db::load($db);
    }

    /**
     * Function setTable
     *
     * @param string $table Table Database to Setup
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:53
     *
     */
    public function setTable($table = '')
    {
        $this->table = $table;
    }

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
    public function checkExists($value = '', $column = 'id', $as = 'count', $distinct = false)
    {
        return $this->db->select([$column])->from($this->table)->where($column, self::OPERATOR_EQUAL_TO, $value)->count($column, $as, $distinct)->execute()->fetch();
    }

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
    public function getLatest($column = 'created_at', $as = null)
    {
        return $this->db->select()->from($this->table)->max($column, $as)->execute()->fetch();
    }

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
    public function getOldest($column = 'created_at', $as = null)
    {
        return $this->db->select()->from($this->table)->min($column, $as)->execute()->fetch();
    }

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
    public function getAvg($column = 'created_at', $as = null)
    {
        return $this->db->select()->from($this->table)->avg($column, $as)->execute()->fetch();
    }

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
    public function getInfo($value = '', $column = 'id', $selectColumn = ['*'])
    {
        $selectColumn = !is_array($selectColumn) ? [$selectColumn] : ['*'];
        $db = $this->db->select($selectColumn)->from($this->table);
        if (is_array($value)) {
            foreach ($value as $col => $val) {
                if (is_array($val)) {
                    $db->whereIn($col, $val);
                } else {
                    $db->where($col, '=', $val);
                }
            }
        } else {
            if (is_array($value)) {
                $db->whereIn($column, $value);
            } else {
                $db->where($column, self::OPERATOR_EQUAL_TO, $value);
            }
        }

        return $db->execute()->fetch();
    }

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
    public function getValue($value = '', $column = '', $columnOutput = '')
    {
        $result = $this->getInfo($value, $column, [$columnOutput]);
        if (!empty($columnOutput) && is_object($result) && isset($result->$columnOutput)) {
            return $result->$columnOutput;
        } else {
            return null;
        }
    }

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
    public function getDistinctResult($selectColumn = '')
    {
        $selectColumn = !is_array($selectColumn) ? [$selectColumn] : ['*'];

        return $this->db->select($selectColumn)->from($this->table)->distinct()->execute()->fetchAll();
    }

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
    public function getResult($wheres = [], $selectColumn = '*', $options = null)
    {
        $selectColumn = !is_array($selectColumn) ? [$selectColumn] : ['*'];
        $db = $this->db->select($selectColumn)->from($this->table);
        if (!empty($wheres) && is_array($wheres) && count($wheres) > 0) {
            foreach ($wheres as $column => $value) {
                if (is_array($value)) {
                    $db->whereIn($column, $value);
                } else {
                    $db->where($column, self::OPERATOR_EQUAL_TO, $value);
                }
            }
        }
        if (isset($options['orderBy']) && is_array($options['orderBy'])) {
            foreach ($options['orderBy'] as $column => $direction) {
                $db->orderBy($column, $direction);
            }
        }
        if (isset($options['number']) && isset($options['offset'])) {
            $db->limit($options['number'], $options['offset']);
        }

        return $db->execute()->fetchAll();
    }

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
    public function getSum($column = '*', $as = null, $wheres = [])
    {
        $columns = !is_array($column) ? [$column] : ['*'];
        $db = $this->db->select($columns)->from($this->table);
        if (!empty($wheres) && is_array($wheres) && count($wheres) > 0) {
            foreach ($wheres as $col => $val) {
                if (is_array($val)) {
                    $db->whereIn($col, $val);
                } else {
                    $db->where($col, self::OPERATOR_EQUAL_TO, $val);
                }
            }
        }

        return $db->sum($column, $as)->execute()->fetch();
    }

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
    public function add($data = [])
    {
        if (!is_array($data)) {
            return null;
        }

        return $this->db->insert($data)->into($this->table)->execute();
    }

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
    public function update($data = [], $wheres = [])
    {
        $db = $this->db->update($data)->table($this->table);
        foreach ($wheres as $column => $value) {
            if (is_array($value)) {
                $db->whereIn($column, $value);
            } else {
                $db->where($column, '=', $value);
            }
        }

        return $db->execute();
    }

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
    public function delete($values = '', $columns = '')
    {
        $db = $this->db->delete()->from($this->table);
        if (is_array($columns)) {
            foreach ($columns as $col => $val) {
                if (is_array($val)) {
                    $db->whereIn($col, $val);
                } else {
                    $db->where($col, '=', $val);
                }
            }
        } else {
            if (is_array($values)) {
                $db->whereIn($columns, $values);
            } else {
                $db->where($columns, '=', $values);
            }
        }

        return $db->execute();
    }
}
