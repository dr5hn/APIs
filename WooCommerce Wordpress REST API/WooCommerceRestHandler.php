<?php
require_once("SimpleRest.php");
require_once("Example.php");

//Master Mind Class
class WooCommerceRestHandler extends SimpleRest {

	// Get All Categories Handler
	function getAllCategories() {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getAllCategories();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Categories found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

	// Get All Products Handler
	function getAllProducts() {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getAllProducts();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Products found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

    // Get All Products Handler
    function getPaginatedProducts($page) {

        $woocommerce = new WooCommerce();
        $rawData = $woocommerce->getPaginatedProducts($page);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData = array('error' => 'No Products found!');
        } else {
            $statusCode = 200;
            $response = $this->encodeJson($rawData);
            echo $response;
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this ->setHttpHeaders($requestContentType, $statusCode);

    }

	// Get Limited no. of Categories Handler
	function getCategoriesByLimit($no_of_results) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getCategoriesByLimit($no_of_results);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Categories found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

	// Get trending Products Handler
	function getTrendingProducts($no_of_results, $sort) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getTrendingProducts($no_of_results, $sort);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Products found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
	}

	// Get limited no. of Products Handler
	function getProductsByLimit($no_of_results) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getProductsByLimit($no_of_results);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Products found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
	}

	// Search Categories Handler
	public function searchCategories($search) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->searchCategories($search);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Categories with that search term found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

	// Search Products Handler
	public function searchProducts($search) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->searchProducts($search);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Procuct with that search term found!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

	// Search Products Handler
	public function searchSingleProductById($product_id) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->searchSingleProductById($product_id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Product with that search term found!');
		} else {
			$statusCode = 200;
			//print_r($prodData);
			$response = $this->encodeJson($rawData);
			echo $response;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

	//Get All Products by Category
	public function getAllProductByCategoryId($category_id) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getAllProductByCategoryId($category_id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Product exist!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

	}

	//Get Paginated Products by Category
	public function getPaginatedProductByCategoryId($category_id,$page) {

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getPaginatedProductByCategoryId($category_id,$page);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Product exist!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this->setHttpHeaders($requestContentType, $statusCode);

	}

	//Get All Recipes
	public function getAllRecipes()	{

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getAllRecipes();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData= array('error' => 'No Recipes exist !');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this->setHttpHeaders($requestContentType,$statusCode);

	}

	//Get Recipes by Id
	public function getRecipesById($id)	{

		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getRecipesById($id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData= array('error' => 'No Recipes exist !');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this->setHttpHeaders($requestContentType,$statusCode);

	}

	//Get Nav Menu
	public function getNavMenu() {
		$woocommerce = new WooCommerce();
		$rawData = $woocommerce->getNavMenu();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData= array('error' => 'No Menu Found !!');
		} else {
			$statusCode = 200;
			$response = $this->encodeJson($rawData);
			echo $response;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this->setHttpHeaders($requestContentType,$statusCode);
	}


	// Get Add to Cart Handler
	function addToCart($id) {

		$woocommerce = new Woocommerce();
		$rawData = $woocommerce->addToCart($id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Product with that ID found!');
		} else {
			$statusCode = 200;
			header("Location:".$rawData."");
		}

		/*$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);*/
	}

	// Function to Encode Data in HTML
	public function encodeHtml($responseData) {

		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;
	}

	// Function to Encode Data in JSON Format
	public function encodeJson($responseData) {
		//$responseData = array_walk_recursive($responseData, function (&$val) { $val = strip_tags($val); });
		$jsonResponse = json_encode($responseData, JSON_FORCE_OBJECT, JSON_PRETTY_PRINT);
		return $jsonResponse;
	}

	// Function to Encode Data in XML Format
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
}
?>