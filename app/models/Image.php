<?php
class Image
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Fetching all menu items
    public function getImages()
    {
        $this->db->query('SELECT* FROM product_images');
        $results = $this->db->fetchAll();
        return $results;
    }
}
