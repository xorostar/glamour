<?php
class Cart
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
	
    public function getCartItems()
    {
		$user_id = $_SESSION['user_id'];
        $this->db->query("SELECT ci.*, p.product_name, c.customer_id FROM cart_items AS ci, products AS p, cart AS c WHERE ci.cart_id = c.cart_id AND c.customer_id = {$user_id} AND p.product_id = ci.product_id");
        $results = $this->db->fetchAll();
        return $results;
    }
    public function getCartItem($cart_item_id)
    {
		$user_id = $_SESSION['user_id'];
        $this->db->query("SELECT ci.*, p.product_name, c.customer_id FROM cart_items AS ci, products AS p, cart AS c WHERE ci.cart_id = c.cart_id AND c.customer_id = {$user_id} AND p.product_id = ci.product_id AND ci.cart_item_id = {$cart_item_id}");
        $results = $this->db->fetchOne();
        return $results;
    }

    public function getCartItemsCount()
    {
		$user_id = $_SESSION['user_id'];
        $this->db->query("SELECT COUNT(*) AS count FROM cart_items AS ci, cart AS c WHERE ci.cart_id = c.cart_id AND c.customer_id = {$user_id}");
        $results = $this->db->fetchOne();
        return $results;
    }
	
	public function clearShoppingCart($cart_id){
		$user_id = $_SESSION['user_id'];
		$this->db->query("SELECT customer_id FROM cart WHERE cart_id = {$cart_id}");
		$results = $this->db->fetchOne();
		$customer_id = $results->customer_id;
		if($customer_id == $_SESSION['user_id']){
			$this->db->query("DELETE FROM cart_items WHERE cart_id = {$cart_id}");
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
			$this->db->query("DELETE FROM cart WHERE cart_id = {$cart_id} AND customer_id = {$customer_id}");
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function updateCartItem($cart_item_id, $quantity){
		$user_id = $_SESSION['user_id'];
        $this->db->query("SELECT * FROM cart_items WHERE cart_item_id = {$cart_item_id}");
        $results = $this->db->fetchOne();
		$cart = $results;
		$total_price = $quantity * $cart->total_price;
		$cart_id = $results->cart_id;
		$this->db->query("SELECT customer_id FROM cart WHERE cart_id = {$cart_id}");
		$results = $this->db->fetchOne();
		$customer_id = $results->customer_id;
		if($customer_id == $_SESSION['user_id']){
			$this->db->query("UPDATE cart_items SET quantity = {$quantity}, total_price={$total_price} WHERE cart_item_id = {$cart_item_id} AND cart_id = {$cart_id}");
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function removeCartItem($cart_item_id){
		$user_id = $_SESSION['user_id'];
        $this->db->query("SELECT cart_id FROM cart_items WHERE cart_item_id = {$cart_item_id}");
        $results = $this->db->fetchOne();
		$cart_id = $results->cart_id;
		$this->db->query("SELECT customer_id FROM cart WHERE cart_id = {$cart_id}");
		$results = $this->db->fetchOne();
		$customer_id = $results->customer_id;
		if($customer_id == $_SESSION['user_id']){
			$this->db->query("DELETE FROM cart_items WHERE cart_item_id = {$cart_item_id} AND cart_id = {$cart_id}");
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function checkout($cart_id){
		$this->db->query("SELECT customer_id FROM cart WHERE cart_id = {$cart_id}");
		$cart = $this->db->fetchOne();
		$this->db->query("SELECT SUM(total_price) AS sum FROM cart_items WHERE cart_id = {$cart_id}");
		$total_price = $this->db->fetchOne()->sum;
		$customer_id = $cart->customer_id;
		if($customer_id == $_SESSION['user_id']){
			$this->db->query("INSERT INTO orders(customer_name, customer_id, total_amount) VALUES('{$_SESSION['user_name']}', $customer_id, $total_price)");
			$this->db->execute();
			$this->db->query("SELECT LAST_INSERT_ID() AS order_id");
			$order_id = $this->db->fetchOne()->order_id;
			$this->db->query("SELECT * FROM cart_items WHERE cart_id = {$cart_id}");
			$cart_items = $this->db->fetchAll();
			foreach($cart_items as $cart_item){
				$this->db->query("INSERT INTO order_items(order_id, product_id, quantity, product_price, total_price) VALUES({$order_id},{$cart_item->product_id}, {$cart_item->quantity}, {$cart_item->product_price}, {$cart_item->total_price})");	
				$this->db->execute();
			}
			return true;
		}else{
			return false;
		}
	}
	
}
