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
 * @package App\Library
 * @author  713uk13m <dev@nguyenanhung.com>
 */
class BaseModel
{
    /** @var object \Slim\PDO\Database */
    protected $db;
    /** @var string */
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
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:53
     *
     * @param string $table
     */
    public function setTable($table = '')
    {
        $this->table = $table;
    }

    /**
     * Function checkExists
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:53
     *
     * @param string $value
     * @param string $column
     *
     * @return \Slim\PDO\Statement\SelectStatement
     */
    public function checkExists($value = '', $column = 'id')
    {
        return $this->db->select([$column])->from($this->table)->where($column, '=', $value)->count($column, 'count')->execute()->fetch();
    }

    /**
     * Function getLatest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:56
     *
     * @param string $column
     *
     * @return \Slim\PDO\Statement\SelectStatement
     */
    public function getLatest($column = 'created_at')
    {
        return $this->db->select()->from($this->table)->max($column)->execute()->fetch();
    }

    /**
     * Function getOldest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:56
     *
     * @param string $column
     *
     * @return \Slim\PDO\Statement\SelectStatement
     */
    public function getOldest($column = 'created_at')
    {
        return $this->db->select()->from($this->table)->min($column)->execute()->fetch();
    }

    /**
     * Function getInfo
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 14:33
     *
     * @param string $value
     * @param string $column
     *
     * @return mixed
     */
    public function getInfo($value = '', $column = 'id')
    {
        $db = $this->db->select()->from($this->table);
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
                $db->where($column, '=', $value);
            }
        }

        return $db->execute()->fetch();
    }

    /**
     * Function getValue
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 14:31
     *
     * @param string|array $value
     * @param string       $column
     * @param string|null  $columnOutput
     *
     * @return null
     */
    public function getValue($value = '', $column = '', $columnOutput = '')
    {
        $result = $this->getInfo($value, $column);
        if (!empty($columnOutput) && is_object($result) && isset($result->$columnOutput)) {
            return $result->$columnOutput;
        } else {
            return NULL;
        }
    }
}
