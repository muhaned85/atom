<?php 

class sql
{
    private $_select,$_where,$_from;

    public function __construct($tabel)
    {
        $this->_from=$tabel;
        $this->_where=['name'=>'muhamed'];
    }

    public function select($fildes="*")
    {
        $this->_select=$fildes;
        return $this;
    }
    public function where($condations=[])
    {
        $this->_where= array_merge($this->_where,$condations);
  
        return $this;
    }
    private function whereToString($condations)
    {
        $where='';
        foreach($condations as $fild=>$value)
        {
            $where.="(".$fild."='".$value."') and ";
        }
        return trim( $where," and ");
    }
    public function get()
    {
        return "select ".implode(",",$this->_select) 
        ." form " . $this->_from. " where " . $this->whereToString($this->_where);

    }
}

echo (new Sql("user"))->select(["id","name"])->where(['Id'=>3])->where(["ip"=>"111"])->get();