<?php
namespace app\classes;

/**
 * 
 */

class Order extends Order_m
{
    
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function orders($value='')
    {
        return $this->get_orders($value);
    }

    public function get_order_detail($value='')
    {
        return $this->get_order_details($value);
    }
}