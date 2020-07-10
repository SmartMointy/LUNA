<?php namespace LUNA\libs;

class Validate
{
    private $_passed = false;
    private $_errors = array();
    private $_items = array();
    private $_db;

    public function __construct($file)
    {
        $this->_db = DB::getInstance();

        $path = ROOT . '/app/validation/' . $file . '.val.php';

        if (!empty($file) && file_exists($path)) {
            // get the array with the validation settings
            $this->_items = require $path;
        }
    }

    public function check($source)
    {
        if (empty($this->_items)) {
            $this->_passed = false;
            return $this;
        }

        foreach ($this->_items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];

                if ($rule === 'required' && empty($value)) {
                    $this->addError(100, $item);
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError(101, $item);
                            }
                        break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError(102, $item);
                            }
                        break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError(103, $item);
                            }
                        break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError(104, $item);
                            }
                        break;
                        case 'allowed_chars':
                            preg_match('/^[' . $rule_value . ']+$/', $value, $check);
                            if (empty($check)) {
                                $this->addError(105, $item);
                            }
                        break;
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($err_code, $item)
    {
        $item = strtoupper($item);
        
        switch ($err_code) {
            case 100:
                $this->_errors[] = Language::Message($item . '_IS_REQUIRED');
            break;
            case 101:
                $this->_errors[] = Language::Message($item . '_IS_SHORT');
            break;
            case 102:
                $this->_errors[] = Language::Message($item . '_IS_LONG');
            break;
            case 103:
                $this->_errors[] = Language::Message($item . '_NO_MATCH');
            break;
            case 104:
                $this->_errors[] = Language::Message($item . '_ALREADY_EXISTS');
            break;
            case 105:
                $this->_errors[] = Language::Message($item . '_ALLOWED_CHARS');
            break;
            case 106:
                $this->_errors[] = Language::Message($item . '_UNALLOWED_CHARS');
            break;
        }
    }

    public function errors()
    {
        return $this->_errors;
    }
    
    public function passed()
    {
        return $this->_passed;
    }
}
