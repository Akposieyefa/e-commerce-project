<?php 
namespace app\classes;

/**
 * class Color
 */
class Color extends Color_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function list()
	{
		return $this->get_colors();
	}
}