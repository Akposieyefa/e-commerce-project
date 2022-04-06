<?php
namespace app\classes;

/**
 * 
 */
use app\config\Functions;

class Shop_m 
{
	

	public function colors($slug)
	{
		$productID = $this->get_shop($slug)->productID;

		$colors= $this->pdo->preparedStatement("SELECT DISTINCT c.name as color, c.hex FROM product_relation r INNER JOIN colors c ON r.colorID = c.colorId WHERE r.productID='$productID'")->fetchAll();

			return $colors;
	}

	/*SELECT cat.categoryName, cat.categorySlug, sub.subCategoryName, sub.subCategorySlug, c.name as color, c.hex, s.name as sizes FROM product_relation r INNER  JOIN categories cat ON r.categoryID = cat.categoryID INNER JOIN subcategory sub ON r.subCategoryID = sub.subCategoryID INNER JOIN colors c ON r.colorID = c.colorId INNER JOIN sizes s ON r.sizeID = s.sizeId WHERE r.productID='1'*/

	public function sizes($slug)
	{
		$productID = $this->get_shop($slug)->productID;

		$sizes= $this->pdo->preparedStatement("SELECT DISTINCT s.name as sizes FROM product_relation r INNER JOIN sizes s ON r.sizeID = s.sizeId WHERE r.productID='$productID'")->fetchAll();

			return $sizes;
	}

	public function product_category($slug)
	{
		$productID = $this->get_shop($slug)->productID;
		$category = $this->pdo->preparedStatement("SELECT cat.categoryName, cat.categorySlug FROM product_relation r INNER JOIN categories cat ON r.categoryID = cat.categoryID WHERE r.productID='$productID'")->fetch();

		return $category;

	}

	public function product_subcategory($slug)
	{
		$productID = $this->get_shop($slug)->productID;
		$subcategory = $this->pdo->preparedStatement("SELECT sub.subCategoryName, sub.subCategorySlug FROM product_relation r INNER JOIN subcategory sub ON r.subCategoryID = sub.subCategoryID WHERE r.productID='$productID'")->fetch();

		return $subcategory;

	}

	public function related_product($slug)
	{
		$subCategoryID = $this->get_shop($slug)->subCategoryID;
		if($subCategoryID == ''){
			$categoryID = $this->get_shop($slug)->categoryID;
			$relatedProducts = $this->pdo->preparedStatement("SELECT * FROM products p WHERE p.categoryID='$categoryID' ORDER BY RAND ()  LIMIT 4")->fetchAll();

			return $relatedProducts;
		}else{

			$relatedProducts = $this->pdo->preparedStatement("SELECT * FROM products p WHERE p.subCategoryID='$subCategoryID' ORDER BY RAND ()  LIMIT 4")->fetchAll();

			return $relatedProducts;
		}
		
	}

	public function get_shop($slug=FALSE)
	{
		if($slug === FALSE){
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `products`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `products` WHERE `productSlug`=?", $slug);
		return $product =  $stmt->fetch();
		
	}

	public function pagination($args=NULL)
	{
		$stmt = $this->pdo->preparedStatement("SELECT * FROM `products` ORDER BY RAND ()  LIMIT ?,?", $args);
		return $stmt->fetchAll();
		
	}

	public function get_categories($slug=FALSE)
	{
		if ($slug === FALSE) {
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `categories`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `categories` WHERE `categorySlug`=?", $slug);
		return $stmt->fetch();
	}

	public function get_brands($slug=FALSE)
	{
		if ($slug === FALSE) {
			$stmt = $this->pdo->preparedStatement("SELECT * FROM `brands`");
			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `brands` WHERE `brandSlug`=?", $slug);
		return $stmt->fetch();
	}

	public function add_new_product($value='')
	{
		$functions = new Functions();

		if(empty($value['admin_user_id'])){
			return false;
		}

		$product_name = $value['product_name'];
		$category_id = $value['category_id'];
		$sub_category_id = $value['sub_category_id'] ?? '';
		$product_sku = $value['product_sku'] ?? 'Null';
		$product_price = $value['product_price'];
		$product_desc = $value['product_desc'];
		$product_picture = $value['product_picture'];
		$trend = $value['trend'] ?? 'Null';
		$slug = $functions->url_string($product_name);

		if($this->pdo->preparedStatement("INSERT INTO `products` (`categoryID`, `subCategoryID`, `SKU`, `productName`, `productDesc`, `productSlug`, `productUnitPrice`, `productPicture`, `productAvailable`, `trend`) VALUES ('$category_id', '$sub_category_id', '$product_sku', '$product_name', '$product_desc', '$slug', '$product_price', '$product_picture', 1, '$trend')"))
		{

			$lastInsertId = $this->pdo->lastInsertId();

			foreach ($value['sizes'] as $key => $sizes) {
				foreach($value['colors'] as $key => $colors){
					
					$this->pdo->preparedStatement("INSERT INTO `product_relation` (`productID`, `categoryID`, `subCategoryID`, `colorID`, `sizeID`) VALUES ('$lastInsertId', '$category_id', '$sub_category_id', '$colors', '$sizes')");

				}
			}

			return true;
		}

	}

	public function check_product_exists($name)
    {
        $stmt = $this->pdo->numberOfRows("SELECT count(*) FROM products WHERE productName='$name'");

        if($stmt > 0){
            return true;
        }else{
            return false;
        }
    }

} //class