<?php
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://www.website.com/',
    'ck_72315603e9d4b0461dab8d7fac3b71675eecc32a',
    'cs_08a154c9ee06be3e2b2529602963b9a102723a60',
    [
        'wp_api' => true,
        'version' => 'wc/v2',
        'query_string_auth' => true
    ]
);

//$cart_url = "http://localhost/test_wp/cart/";

//Class with Functions
class WooCommerce {

    //Connecting to Woocommerce Api and Fetching all Products
    public function getAllProducts() {
        global $woocommerce;

        $products = $woocommerce->get('products',array('per_page'=>'100'));
        return $products;
    }

    //Connecting to Woocommerce Api and Fetching all Products
    public function getPaginatedProducts($page) {
        global $woocommerce;

        $products = $woocommerce->get('products',array('per_page'=>'100','page'=>$page));
        return $products;
    }

	/*Connecting to Woocommerce Api and Fetching required trending no. of Products
		@param no_of_results = no. of records to be fetched
		@param sort = asc/desc
	*/
    public function getTrendingProducts($no_of_results, $sort) {
        global $woocommerce;

		$data = [
			'order_by' => 'date_created',
			'order' => $sort,
			'per_page' => $no_of_results
		];
        $products = $woocommerce->get('products',$data);
        return $products;
    }

	/*Connecting to Woocommerce Api and Fetching required no. of Products
		@param no_of_results = no. of records to be fetched
		@param sort = asc/desc
	*/
    public function getProductsByLimit($no_of_results) {
        global $woocommerce;

		$data = [
			'per_page' => $no_of_results
		];
        $products = $woocommerce->get('products',$data);
        return $products;
    }

    /*Connecting to Woocommerce Api and Fetching required no. of Products
        @param category_id = Category ID
        @param per_page = No. of results per page
    */
    public function getAllProductByCategoryId($category_id) {
        global $woocommerce;

        $data = [
            'category'=>$category_id,
            'per_page'=>100
        ];
        $products = $woocommerce->get('products',$data);
        return $products;
    }

     /*Connecting to Woocommerce Api and Fetching required no. of Products
        @param category_id = Category ID
        @param per_page = No. of results per page
    */
    public function getPaginatedProductByCategoryId($category_id,$page) {
        global $woocommerce;

        $data = [
            'search'=>$category_id,
            'page'=>$page
        ];
        $products = $woocommerce->get('products',$data);
        return $products;
    }

	//Connecting to Woocommerce Api and Fetching all Categories
    public function getAllCategories() {
         global $woocommerce;

        $categories = $woocommerce->get('products/categories');
		return $categories;
    }

	//Connecting to Woocommerce Api and Fetching limited Categories
    public function getCategoriesByLimit($no_of_results) {
         global $woocommerce;

		 $data = [
			'per_page' => $no_of_results
		];
         $categories = $woocommerce->get('products/categories', $data);
         return $categories;
    }

	 //Connecting to Woocommerce Api and Searching all categories matching text
    public function searchCategories($search_text) {
         global $woocommerce;
         $search_categories = $woocommerce->get('products/categories',array('search'=>$search_text));
         return $search_categories;
    }

    //Connecting to Woocommerce Api and Searching all product matching text
    public function searchProducts($search_text) {
         global $woocommerce;
         $search_products = $woocommerce->get('products',array('search'=>$search_text));
         return $search_products;
    }

	//Connecting to Woocommerce Api and Searching product by product_id
    public function searchSingleProductById($product_id) {
         global $woocommerce;

         $search_products = $woocommerce->get('products/'.$product_id);
         return $search_products;
    }

    /*
        Connecting to Wordpress Api and Fetching all Recipes
    */
    public function getAllRecipes() {
        $recipes = json_decode(file_get_contents('http://website.com/wp-json/wp/v2/cp_recipe?per_page=100'));
        $new_arr = array();

        $i = 0;
        foreach($recipes as $object) {
            foreach ($object as $key => $val) {
               if($key == '_cp_recipe_short_description') {
                    $new_arr[$i][$key] = strip_tags($val);
                } elseif($key == '_links') {
                    $new_arr[$i][$key] = '';
                } elseif($key == '_cp_recipe_directions') {
                    $new_arr[$i][$key] = strip_tags($val);
                } elseif($key == '_cp_recipe_ingredients') {
                    $new_arr[$i][$key] = strip_tags($val);
                } else {
                    $new_arr[$i][$key] = $val;
                }
            }
            $i++;
        }
        return $new_arr;
    }

    /*
        Connecting to Wordpress Api and Fetching Recipes (<Custom Plugin or Post Type>) by Id
    */
    public function getRecipesById($id) {
        $recipes = json_decode(file_get_contents('http://website.com/wp-json/wp/v2/cp_recipe/'.$id));
        $new_arr = array();

        $i = 0;
        foreach ($recipes as $key => $val) {
           if($key == '_cp_recipe_short_description') {
                $new_arr[$key] = strip_tags($val);
            } elseif($key == '_links') {
                $new_arr[$key] = '';
            } elseif($key == '_cp_recipe_directions') {
                $new_arr[$key] = strip_tags($val);
            } elseif($key == '_cp_recipe_ingredients') {
                $new_arr[$key] = strip_tags($val);
            } else {
                $new_arr[$key] = $val;
            }
        }
        return $new_arr;
    }

    /*
        Connecting to Wordpress Api and Fetching Navigation Menu
    */
    public function getNavMenu() {
        $menu = json_decode(file_get_contents('http://website.com/wp-json/spirit/menu'));
        return $menu;
    }

    //Connecting to Woocommerce Api and Adding Products to Cart
    public function addToCart($id) {
         global $woocommerce, $cart_url;
         $add_to_cart = $cart_url.'?add_to_cart='.$id; /* Redirect browser */
         return $add_to_cart;
    }
}


?>