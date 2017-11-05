<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.09.2017
 * Time: 22:42
 */

namespace app\components;

class Obj
{
    function __construct($arr)
    {
        foreach($arr as $key=>$val)
        {
            $this->$key = $val;
        }
    }
    private $data = [];

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->data[$name] = $value;

    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        else
            return null;
    }
}