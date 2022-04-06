<?php 
namespace app\classes;

/**
 * Class Hoodies
 */

class Hoodies extends Hoodies_m
{
	
	public function __construct($pdo) {
    	$this->pdo = $pdo;
  	}

	public function index($args=NULL)
	{
		return $this->pagination($args);
	}

	public function get_category_products($slug,$args=NULL)
	{
		return $this->get_category_products_results($slug,$args);
	}

	public function brands($slug=FALSE)
	{
		return $this->get_brands();
	}

	public function categories($slug=FALSE)
	{
		return $this->get_categories();
	}

	public function product_results($slug,$per_page,$page)
	{
		return $this->products_results($slug,$per_page,$page);
	}


} //class

?>