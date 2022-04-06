<?php
namespace app\classes;

/**
 * 
 */

class Color_m
{
	
	public function get_colors($slug=FALSE)
	{
		if ($slug === FALSE) {
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `colors`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `colors` WHERE `name`=?", $slug);
		return $stmt->fetch();
	}
	
} //class