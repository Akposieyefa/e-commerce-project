<?php
namespace app\classes;

/**
 * 
 */

class Subcategory_m
{
	
	public function get_subcategories($slug=FALSE)
	{
		if ($slug === FALSE) {
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `subcategory`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `subcategory` WHERE `subCategorySlug`=?", $slug);
		return $stmt->fetch();
	}
	
} //class