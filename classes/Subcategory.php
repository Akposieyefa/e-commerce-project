<?php 
namespace app\classes;

/**
 * class SubCategory
 */
class Subcategory extends Subcategory_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function list()
	{
		return $this->get_subcategories();
	}
}