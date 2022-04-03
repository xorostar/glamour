<?php

class Pages extends Controller
{

	public function __construct()
	{ }

	public function index()
	{
		$storeModel = $this->loadModel('Store');
		$menuModel = $this->loadModel('Menu');
		$slider_images = $storeModel->getSliderImages();
		$featuredSubmenuItems = $menuModel->getFeaturedSubmenuItems();
		$featuredMenuItems = $menuModel->getFeaturedMenuItems();
		$this->loadView('pages/homepage', ['active' => 'homepage', 'featured_menu_items' => $featuredMenuItems, 'featured_submenu_items' => $featuredSubmenuItems, 'slider_images' => $slider_images]);
	}

	public function page($title)
	{
		$page = $this->loadModel('Page');
		$pageData = $page->getPage($title);
		$this->loadView('pages/page', ['active' => 'pages', 'page' => $pageData]);
	}

	public function lookbook()
	{
		$imageModel = $this->loadModel('Image');
		$images = $imageModel->getImages();
		$this->loadView('pages/lookbook', ['active' => 'lookbook', 'images' => $images]);
	}
}