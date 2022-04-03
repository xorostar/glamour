<?php
class Page
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPages()
    {
        $this->db->query('SELECT * FROM pages');
        $results = $this->db->fetchAll();
        return $results;
    }

    public function getPage($title)
    {
        $this->db->query('SELECT * FROM pages WHERE page_title = :title');
        // Bind Values
        $this->db->bind(':title', $title);
        // Execute the query
        $result = $this->db->fetchOne();
        return $result;
    }

    public function getPageById($id)
    {
        $this->db->query('SELECT * FROM pages WHERE page_id = :id');
        $this->db->bind(':id', $id);
        // Execute the query
        $result = $this->db->fetchOne();
        return $result;
    }

    public function updatePage($id, $body)
    {
        $this->db->query("UPDATE pages SET page_body = '$body' WHERE page_id = $id");
        $this->db->execute();
    }
}