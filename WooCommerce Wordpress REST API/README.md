Wordpress and WooCommerce REST API
=======================================

## About

A PHP wrapper for the WooCommerce REST API. Easily interact with the WooCommerce & Wordpress REST API using this snippet.

I've created a mixture of 2 Wordpress REST API Libraries. So if one doesn't works. you can work with other library.

Feedback and bug reports are appreciated.

## Requirements

PHP 5.2.x
cURL
WooCommerce 2.2 at least on the store

## Getting started

Generate API credentials (Consumer Key & Consumer Secret) under WP Admin > Your Profile.

## Setup the snippet for WooCommerce

```
I've Created a REST API Route for WooCommerce from Scratch. So let me give you gist about routing structure.

.htaccess                     -- Routing File (Routes to Rest Controller)
Rest-Controller.php           -- Controller pass the request to Functions created in (WooCommerceRestHandler.php)
WooCommerceRestHandler.php    -- Pass the request to Example.php and JSONIFIED Response Recieved from Example.php
Example.php                   -- Where all Logic goes.

To get started
Update Website URL, Consumer Key and Secrets to Example.php or _Example2.php

Base API used for Example.php -- https://github.com/woocommerce/wc-api-php
Base API used for Example_2.php -- https://github.com/kloon/WooCommerce-REST-API-Client-Library

Wordpress API : http://www.website.com/wp-json (All Routes of Wordpress Website REST API Found here)

```

## Routes

Note : Replace content within `<brackets>` as per your requirements.

### Menu

* `http://website.com/api/menu/` - get the menu (Wordpress API)
Note: Gist of code to register Menu to Rest API (https://gist.github.com/dr5hn/e3e9c0af2a0ebe5f76850a5c869c078f)

### Products

* `http://website.com/api/products/` - get all products
* `http://website.com/api/products/<page-no>` - get paginated products //default is 100 per page
* `http://website.com/api/products/<page-no>/<asc/desc>` - sorting products (asc/desc)
* `http://website.com/api/products/<no-of-products>` - get limited products
* `http://website.com/api/products/search/<search-text>` - search products
* `http://website.com/api/products/search_by_id/<id>` - search single product by id
* `http://website.com/api/products/category_id/<category-id>` - get products by category id


### Categories
* `http://website.com/api/products/categories/` - get all categories
* `http://website.com/api/products/categories/<no-of-cat>` - get limited number of categories
* `http://website.com/api/products/categories/search/<search-text>` - search inside categories
* `http://website.com/api/products/categories/` - get all categories
* `http://website.com/api/products/categories/` - get all categories
* `http://website.com/api/products/categories/` - get all categories


### Add to Cart
* `http://website.com/api/add-to-cart/<id>` - add-to-cart product with api

## For any help
* `mail-me-at : gadadarshan[at]gmail[dot]com`
