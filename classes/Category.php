<?php 
namespace app\classes;

/**
 * class Category
 */
class Category extends Category_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function list()
	{
		return $this->get_categories();
	}
}