<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Register User
    public function register($data)
    {
        // Prepare query
        $this->db->query("INSERT INTO customers (first_name, last_name, email_id, password, subscriber, shipping_address) VALUES(:first_name, :last_name, :email_id, :password, :subscriber, :shipping_address)");
        // Bind params
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_id', $data['email']);
        $this->db->bind(':subscriber', $data['subscriber']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':shipping_address', $data['shipping_address']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM customers WHERE email_id = :email');
        $this->db->bind(':email', $email);
        $user = $this->db->fetchOne();
        $hashed_password = $user->password;
        if (password_verify($password, $hashed_password)) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUsers()
    {
        $this->db->query('SELECT * FROM customers');
        return $this->db->fetchAll();
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM customers WHERE email_id = :email');
        $this->db->bind(':email', $email);
        $user = $this->db->fetchOne();
        if ($this->db->count() > 0) {
            return $user;
        } else {
            return false;
        }
    }

    public function findUserById($id)
    {
        $this->db->query('SELECT * FROM customers WHERE customer_id = :id');
        $this->db->bind(':id', $id);
        $user = $this->db->fetchOne();
        if ($this->db->count() > 0) {
            return $user;
        } else {
            return false;
        }
    }

    public function post_review($data)
    {
        // Prepare query
        $this->db->query("INSERT INTO product_reviews (customer_id, product_id, review, review_summary) VALUES(:customer_id, :product_id, :review, :review_summary)");
        // Bind params
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':customer_id', $data['customer_id']);
        $this->db->bind(':review', $data['review']);
        $this->db->bind(':review_summary', $data['review_summary']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addToCart($data, $product)
    {
        $this->db->query("SELECT * FROM cart WHERE customer_id = :customer_id");
        $this->db->bind(':customer_id', $data['customer_id']);
        $cart = $this->db->fetchOne();
        if (!$cart) {
            $cart = $this->createCart($data['customer_id']);
        }
        $product_id = $product->product_id;
        $cart = $this->db->fetchOne();
        $cart_id = $cart->cart_id;
        $quantity = $data['quantity'];
        $product_price = $product->price * ((100 - $product->discount_rate) / 100);
        $total_price = $product_price * $quantity;
        $this->db->query("SELECT * FROM cart_items WHERE cart_id = {$cart_id} AND product_id = {$product_id}");
        if ($cart_item = $this->db->fetchOne()) {
            $this->db->query("UPDATE cart_items SET quantity = :quantity, product_price = :product_price, total_price = :total_price");
            $this->db->bind(':quantity', $quantity);
            $this->db->bind(':product_price', $product_price);
            $this->db->bind(':total_price', $total_price);
        } else {
            $this->db->query("INSERT INTO cart_items(cart_id, product_id, quantity, product_price, total_price) VALUES(:cart_id, :product_id, :quantity, :product_price, :total_price)");
            $this->db->bind(':cart_id', $cart_id);
            $this->db->bind(':product_id', $product_id);
            $this->db->bind(':quantity', $quantity);
            $this->db->bind(':product_price', $product_price);
            $this->db->bind(':total_price', $total_price);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function createCart($customer_id)
    {
        $this->db->query("INSERT INTO cart(customer_id) VALUES(:customer_id)");
        $this->db->bind(':customer_id', $customer_id);
        if ($this->db->execute()) {
            $this->db->query("SELECT * FROM cart WHERE customer_id = :customer_id");
            $this->db->bind(':customer_id', $customer_id);
            return $this->db->fetchOne();
        } else {
            return false;
        }
    }

    public function update($data)
    {
        // Prepare query
        $this->db->query("UPDATE customers SET first_name= :first_name, last_name= :last_name, email_id= :email_id, subscriber= :subscriber, shipping_address= :shipping_address WHERE customer_id= :customer_id");
        // Bind params
        $this->db->bind(':customer_id', $data['user']->customer_id);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email_id', $data['email']);
        $this->db->bind(':subscriber', $data['subscriber']);
        $this->db->bind(':shipping_address', $data['shipping_address']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function subscribe($customer_id)
    {
        $this->db->query("UPDATE customers SET subscriber = 1 WHERE customer_id = {$customer_id}");
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function unsubscribe($customer_id)
    {
        $this->db->query("UPDATE customers SET subscriber = 0 WHERE customer_id = {$customer_id}");
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function subscribeOther($email)
    {
        $this->db->query("INSERT INTO other_subscribers(email) VALUES(:email)");
        $this->db->bind(':email', $email);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrders()
    {
        $this->db->query("SELECT * FROM orders WHERE customer_id = {$_SESSION['user_id']} AND status <> 'Delivered' AND status <> 'Refunded'");
        $orders = $this->db->fetchAll();
        return $orders;
    }

    public function getOrderHistory()
    {
        $this->db->query("SELECT * FROM orders WHERE customer_id = {$_SESSION['user_id']} AND (status = 'Delivered' OR status = 'Refunded')");
        $orders = $this->db->fetchAll();
        return $orders;
    }

    public function getOrder($id)
    {
        $this->db->query("SELECT oi.*, o.total_amount AS order_total_amount FROM orders AS o, order_items AS oi WHERE o.customer_id = {$_SESSION['user_id']} AND o.order_id = oi.order_id AND o.order_id = {$id}");
        $order = $this->db->fetchAll();
        return $order;
    }

    public function getCustomersCount()
    {
        $this->db->query("SELECT COUNT(*) AS count FROM customers");
        $orders = $this->db->fetchOne();
        return $orders->count;
    }

    public function getNewCustomersByLimit($limit)
    {
        $this->db->query("SELECT * FROM customers WHERE customer_id ORDER BY created_at DESC LIMIT $limit");
        $results = $this->db->fetchAll();
        return $results;
    }
}