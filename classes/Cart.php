<?php
namespace app\classes;

/**
 * Class Cart
 */


class Cart extends Cart_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function add_cart($value='')
	{
		return $this->add_carts($value);
	}

	public function update_cart($value='')
	{
		return $this->update_carts($value);
	}

	public function remove_cart($value='')
	{
		return $this->remove_carts($value);
	}

	public function empty_cart($value='')
	{
		return $this->empty_carts($value);
	}

	public function load_checkout($value='')
	{
		return $this->load_checkouts($value);
	}

	public function fetch_cart($value='')
	{
		return $this->fetch_carts($value);
	}

	public function cart_detail($value='')
	{
		return $this->cart_details();
	}

	// display country on checkout page.
	public function load_country($value='')
	{
		return $this->load_countries();
	}

	public function place_order($value='')
	{
		return $this->place_orders($value);
	}

	// function to place order and create user account with checkout details.
	public function place_order_acct($cust_id='',$value='')
	{
		return $this->place_order_accts($cust_id,$value);
	}
}