<?php
namespace app\classes;

/**
 * 
 */

class Women_m 
{
	public $slug = 'women-wear';

	public function list_women_subcategories($slug=FALSE)
	{
		
		$catid = $this->getCategoryID($slug);

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `subcategory` WHERE `categoryID`='$catid->categoryID'");
		$subcategories =  $stmt->fetchAll();

		return $subcategories;
	}

	public function getCategoryID($catSlug)
	{
		$stmt = $this->pdo->preparedStatement("SELECT `categoryID` FROM `categories` WHERE `categorySlug`=?", $catSlug);
		return $stmt->fetch();
	}

	public function getSubCategoryID($subcatSlug)
	{
		$stmt = $this->pdo->preparedStatement("SELECT `subCategoryID` FROM `subcategory` WHERE `subcategorySlug`=?", $subcatSlug);
		return $stmt->fetch();
	}

	public function pagination($args=NULL)
	{
		$catid = $this->getCategoryID([$this->slug]);

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `products` WHERE `categoryID`='$catid->categoryID' ORDER BY RAND ()  LIMIT ?,?", $args);

		return $stmt->fetchAll();
	}

	public function get_category_products_results($slug,$args=NULL)
	{
		$subcatid = $this->getSubCategoryID([$slug]);
		
		$catid = $this->getCategoryID([$this->slug]);

		$stmt = $this->pdo->preparedStatement("SELECT * FROM `products` WHERE `categoryID`='$catid->categoryID' AND `subCategoryID`='$subcatid->subCategoryID' ORDER BY RAND ()  LIMIT ?,?", $args);

		return $stmt->fetchAll();
	}

	public function get_brands()
	{
		$stmt = $this->pdo->preparedStatement("SELECT * FROM `brands`");
		return $stmt->fetchAll();
	}

    public function get_categories()
    {
        $stmt = $this->pdo->preparedStatement("SELECT * FROM `categories`");
        return $stmt->fetchAll();
    }

	public function products_results($slug=NULL,$per_page,$page)
    {
        
        if(!empty($slug)){

			$subcatid = $this->getSubCategoryID([$slug]);
		
			$catid = $this->getCategoryID([$this->slug]);

			$query = $this->pdo->preparedStatement("SELECT COUNT(*) as `totalCount` FROM `products` WHERE `categoryID`='$catid->categoryID' AND `subCategoryID`='$subcatid->subCategoryID'");
	        $rec = $query->fetch();
	        $total = $rec->totalCount;

	        $page = ($page == 0 ? 1 : $page);  
	        
	       
	        $setLastpage = ceil($total/$per_page);
	        
	        $productResult = "";
		        if($setLastpage > 1)
		        {   
		            $productResult .= "<span class='setPage'>Showing $page – $setLastpage of $total results</span>";
		        }
	        return $productResult;

		}else{

			$catid = $this->getCategoryID([$this->slug]);
            
	        $query = $this->pdo->preparedStatement("SELECT COUNT(*) as `totalCount` FROM `products` WHERE `categoryID`='$catid->categoryID'");
	        $rec = $query->fetch();
	        $total = $rec->totalCount;

	        $page = ($page == 0 ? 1 : $page);  
	        
	       
	        $setLastpage = ceil($total/$per_page);
	        
	        $productResult = "";
	        if($setLastpage > 1)
	        {   
	            $productResult .= "<span class='setPage'>Showing $page – $setLastpage of $total results</span>";
	        }
	        return $productResult;
		}       
		
    }

    public function displayPaginationBelow($slug=NULL,$per_page,$page){

    	if(!empty($slug)){

			$subcatid = $this->getSubCategoryID([$slug]);

			$catid = $this->getCategoryID([$this->slug]);

        $page_url="?";
            
        $query = $this->pdo->preparedStatement("SELECT COUNT(*) as `totalCount` FROM `products` WHERE `categoryID`='$catid->categoryID' AND `subCategoryID`='$subcatid->subCategoryID'");
        $rec = $query->fetch();
        $total = $rec->totalCount;
        $adjacents = "2"; 

        $page = ($page == 0 ? 1 : $page);  
        $start = ($page - 1) * $per_page;                               
        
        $prev = $page - 1;                          
        $next = $page + 1;
        $setLastpage = ceil($total/$per_page);
        $lpm1 = $setLastpage - 1;
        
        $setPaginate = "";
        if($setLastpage > 1)
        {   
            $setPaginate .= "<div class='product__pagination'>";
                    $setPaginate .= "<span class='setPage'>Page $page of $setLastpage</span>";
                     $setPaginate .= "<a href='{$page_url}page=$prev'>prev</a>";
            if ($setLastpage < 7 + ($adjacents * 2))
            {   
                for ($counter = 1; $counter <= $setLastpage; $counter++)
                {
                    if ($counter == $page)
                        $setPaginate.= "<a class='active'>$counter</a>";
                    else
                        $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                }
            }
            elseif($setLastpage > 5 + ($adjacents * 2))
            {
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<a class='active'>$counter</a>";
                        else
                            $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                    }
                    $setPaginate.= "<span>...</span>";
                    $setPaginate.= "<a href='{$page_url}page=$lpm1'>$lpm1</a>";
                    $setPaginate.= "<a href='{$page_url}page=$setLastpage'>$setLastpage</a>";      
                }
                elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $setPaginate.= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate.= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate.= "<span>...</span>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<a class='active'>$counter</a>";
                        else
                            $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                    }
                    $setPaginate.= "<span>..</span>";
                    $setPaginate.= "<a href='{$page_url}page=$lpm1'>$lpm1</a>";
                    $setPaginate.= "<a href='{$page_url}page=$setLastpage'>$setLastpage</a>";      
                }
                else
                {
                    $setPaginate.= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate.= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate.= "<span>..</span>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<a class='active'>$counter</a>";
                        else
                            $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                    }
                }
            }
            
            if ($page < $counter - 1){ 
               $setPaginate.= "<a href='{$page_url}page=$next'>Next</a>&nbsp;&nbsp;&nbsp;";
               $setPaginate.= "<a href='{$page_url}page=$setLastpage'>Last</a>";
            }else{
                $setPaginate.= "<a >Next</a>&nbsp;&nbsp;&nbsp;";
                $setPaginate.= "<a >Last</a>";
            }
           
            $setPaginate.= "</div";

            return $setPaginate; 

		}

	}else{

    	$catid = $this->getCategoryID([$this->slug]);

        $page_url="?";
            
        $query = $this->pdo->preparedStatement("SELECT COUNT(*) as `totalCount` FROM `products` WHERE `categoryID`='$catid->categoryID'");
        $rec = $query->fetch();
        $total = $rec->totalCount;
        $adjacents = "2"; 

        $page = ($page == 0 ? 1 : $page);  
        $start = ($page - 1) * $per_page;                               
        
        $prev = $page - 1;                          
        $next = $page + 1;
        $setLastpage = ceil($total/$per_page);
        $lpm1 = $setLastpage - 1;
        
        $setPaginate = "";
        if($setLastpage > 1)
        {   
            $setPaginate .= "<div class='product__pagination'>";
                    $setPaginate .= "<span class='setPage'>Page $page of $setLastpage</span>";
                     $setPaginate .= "<a href='{$page_url}page=$prev'>prev</a>";
            if ($setLastpage < 7 + ($adjacents * 2))
            {   
                for ($counter = 1; $counter <= $setLastpage; $counter++)
                {
                    if ($counter == $page)
                        $setPaginate.= "<a class='active'>$counter</a>";
                    else
                        $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                }
            }
            elseif($setLastpage > 5 + ($adjacents * 2))
            {
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<a class='active'>$counter</a>";
                        else
                            $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                    }
                    $setPaginate.= "<span>...</span>";
                    $setPaginate.= "<a href='{$page_url}page=$lpm1'>$lpm1</a>";
                    $setPaginate.= "<a href='{$page_url}page=$setLastpage'>$setLastpage</a>";      
                }
                elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $setPaginate.= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate.= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate.= "<span>...</span>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<a class='active'>$counter</a>";
                        else
                            $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                    }
                    $setPaginate.= "<span>..</span>";
                    $setPaginate.= "<a href='{$page_url}page=$lpm1'>$lpm1</a>";
                    $setPaginate.= "<a href='{$page_url}page=$setLastpage'>$setLastpage</a>";      
                }
                else
                {
                    $setPaginate.= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate.= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate.= "<span>..</span>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
                    {
                        if ($counter == $page)
                            $setPaginate.= "<a class='active'>$counter</a>";
                        else
                            $setPaginate.= "<a href='{$page_url}page=$counter'>$counter</a>";                  
                    }
                }
            }
            
            if ($page < $counter - 1){ 
               $setPaginate.= "<a href='{$page_url}page=$next'>Next</a>&nbsp;&nbsp;&nbsp;";
               $setPaginate.= "<a href='{$page_url}page=$setLastpage'>Last</a>";
            }else{
                $setPaginate.= "<a >Next</a>&nbsp;&nbsp;&nbsp;";
                $setPaginate.= "<a >Last</a>";
            }
           
            $setPaginate.= "</div";

            return $setPaginate;      
                
        }

    } 
      

    }

} //class