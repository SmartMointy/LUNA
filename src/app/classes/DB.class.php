<?php

//Database class that adds some functionality to query the db more easily

class DB
{
    // Connection config vars and instance var
    private static $INSTANCE = null;
    private $DB_NAME;
    private $DB_PASSWORD;
    private $DB_HOST;
    private $DB_DATABASE;
    
    private $_pdo;
    private $_query;
    private $_error = false;
    private $_results;
    private $_count = 0;

    private function __construct()
    {
        $this->DB_NAME = Config::get('database/user');
        $this->DB_PASSWORD = Config::get('database/pwd');
        $this->DB_HOST = Config::get('database/host');
        $this->DB_DATABASE = Config::get('database/name');

        try {
            $this->_pdo = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_DATABASE, $this->DB_NAME, $this->DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_EMULATE_PREPARES => false));
        } catch (PDOException $e) {
            echo "Ein Fehler ist aufgetreten! Fehlercode:8945" . $e; // TODO: use new language class
            die();
        }
    }
    
    public static function getInstance()
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new DB();
        }
        
        return self::$INSTANCE;
    }
    
    public function query($sql, $params = array())
    {
        //reset the error to false
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            if (!empty($params)) {
                $x = 1;
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    private function action($action, $table, $where = array(), $limit = 0, $order = array())
    {
        if (count($where) === 3) {
            if (!is_numeric($limit)) {
                return false;
            }
            //allowed operators
            $operators = array('=', '>','<', '>=', '<=');

            //splitt the where var
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                if ($limit > 0) {
                    $limit = 'LIMIT ' . $limit;
                } else {
                    $limit = '';
                }

                if (count($order) === 2) {
                    $order = 'ORDER BY ' . $order[0] . ' ' . $order[1];
                } else {
                    $order = '';
                }

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? {$order} {$limit}";

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }

        return false;
    }

    public function get($table, $fields = '*', $where = array(), $limit = 0, $order = array())
    {
        return $this->action('SELECT ' . $fields, $table, $where, $limit, $order);
    }

    public function insert($table, $fields = array())
    {
        if (count($fields) > 0) {
            $keys = '`' . implode("`, `", array_keys($fields)) . '`';
            $values = '';
            $lenght = count($fields);
            
            for ($i = 1; $i < $lenght; $i++) {
                $values .= '?, ';
            }
            $values .= '?';

            $sql = 'INSERT INTO ' . $table . ' (' . $keys . ') VALUES (' . $values . ')';
            
            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }

    public function update($table, $where = array())
    {
        return $this->action('DELETE *', $table, $where);
    }

    public function delete($table, $where = array())
    {
        return $this->action('DELETE *', $table, $where);
    }

    public function results()
    {
        return $this->_results;
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }

    public function first()
    {
        return $this->_results[0];
    }
}
