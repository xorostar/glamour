<?php
class Administrator
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //Login User
    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM administrators WHERE username = :username AND password = :password');
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        $admin = $this->db->fetchOne();
        if ($admin) {
            return $admin;
        } else {
            return false;
        }
    }

    public function findAdminByUsername($username)
    {
        $this->db->query('SELECT * FROM administrators WHERE username = :username');
        $this->db->bind(':username', $username);
        $admin = $this->db->fetchOne();
        if ($this->db->count() > 0) {
            return $admin;
        } else {
            return false;
        }
    }
}