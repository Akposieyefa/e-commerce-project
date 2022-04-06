<?php
namespace app\classes;

/**
 * 
 */

class Category_m
{
	
	public function get_categories($slug=FALSE)
	{
		if ($slug === FALSE) {
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `categories`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `categories` WHERE `categorySlug`=?", $slug);
		return $stmt->fetch();
	}
	
} //class