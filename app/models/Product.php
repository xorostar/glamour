<?php
class Product
{

	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	// Fetching all products
	public function getProducts()
	{
		$this->db->query('SELECT * FROM products, submenu_items, menu_items WHERE submenu_items.menu_item_id = menu_items.menu_item_id AND products.menu_item_id = submenu_items.submenu_item_id ORDER BY created_at DESC');
		$results = $this->db->fetchAll();
		return $results;
	}

	public function getproductImages($id)
	{
		$this->db->query("SELECT * FROM product_images WHERE product_id = $id");
		return $this->db->fetchAll();
	}
	public function clearProductImages($id)
	{
		$this->db->query("DELETE FROM product_images WHERE product_id = $id");
		return $this->db->execute();
	}

	// Fetching products by category
	public function getProductsBySubmenuId($menu_id, $sort_by, $sort_order)
	{
		$this->db->query("SELECT *, (price * ((100-discount_rate)/100)) AS discounted_price  FROM products WHERE menu_item_id = :menu_id AND visibility = true ORDER BY {$sort_by} {$sort_order}");
		$this->db->bind(':menu_id', $menu_id);
		$products = $this->db->fetchAll();
		$array['products'] = $products;
		$this->db->query("SELECT COUNT(*) AS count FROM products WHERE menu_item_id = :menu_id AND visibility = true");
		$this->db->bind(':menu_id', $menu_id);
		$count = $this->db->fetchOne()->count;
		$array['count'] = $count;
		return $array;
	}


	// Fetching products by category
	public function getProductsByMenuId($menu_id, $sort_by, $sort_order)
	{
		$this->db->query("SELECT *, (price * ((100-discount_rate)/100)) AS discounted_price FROM products WHERE visibility = true AND menu_item_id IN(SELECT submenu_item_id FROM submenu_items WHERE menu_item_id = :menu_id) ORDER BY {$sort_by} {$sort_order}");
		$this->db->bind(':menu_id', $menu_id);
		$products = $this->db->fetchAll();
		$array['products'] = $products;
		$this->db->query("SELECT COUNT(*) AS count FROM products WHERE visibility = true AND menu_item_id IN(SELECT submenu_item_id FROM submenu_items WHERE menu_item_id = :menu_id)");
		$this->db->bind(':menu_id', $menu_id);
		$count = $this->db->fetchOne()->count;
		$array['count'] = $count;
		return $array;
	}

	public function getProduct($id)
	{
		$this->db->query('SELECT * FROM products WHERE product_id = :id');
		$this->db->bind(':id', $id);
		$results = $this->db->fetchOne();
		return $results;
	}


	public function addProduct($data)
	{
		$this->db->query('INSERT INTO products(product_name, menu_item_id, discount_rate, price, quantity, description, SKU) VALUES(:name, :menu_item_id, :discount, :price, :quantity, :description, :SKU)');
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':menu_item_id', $data['menu_item_id']);
		$this->db->bind(':discount', $data['discount']);
		$this->db->bind(':price', $data['price']);
		$this->db->bind(':quantity', $data['quantity']);
		$this->db->bind(':description', $data['description']);
		$this->db->bind(':SKU', $data['sku']);
		if ($this->db->execute()) {
			$this->db->query("SELECT LAST_INSERT_ID() AS id");
			return $this->db->fetchOne()->id;
		} else {
			return false;
		}
	}

	public function updateProduct($data)
	{
		$this->db->query('UPDATE products SET product_name = :name, menu_item_id = :menu_item_id, discount_rate = :discount, price = :price, quantity = :quantity, description = :description, SKU = :SKU WHERE product_id = :product_id');
		$this->db->bind(':product_id', $data['product_id']);
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':menu_item_id', $data['menu_item_id']);
		$this->db->bind(':discount', $data['discount']);
		$this->db->bind(':price', $data['price']);
		$this->db->bind(':quantity', $data['quantity']);
		$this->db->bind(':description', $data['description']);
		$this->db->bind(':SKU', $data['sku']);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function saveImage($product_id, $image_uri)
	{
		$this->db->query('INSERT INTO product_images(product_id, image_uri) VALUES(:product_id, :image_uri)');
		$this->db->bind(':product_id', $product_id);
		$this->db->bind(':image_uri', $image_uri);
		$this->db->execute();
	}


	public function incrementViews($id)
	{
		$this->db->query('UPDATE products SET views = views + 1 WHERE product_id = :id');
		$this->db->bind(':id', $id);
		$this->db->execute();
	}

	public function getProductReviews($id)
	{
		$this->db->query('SELECT pr.created_at, pr.review_summary, pr.review, c.first_name, c.last_name FROM product_reviews AS pr INNER JOIN customers AS c ON c.customer_id = pr.customer_id WHERE pr.product_id = :id');
		$this->db->bind(':id', $id);
		$results = $this->db->fetchAll();
		return $results;
	}
	public function deleteProduct($id)
	{
		$this->db->query("UPDATE products SET visibility = false WHERE product_id = :id");
		$this->db->bind(':id', $id);
		$this->db->execute();
	}
	public function setProductVisible($id)
	{
		$this->db->query("UPDATE products SET visibility = true WHERE product_id = :id");
		$this->db->bind(':id', $id);
		$this->db->execute();
	}
	public function setProductInvisible($id)
	{
		$this->db->query("UPDATE products SET visibility = false WHERE product_id = :id");
		$this->db->bind(':id', $id);
		$this->db->execute();
	}

	public function getBestSellingProductIds($limit)
	{
		$this->db->query("SELECT product_id FROM order_items GROUP BY product_id ORDER BY COUNT(product_id) DESC LIMIT $limit");
		$results = $this->db->fetchAll();
		return $results;
	}

	public function getMostViewedProducts($limit)
	{
		$this->db->query("SELECT * FROM products ORDER BY views DESC LIMIT $limit");
		$results = $this->db->fetchAll();
		return $results;
	}
}