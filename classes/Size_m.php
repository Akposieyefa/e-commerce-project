<?php
namespace app\classes;

/**
 * 
 */

class Size_m
{
	
	public function get_sizes($slug=FALSE)
	{
		if ($slug === FALSE) {
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `sizes`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `sizes` WHERE `name`=?", $slug);
		return $stmt->fetch();
	}
	
} //class