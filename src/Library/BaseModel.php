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
     * @param string $field
     *
     * @return \Slim\PDO\Statement\SelectStatement
     */
    public function checkExists($value = '', $field = 'id')
    {
        return $this->db->select()->from($this->table)->where($value, '=', $field)->count($field);
    }

    /**
     * Function getLatest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:56
     *
     * @param string $field
     *
     * @return \Slim\PDO\Statement\SelectStatement
     */
    public function getLatest($field = 'created_at')
    {
        return $this->db->select()->from($this->table)->max($field)->execute()->fetch();
    }

    /**
     * Function getOldest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 11:56
     *
     * @param string $field
     *
     * @return \Slim\PDO\Statement\SelectStatement
     */
    public function getOldest($field = 'created_at')
    {
        return $this->db->select()->from($this->table)->min($field)->execute()->fetch();
    }

    /**
     * Function getInfo
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 10/29/18 12:02
     *
     * @param string $value
     * @param string $field
     *
     * @return mixed
     */
    public function getInfo($value = '', $field = '')
    {
        $db = $this->db->select()->from($this->table);
        if (is_array($value)) {
            foreach ($value as $column => $val) {
                if (is_array($val)) {
                    $db->whereIn($column, $val);
                } else {
                    $db->where($column, '=', $val);
                }
            }
        } else {
            if (is_array($value)) {
                $db->whereIn($field, $value);
            } else {
                $db->where($field, '=', $value);
            }
        }

        return $db->execute()->fetch();
    }
}
