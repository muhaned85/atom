<?php

namespace Atom\Core\Concerns;

use Atom\Core\Concerns\BaseObject;
use Atom\Core\Concerns\Validator;
use ORM;

class Model extends BaseObject
{
 
    public $tableName;
    public $safe = [];
    protected $orm_table;
    public  $action = '';
    public   $primaryKey = '';
    public function getAttribute()
    {
        return $this->prop;
    }
    public function Load($controller)
    {
        $safes = array_flip($this->safe);
        foreach ($controller->prop as $key => $value) {
            if (isset($safes[$key])) {
                $this->$key = $value;
            }
        }
    }
    public function loadAndValidation($contoller)
    {
        $this->load($contoller);
        $this->validation();
    }
    public function rules()
    {
        return  [];
    }
    public function __construct()
    { 
        ORM::configure("mysql:host=".DB_HOST.";dbname=".DB_DATABASE);
        ORM::configure('username', DB_USER);
        ORM::configure('password', DB_PASS);
        ORM::configure('id_column',$this->primaryKey);
        $this->orm_table= ORM::for_table($this->tableName);
    }
    public function validation()
    {
        if (!isset($this->rules()[$this->action])) return;
        foreach ($this->rules()[$this->action]  as $field => $rule) {
           
            $validator = new Validator;
            $validator->validate($field, $this->{$field}, $rule);
        }
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }
    public   function __call($method, $parameters)
    {
       // $orm = new Orm($this->tableName, $this->pdo);
      //  return   $orm->{$method}($parameters);
      return $this->orm_table->$method(...$parameters);
    }
    public function save()
    {
        $record =  $this->orm_table->create();
      
        foreach ($this->getAttribute() as $key => $value) {
            $record->$key = $value;
        }
        if ($record->save()) {
           return      $record->as_array();
          
        } else {
          return false;
        }
    }

}
