<?php

class Products extends Controller
{

	public function __construct()
	{ }

	public function index()
	{
		redirect('');
	}

	public function menu($id)
	{
		$sort_by = 'views';
		$sort_order = 'desc';
		if (isset($_GET['sortby'])) {
			switch ($_GET['sortby']) {
				case "position":
					$sort_by = 'views';
					break;
				case "price":
					$sort_by = 'price';
					break;
				case "quantity":
					$sort_by = 'quantity';
					break;
				case "newest":
					$sort_by = 'created_at';
					break;
				default:
					$sort_by = 'views';
			}
		}
		if (isset($_GET['sortorder'])) {
			switch ($_GET['sortorder']) {
				case "asc":
					$sort_order = 'asc';
					break;
				case "desc":
					$sort_order = 'desc';
					break;
				default:
					$sort_order = 'desc';
			}
		}
		$productModel = $this->loadModel('Product');
		$data = $productModel->getProductsByMenuId($id, $sort_by, strtoupper($sort_order));
		$products = $data['products'];
		$count = $data['count'];
		$menuModel = $this->loadModel('Menu');
		$submenuItems = $menuModel->getSubmenuItemsByMenuId($id);
		$active_menuItem = $menuModel->getMenuItemById($id);
		$this->loadView('products/products', ['active' => 'products', 'products' => $products, 'products_count' => $count, 'active_menuItem' => $active_menuItem, 'active_submenuItem' => false, 'submenuItems' => $submenuItems]);
	}

	public function submenu($id)
	{
		$sort_by = 'views';
		$sort_order = 'desc';
		if (isset($_GET['sortby'])) {
			switch ($_GET['sortby']) {
				case "position":
					$sort_by = 'views';
					break;
				case "price":
					$sort_by = 'price';
					break;
				case "quantity":
					$sort_by = 'quantity';
					break;
				case "newest":
					$sort_by = 'created_at';
					break;
				default:
					$sort_by = 'views';
			}
		}
		if (isset($_GET['sortorder'])) {
			switch ($_GET['sortorder']) {
				case "asc":
					$sort_order = 'asc';
					break;
				case "desc":
					$sort_order = 'desc';
					break;
				default:
					$sort_order = 'desc';
			}
		}
		$productModel = $this->loadModel('Product');
		$data = $productModel->getProductsBySubmenuId($id, $sort_by, strtoupper($sort_order));
		$products = $data['products'];
		$count = $data['count'];
		$menuModel = $this->loadModel('Menu');
		$active_menuItem = $menuModel->getMenuItem($id);
		$active_submenuItem = $menuModel->getSubmenuItem($id);
		$this->loadView('products/products', ['active' => 'products', 'products' => $products, 'products_count' => $count, 'active_menuItem' => $active_menuItem, 'active_submenuItem' => $active_submenuItem, 'submenuItems' => []]);
	}

	public function product($id)
	{
		$productModel = $this->loadModel('Product');
		$product = $productModel->getProduct($id);
		$product_reviews = $productModel->getProductReviews($id);
		$productModel->incrementViews($id);
		$this->loadView('products/product', ['active' => 'product', 'product' => $product, 'product_reviews' => $product_reviews]);
	}
}