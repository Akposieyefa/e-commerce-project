<?php 
namespace app\classes;

/**
 * class Color
 */
class Size extends Size_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function list()
	{
		return $this->get_sizes();
	}
}