<?php
class Store
{

	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getStoreData()
	{
		$this->db->query('SELECT * FROM store');
		$result = $this->db->fetchOne();
		return $result;
	}

	public function updateStoreData($data)
	{
		$this->db->query("UPDATE store SET name = :name, email_id = :email, logo = :logo, facebook_link = :fb, instagram_link = :insta, twitter_link = :twit, youtube_link = :yt, google_plus_link = :gplus, vimeo_link = :vimeo");
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':logo', $data['logo']);
		$this->db->bind(':fb', $data['fb']);
		$this->db->bind(':insta', $data['insta']);
		$this->db->bind(':twit', $data['twit']);
		$this->db->bind(':yt', $data['yt']);
		$this->db->bind(':gplus', $data['gplus']);
		$this->db->bind(':vimeo', $data['vimeo']);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function getSliderImages()
	{
		$this->db->query("SELECT * FROM slider_images ORDER BY slide_order ASC");
		return $this->db->fetchAll();
	}

	public function insertSliderImage($data)
	{
		$this->db->query("INSERT INTO slider_images(link, slide_order, image_uri) VALUES(:link, :order, :uri)");
		$this->db->bind(':link', $data['link']);
		$this->db->bind(':order', $data['order']);
		$this->db->bind(':uri', $data['image']);
		return $this->db->execute();
	}
	public function deleteSliderItem($id)
	{
		$this->db->query("DELETE FROM slider_images WHERE id = :id");
		$this->db->bind(':id', $id);
		return $this->db->execute();
	}
}