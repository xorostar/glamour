<?php
class MenuItems
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Fetching all menu items
    public function getItems()
    {
        $this->db->query('SELECT menu_items.* FROM menu_items, product_category WHERE menu_items.category_id = product_category.category_id HAVING COUNT(product_category.category_id) > 0 GROUP BY product_category.category_id ORDER BY item_order ASC');
        $results = $this->db->fetchAll();
        return $results;
    }
}
