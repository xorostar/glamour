<?php
class Post
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Adding a post
    public function addPost($data)
    {
        // Prepare query
        $this->db->query("INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)");
        // Bind params
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Fetching all posts
    public function getPosts()
    {
        $this->db->query('SELECT P.id AS id, P.title AS title, P.body AS body, P.created_at AS created_at, U.name AS author  FROM posts AS P INNER JOIN users AS U ON U.id = P.user_id ORDER BY P.created_at DESC');
        $results = $this->db->fetchAll();
        return $results;
    }

    // Fetching a single post
    public function getPostById($id)
    {
        $this->db->query('SELECT P.id AS id, P.title AS title, P.body AS body, P.created_at AS created_at, U.name AS author, U.id AS author_id  FROM posts AS P INNER JOIN users AS U ON U.id = P.user_id WHERE P.id = :id ORDER BY P.created_at DESC');
        $this->db->bind(':id', $id);
        $results = $this->db->fetchOne();
        return $results;
    }

    // Update a post
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        // Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a post
    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind Values
        $this->db->bind(':id', $id);
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}