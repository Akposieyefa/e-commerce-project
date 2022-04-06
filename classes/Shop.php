<?php 
namespace app\classes;

/**
 * Class Shop
 */

class Shop extends Shop_m
{
	
	public function __construct($pdo) {
    	$this->pdo = $pdo;
  	}

	public function index($args=NULL)
	{
		return $this->pagination($args);
	}

	public function view($args=NULL)
	{
		return $this->get_shop($args);
	}

	public function create($value='')
	{
		return $this->add_new_product($value);
	}

	public function get_sizes($args=NULL)
	{
		return $this->sizes($args);
	}

	public function get_colors($args=NULL)
	{
		return $this->colors($args);
	}

	public function get_category($args=NULL)
	{
		return $this->product_category($args);
	}

	public function get_subcategory($args=NULL)
	{
		return $this->product_subcategory($args);
	}

	public function get_related_product($args=NULL)
	{
		return $this->related_product($args);
	}

	public function categories($slug=FALSE)
	{
		return $this->get_categories();
	}

	public function brands($slug=FALSE)
	{
		return $this->get_brands();
	}

	public function check_product_exist($name='')
	{
		if($this->check_product_exists($name)){
			return true;
		}else{
			return false;
		}
	}


} //class

?>