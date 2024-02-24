<?php


namespace  Atom\Model;

use Atom\Core\Concerns\Model;

class T_Name extends Model
{
    public $tableName = "table";
    public $primaryKey='user_id';
    public $action = '';
    public $safe = [''];

    public function __construct()
    {
        parent::__construct("tabel");
    }
    public function rules()
    {
        return
            [
                'action' => [
                    'parm' => 'required',
                ]
                 
            ];
    }
    
}
