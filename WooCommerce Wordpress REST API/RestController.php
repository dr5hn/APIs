<?php
require_once("WooCommerceRestHandler.php");
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){
	case "all-categories":
		// to handle REST Url /products/categories/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getAllCategories();
		break;

	case "limited-categories":
		// to handle REST Url /products/categories/<no-of-cat>
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getCategoriesByLimit($_GET["no_of_results"]);
		break;

	case "all-products":
		// to handle REST Url /products/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getAllProducts();
		break;

    case "paginated-products":
        // to handle REST Url /products/<page-no>
        $woocommerceRestHandler = new WooCommerceRestHandler();
        $woocommerceRestHandler->getPaginatedProducts($_GET['page']);
        break;

	case "trending-products":
		// to handle REST Url /products/<no-of-prod>/<asc/desc>
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getTrendingProducts($_GET["no_of_results"], $_GET["sort"]);
		break;

	case "limited-products":
		// to handle REST Url /products/<no-of-prod>
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getProductsByLimit($_GET["no_of_results"]);
		break;

	case "search-categories":
		// to handle REST Url /products/categories/search/<text>/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->searchCategories($_GET["text"]);
		break;

	case "search-products":
		// to handle REST Url /products/search/<text>/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->searchProducts($_GET["text"]);
		break;

	case "search-product-by-id":
		// to handle REST Url /products/search_by_id/<id>/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->searchSingleProductById($_GET["id"]);
		break;

	case "get-all-product-by-category-id":
		// to handle REST Url /products/category_id/<category_id>/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getAllProductByCategoryId($_GET["id"]);
		break;

	case "paginated-product-by-category-id":
		// to handle REST Url /products/category_id/<category_id>/<page_no>
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getPaginatedProductByCategoryId($_GET["id"],$_GET['page']);
		break;

	case "all-recipes":
		// to handle REST Url /recipes/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getAllRecipes();
		break;

	case "get-recipes-by-id":
		// to handle REST Url /recipes/<recipes_id>
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getRecipesById($_GET['id']);
		break;

	case "add-to-cart":
		// to handle REST Url /add-to-cart/<id>
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->addToCart($_GET["id"]);
		break;

	case "nav-menu":
		// to handle REST Url /menu/
		$woocommerceRestHandler = new WooCommerceRestHandler();
		$woocommerceRestHandler->getNavMenu();
		break;

	case "" :
		//404 - not found;
		break;
}
?>
