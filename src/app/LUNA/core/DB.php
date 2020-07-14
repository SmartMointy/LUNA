<?php namespace LUNA\core;

//Database class that adds some functionality to query the db more easily

use PDO;
use PDOException;

class DB
{
    // Connection config vars and instance var
    protected static ?DB $INSTANCE = null;
    protected string $DB_NAME;
    protected string $DB_PASSWORD;
    protected string $DB_HOST;
    protected string $DB_DATABASE;

    protected ?PDO $_pdo = null;
    protected $_query;
    protected bool $_error = false;
    protected array $_results;
    protected int $_count = 0;

    public function __construct()
    {
        if ($this->_pdo != null) {
            return;
        }

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
    
    public static function getInstance() : DB
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new DB();
        }
        
        return self::$INSTANCE;
    }
    
    public function query(string $sql, array $params = []) : DB
    {
        // Reset
        $this->_error = false;
        $this->_count = 0;
        $this->_results = [];

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

    private function action(string $action, string $table, array $where, int $limit = 0, array $order = []) : DB
    {
        // Allowed operators
        $operators = array('=', '>','<', '>=', '<=');

        // Split the where var
        $field = $where[0];
        $operator = $where[1];
        $value = $where[2];

        if (in_array($operator, $operators)) {
            if ($limit > 0) {
                $limit = 'LIMIT ' . $limit;
            } else {
                $limit = '';
            }

            if (count($order) == 2) {
                $order = 'ORDER BY ' . $order[0] . ' ' . $order[1];
            } else {
                $order = '';
            }

            $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? {$order} {$limit}";

            $this->query($sql, array($value));
        }

        return $this;
    }

    public function get(string $table, string $fields = '*', array $where = [], int $limit = 0, array $order = [])
    {
        return $this->action('SELECT ' . $fields, $table, $where, $limit, $order);
    }

    public function insert(string $table, array $fields) : bool
    {
        $keys = '`' . implode("`, `", array_keys($fields)) . '`';
        $values = '';
        $length = count($fields);

        for ($i = 1; $i < $length; $i++) {
            $values .= '?, ';
        }

        $values .= '?';

        return !$this->query('INSERT INTO ' . $table . ' (' . $keys . ') VALUES (' . $values . ')', $fields)->error();
    }

    public function update(string $table, array $where) : bool
    {
        return !$this->action('DELETE *', $table, $where)->_error;
    }

    public function delete(string $table, array $where = []) : bool
    {
        return !$this->action('DELETE *', $table, $where)->_error;
    }

    public function results() : array
    {
        return $this->_results;
    }

    public function error() : bool
    {
        return $this->_error;
    }

    public function count() : int
    {
        return $this->_count;
    }

    public function first() : object
    {
        return $this->_results[0];
    }
}
