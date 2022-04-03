<?php
class Order
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
	
	public function getOrders(){
        $this->db->query("SELECT * FROM orders ORDER BY date DESC");  
		$results = $this->db->fetchAll();
        return $results;
	}
	
	public function getOrder($id){
        $this->db->query("SELECT * FROM orders, order_items WHERE orders.order_id = :id AND orders.order_id = order_items.order_id"); 
		$this->db->bind(":id", $id);     
		$results = $this->db->fetchAll();
        return $results;
	}
	
	public function getOrdersByLimit($limit){
        $this->db->query("SELECT * FROM orders ORDER BY date DESC LIMIT $limit");        
		$results = $this->db->fetchAll();
        return $results;
	}

    public function getLifetimeSales()
    {
        $this->db->query("SELECT SUM(total_amount) AS lifetime_sales FROM orders WHERE status = 'Delivered'");        
		$results = $this->db->fetchOne();
        return $results->lifetime_sales;
    }
	
    public function getAverageOrder()
    {
        $this->db->query("SELECT AVG(total_amount) AS average_order FROM orders WHERE status = 'Delivered'");        
		$results = $this->db->fetchOne();
        return $results->average_order;
    }
	
	public function getOrdersCount(){
        $this->db->query("SELECT COUNT(*) AS order_count FROM orders");        
		$results = $this->db->fetchOne();
        return $results->order_count;
	}
	
	public function getPendingOrdersCount(){
        $this->db->query("SELECT COUNT(*) AS pending_order_count FROM orders WHERE status = 'Pending'");        
		$results = $this->db->fetchOne();
        return $results->pending_order_count;
	}
	
	public function setOrderStatus($id, $status){
        $this->db->query("UPDATE orders SET status = '$status' WHERE order_id = $id");        
		return $this->db->execute();
	}
	
}
