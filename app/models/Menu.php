<?php
class Menu
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
	
	public function setMenuItemFeaturedStatus($id, $status){
		$this->db->query('UPDATE menu_items SET featured = :status WHERE menu_item_id = :id ');
		$this->db->bind(':id', $id);
		$this->db->bind(':status', $status);
		$this->db->execute();
	}
	public function setSubmenuItemFeaturedStatus($id, $status){
		$this->db->query('UPDATE submenu_items SET featured = :status WHERE submenu_item_id = :id');
		$this->db->bind(':id', $id);
		$this->db->bind(':status', $status);
		$this->db->execute();
	}
	
	public function getFeaturedMenuItems(){
		$this->db->query("SELECT * FROM featured_items, menu_images, menu_items WHERE item_type = 'menu' AND featured_items.item_id = menu_images.menu_item_id AND featured_items.item_id = menu_items.menu_item_id");
		return $this->db->fetchAll();
	}
	
	public function getFeaturedSubmenuItems(){
		$this->db->query("SELECT * FROM featured_items, submenu_images, submenu_items WHERE item_type = 'submenu' AND featured_items.item_id = submenu_images.submenu_item_id AND featured_items.item_id = submenu_items.submenu_item_id");
		return $this->db->fetchAll();
	}
	
	public function getFeaturedCount(){
		$this->db->query('SELECT COUNT(*) AS count FROM featured_items');
		return $this->db->fetchOne()->count;
	}
	
	public function addFeaturedItem($id, $type){
		$this->db->query('INSERT INTO featured_items(item_id, item_type) VALUES(:id, :type)');
		$this->db->bind(':id', $id);
		$this->db->bind(':type', $type);
		$this->db->execute();
		if($type == 'menu'){
			$this->setMenuItemFeaturedStatus($id, true);
		}else{
			$this->setSubmenuItemFeaturedStatus($id, true);
		}
	}
	
	public function removeFeaturedItem($id, $type){
		$this->db->query('DELETE FROM featured_items WHERE item_id = :id AND item_type = :type');
		$this->db->bind(':id', $id);
		$this->db->bind(':type', $type);
		$this->db->execute();
		if($type == 'menu'){
			$this->setMenuItemFeaturedStatus($id, false);
		}else{
			$this->setSubmenuItemFeaturedStatus($id, false);
		}
	}
	
    public function addMenuItem($data)
    {
        $this->db->query('INSERT INTO menu_items(menu_item_name, menu_item_order) VALUES(:name, :order)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':order', $data['order']);
        $this->db->execute();
        $this->db->query("SELECT LAST_INSERT_ID() AS id");
        $id =  $this->db->fetchOne()->id;
        $this->db->query('INSERT INTO menu_images(menu_item_id, image_uri) VALUES(:id, :image)');
        $this->db->bind(':id', $id);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function addSubmenuItem($data)
    {
        $this->db->query('INSERT INTO submenu_items(submenu_item_name, submenu_item_order, menu_item_id) VALUES(:name, :order, :parent)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':order', $data['order']);
        $this->db->bind(':parent', $data['parent']);
        $this->db->execute();
        $this->db->query("SELECT LAST_INSERT_ID() AS id");
        $id =  $this->db->fetchOne()->id;
        $this->db->query('INSERT INTO submenu_images(submenu_item_id, image_uri) VALUES(:id, :image)');
        $this->db->bind(':id', $id);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function deleteMenuItem($id)
    {
        $this->db->query('DELETE FROM menu_items WHERE menu_item_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function updateMenuItem($data)
    {
        $this->db->query('UPDATE menu_items SET menu_item_name = :name, menu_item_order = :order WHERE menu_item_id = :id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':order', $data['order']);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();
        $this->db->query('UPDATE menu_images SET menu_item_id = :id, image_uri = :image WHERE menu_item_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function updateSubmenuItem($data)
    {
        $this->db->query('UPDATE submenu_items SET submenu_item_name = :name, menu_item_id = :parent, submenu_item_order = :order WHERE submenu_item_id = :id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':order', $data['order']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':parent', $data['parent']);
        $this->db->execute();
        $this->db->query('UPDATE submenu_images SET submenu_item_id = :id, image_uri = :image  WHERE submenu_item_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }

    public function getMenuItems()
    {
        $this->db->query('SELECT * FROM menu_items, menu_images WHERE menu_items.menu_item_id = menu_images.menu_item_id ORDER BY menu_item_order ASC');
        $results = $this->db->fetchAll();
        return $results;
    }

    public function getSubmenuItems()
    {
        $this->db->query("SELECT *, submenu_items.featured AS featured_status FROM submenu_items, menu_items, submenu_images WHERE submenu_items.submenu_item_id = submenu_images.submenu_item_id AND submenu_items.menu_item_id = menu_items.menu_item_id");
        $results = $this->db->fetchAll();
        return $results;
    }

    public function getSubmenuItemsByMenuId($id)
    {
        $this->db->query("SELECT * FROM submenu_items WHERE menu_item_id = $id");
        $results = $this->db->fetchAll();
        return $results;
    }
//
//    public function getFeaturedMenuItems()
//    {
//        $this->db->query("SELECT fc.featured_item_id, ci.image_uri, fc.featured_title, c.category_name FROM featured_categories AS fc, category_images AS ci, categories AS c WHERE fc.featured_item_id = c.category_id AND c.category_id = ci.category_id ORDER BY fc.featured_order");
//        $results = $this->db->fetchAll();
//        return $results;
//    }

    public function getMenuItem($id)
    {
        $this->db->query("SELECT * FROM menu_items AS mi, submenu_items AS si WHERE si.menu_item_id = mi.menu_item_id AND si.submenu_item_id = $id");
        $results = $this->db->fetchOne();
        return $results;
    }

    public function getMenuItemById($id)
    {
        $this->db->query("SELECT * FROM menu_items AS m, menu_images AS mi WHERE m.menu_item_id = $id AND mi.menu_item_id = m.menu_item_id");
        $results = $this->db->fetchOne();
        return $results;
    }

    public function getSubmenuItem($id)
    {
        $this->db->query("SELECT * FROM submenu_items, menu_items, submenu_images WHERE submenu_items.submenu_item_id = submenu_images.submenu_item_id AND submenu_items.menu_item_id = menu_items.menu_item_id AND submenu_items.submenu_item_id = :id");
        $this->db->bind(":id", $id);
        $results = $this->db->fetchOne();
        return $results;
    }
}
