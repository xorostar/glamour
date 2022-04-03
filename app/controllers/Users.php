<?php

class Users extends Controller
{

	public function __construct()
	{
		$this->userModel = $this->loadModel('User');
	}

	public function index()
	{
		if (isLoggedIn()) {
			redirect('users/account');
		} else {
			$this->loadView('users/signin-form', ['active' => 'signin']);
		}
	}

	public function signin()
	{
		if (isLoggedIn()) {
			redirect('users/account');
		} else {
			$this->loadView('users/signin-form', ['active' => 'signin']);
		}
	}

	public function signup()
	{
		if (isLoggedIn()) {
			redirect('users/account');
		} else {
			$this->loadView('users/signup-form', ['active' => 'signup']);
		}
	}

	public function register()
	{
		// Init Data
		$data = [
			'first_name' => '',
			'last_name' => '',
			'email' => '',
			'password' => '',
			'subscriber' => '',
			'shipping_address' => '',
			'confirm_password' => '',
			'fname_err' => '',
			'lname_err' => '',
			'email_err' => '',
			'password_err' => '',
			'confirm_password_err' => '',
			'shipping_address_err' => '',
		];
		//Check For POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Process form
			// Sanititze post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// Filtered form data
			$data['first_name'] = trim($_POST['first_name']);
			$data['last_name'] = trim($_POST['last_name']);
			if (isset($_POST['subscriber'])) {
				$data['subscriber'] = trim($_POST['subscriber']);
			}
			$data['email'] = trim($_POST['email']);
			$data['password'] = trim($_POST['password']);
			$data['confirm_password'] = trim($_POST['confirm_password']);
			$data['shipping_address'] = trim($_POST['shipping_address']);

			// Validate Email
			if (empty($data['email'])) {
				$data['email_err'] = 'Please enter your email';
			} else if ($this->userModel->findUserByEmail($data['email'])) {
				// Check if user already exists
				$data['email_err'] = 'Email is already taken';
			}

			// Validate First Name
			if (empty($data['first_name'])) {
				$data['fname_err'] = 'Please enter your first name';
			}

			// Validate Last Name
			if (empty($data['last_name'])) {
				$data['lname_err'] = 'Please enter your last name';
			}
			if (empty($data['shipping_address'])) {
				$data['shipping_address_err'] = 'Please enter your shipping address';
			}

			// Validate Password
			if (empty($data['password'])) {
				$data['password_err'] = 'Please enter a password';
			} else if (strlen($data['password']) < 6) {
				$data['password_err'] = 'Password must be atleast 6 characters';
			}

			// Validate Confirm Password
			if (empty($data['confirm_password'])) {
				$data['confirm_password_err'] = 'Please confirm your password';
			} else if ($data['password'] != $data['confirm_password']) {
				$data['password_err'] = 'Passwords do not match';
			}

			// Making sure that errors are empty
			if (empty($data['fname_err']) && empty($data['lname_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['shipping_address_err'])) {
				// Validated
				// Hash the password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
				// Register User
				if ($this->userModel->register($data)) {
					flash('registration_successful', 'Registered Successfully! Please log in to continue');
					$data['active'] = 'signin';
					$this->loadView('users/signin-form', $data);
				} else {
					die('Something went wrong.');
				}
			} else {
				//load view
				flash('registration_failed', 'Please fill in valid information only', 'alert alert-danger');
				$data['active'] = 'signup';
				$this->loadView('users/signup-form', $data);
			}
		} else {
			// Load view
			$data['active'] = 'signin';
			$this->loadView('users/signin-form', $data);
		}
	}

	public function login()
	{
		// Init Data
		$data = [
			'email' => '',
			'password' => '',
			'email_err' => '',
			'password_err' => '',
			'active' => 'signin',
		];

		//Check For POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Process Form
			// Sanititze post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// Filtered form data
			$data['email'] = trim($_POST['email']);
			$data['password'] = trim($_POST['password']);
			$data['email_err'] = '';
			$data['password_err'] = '';

			// Validate Email
			if (empty($data['email'])) {
				$data['email_err'] = 'Please enter email';
			}

			// Validate Password
			if (empty($data['password'])) {
				$data['password_err'] = 'Please enter password';
			}

			// Check if user exists
			if ($this->userModel->findUserByEmail($data['email'])) {
				// User Found
			} else {
				flash('login_failed', 'Invalid Email or Password', 'alert alert-danger');
				$this->loadView('users/signin-form', $data);
				return;
			}

			// Making sure that errors are empty
			if (empty($data['email_err']) && empty($data['password_err'])) {
				// Validated
				// Check and set logged in user
				$loggedInUser = $this->userModel->login($data['email'], $data['password']);
				if ($loggedInUser) {
					// Create Session
					$this->createUserSession($loggedInUser);
					redirect('users/account');
					return;
				} else {
					// Load view
					flash('login_failed', 'Invalid Email or Password', 'alert alert-danger');
					$this->loadView('users/signin-form', $data);
					return;
				}
			} else {
				//load view
				flash('login_failed', 'Invalid Email or Password', 'alert alert-danger');
				$this->loadView('users/signin-form', $data);
				return;
			}
		}
	}

	public function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['email']);
		unset($_SESSION['user_name']);
		session_destroy();
		flash('logout_successful', 'User Successfully Logged Out', 'alert alert-danger');
		redirect('users/signin');
	}

	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->customer_id;
		$_SESSION['email'] = $user->email_id;
		$_SESSION['user_name'] = $user->first_name . ' ' . $user->last_name;
	}

	public function account()
	{
		$user = $this->userModel->findUserById($_SESSION['user_id']);
		$this->loadView('users/account', ['active' => 'account', 'user' => $user]);
	}
	public function update()
	{
		// Init Data
		$data = [
			'first_name' => '',
			'last_name' => '',
			'email' => '',
			'subscriber' => '',
			'shipping_address' => '',
			'fname_err' => '',
			'lname_err' => '',
			'email_err' => '',
			'shipping_address_err' => '',
			'active' => 'update'
		];
		$user = $this->userModel->findUserById($_SESSION['user_id']);
		$data['user'] = $user;
		//Check For POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Process form
			// Sanititze post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// Filtered form data
			$data['first_name'] = trim($_POST['first_name']);
			$data['last_name'] = trim($_POST['last_name']);
			if (isset($_POST['subscriber'])) {
				$data['subscriber'] = trim($_POST['subscriber']);
			}
			$data['email'] = trim($_POST['email']);
			$data['shipping_address'] = trim($_POST['shipping_address']);

			// Validate Email
			if (empty($data['email'])) {
				$data['email_err'] = 'Please enter your email';
			} else if ($data['email'] !== $user->email_id) {
				if ($this->userModel->findUserByEmail($data['email'])) {
					// Check if user already exists
					$data['email_err'] = 'Email is already taken';
				}
			}

			// Validate First Name
			if (empty($data['first_name'])) {
				$data['fname_err'] = 'Please enter your first name';
			}

			// Validate Last Name
			if (empty($data['last_name'])) {
				$data['lname_err'] = 'Please enter your last name';
			}
			if (empty($data['shipping_address'])) {
				$data['shipping_address_err'] = 'Please enter your shipping address';
			}

			// Making sure that errors are empty
			if (empty($data['fname_err']) && empty($data['lname_err']) && empty($data['email_err']) && empty($data['shipping_address_err'])) {
				// Validated

				// Register User
				if ($this->userModel->update($data)) {
					flash('update_successful', 'Information Updated Successfully!');
					$data['active'] = 'update';
					$user = $this->userModel->findUserById($_SESSION['user_id']);
					$data['user'] = $user;
					$this->loadView('users/update', $data);
				} else {
					die('Something went wrong.');
				}
			} else {
				//load view
				$user = $this->userModel->findUserById($_SESSION['user_id']);
				$data['user'] = $user;
				flash('update_unsuccessful', 'Please fill in valid information only', 'alert alert-danger');
				$data['active'] = 'update';
				$this->loadView('users/update', $data);
			}
		} else {
			// Load view
			$user = $this->userModel->findUserById($_SESSION['user_id']);
			$data['user'] = $user;
			$data['active'] = 'update';
			$this->loadView('users/update', $data);
		}
	}

	public function cart()
	{
		if (isLoggedIn()) {
			$cartModel = $this->loadModel('Cart');
			$cart_items = $cartModel->getCartItems();
			$cartTotal = 0;
			foreach ($cart_items as $cart_item) {
				$cartTotal += $cart_item->total_price;
			}
			$this->loadView('users/cart', ['active' => 'cart', 'cart_items' => $cart_items, 'cart_total' => $cartTotal]);
		} else {
			redirect('');
		}
	}

	public function updateCartItem()
	{
		if (isLoggedIn()) {
			if (isset($_POST['cart_item_id'])) {
				$cartModel = $this->loadModel('Cart');
				if ($_POST['quantity'] <= 0) {
					flash('cart_item_update_err', 'Please enter a quantity between 1-50', 'alert alert-danger');
					redirect('users/updateCartItem?cart_item_id=' . $_POST['cart_item_id']);
				} else {
					if ($cartModel->UpdateCartItem($_POST['cart_item_id'], $_POST['quantity'])) {
						flash('cart_item_updated', 'Cart item was updated successfully!');
						redirect('users/cart');
					} else {
						redirect('');
					}
				}
			} else if (isset($_GET['cart_item_id'])) {
				$cartModel = $this->loadModel('Cart');
				$cart_item = $cartModel->getCartItem($_GET['cart_item_id']);
				$this->loadView('users/edit-cart-item', ['active' => 'account', 'cart_item' => $cart_item]);
			} else {
				redirect('');
			}
		} else {
			redirect('');
		}
	}

	public function clearShoppingCart()
	{
		if (isLoggedIn()) {
			if (isset($_GET['cart_id'])) {
				$cartModel = $this->loadModel('Cart');
				if ($cartModel->clearShoppingCart($_GET['cart_id'])) {
					flash('shopping_cart_removed', 'Cart was cleared successfully!');
					redirect('users/cart');
				} else {
					redirect('');
				}
			} else {
				redirect('');
			}
		} else {
			redirect('');
		}
	}

	public function removeCartItem()
	{
		if (isLoggedIn()) {
			if (isset($_GET['cart_item_id'])) {
				$cartModel = $this->loadModel('Cart');
				if ($cartModel->removeCartItem($_GET['cart_item_id'])) {
					flash('cart_item_removed', 'Cart item was removed successfully!');
					redirect('users/cart');
				} else {
					redirect('');
				}
			} else {
				redirect('');
			}
		} else {
			redirect('');
		}
	}

	public function orders()
	{
		if (isLoggedIn()) {
			$orders = $this->userModel->getOrders();
			$this->loadView('users/orders', ['active' => 'order', 'orders' => $orders]);
		} else {
			redirect('');
		}
	}

	public function order($id)
	{
		if (isLoggedIn()) {
			$order = $this->userModel->getOrder($id);
			$this->loadView('users/order', ['active' => 'order', 'order' => $order]);
		} else {
			redirect('');
		}
	}

	public function orders_history()
	{
		if (isLoggedIn()) {
			$orders = $this->userModel->getOrderHistory();
			$this->loadView('users/order-history', ['active' => 'order-history', 'orders' => $orders]);
		} else {
			redirect('');
		}
	}

	public function wishlist()
	{
		$this->loadView('users/wishlist', ['active' => 'wishlist']);
	}

	public function subscribe()
	{
		if ($this->userModel->subscribe($_SESSION['user_id'])) {
			flash('subscription_successful', 'You subscribed to our newsletter successfully!');
			redirect('users/account');
		}
	}

	public function subscribeOther()
	{
		if ($this->userModel->subscribeOther($_POST['email'])) {
			flash('subscription_successful', 'You subscribed to our newsletter successfully!');
			redirect('');
		}
	}

	public function unsubscribe()
	{
		if ($this->userModel->unsubscribe($_SESSION['user_id'])) {
			flash('unsubscription_successful', 'You unsubscribed to our newsletter!');
			redirect('users/account');
		}
	}


	public function post_review()
	{
		if (isLoggedIn()) {
			// Init Data
			$data = [
				'customer_id' => $_SESSION['user_id'],
				'product_id' => '',
				'review' => '',
				'product_id_err' => '',
				'review_summary' => '',
				'review_err' => '',
				'review_summary_err' => ''
			];
			//Check For POST
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Process form
				// Sanititze post data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				// Filtered form data
				$data['product_id'] = trim($_POST['product_id']);
				$data['review'] = trim($_POST['review']);
				$data['review_summary'] = trim($_POST['review_summary']);

				if (empty($data['review'])) {
					$data['review_err'] = 'Please enter a review before submitting a review';
				}
				if (empty($data['review_summary'])) {
					$data['review_summary_err'] = 'Please enter a review summary before submitting a review';
				}

				if (empty($data['product_id'])) {
					$data['product_id_err'] = 'Product id not attached';
					redirect('');
				}

				// Making sure that errors are empty
				if (empty($data['review_summary_err']) && empty($data['review_err']) && empty($data['product_id_err'])) {
					// Validated
					if ($this->userModel->post_review($data)) {
						flash('review_submission_successful', 'Review Posted Successfully! Thank you for your time');
						$data['active'] = 'product';
						redirect('products/product/' . $data['product_id']);
					} else {
						die('Something went wrong.');
					}
				} else {
					flash('review_submission_failed', 'Review submission failed! Please fill in the *required information', 'alert alert-danger');
					$data['active'] = 'product';
					redirect('products/product/' . $data['product_id']);
				}
			}
		} else {
			redirect('products/product/' . $data['product_id']);
		}
	}

	public function addToCart()
	{
		if (isLoggedIn()) {
			// Init Data
			$data = [
				'customer_id' => $_SESSION['user_id'],
				'product_id' => '',
				'quantity' => '',
				'product_id_err' => '',
				'quantity_err' => ''
			];
			//Check For POST
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Process form
				// Sanititze post data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				// Filtered form data
				$data['product_id'] = trim($_POST['product_id']);
				$data['quantity'] = trim($_POST['quantity']);

				if (empty($data['quantity']) || $data['quantity'] <= 0) {
					$data['quantity_err'] = 'Quantity must be atleast 1 or greater';
				}

				if (empty($data['product_id'])) {
					$data['product_id_err'] = 'Product id not attached';
					redirect('');
				}

				// Making sure that errors are empty
				if (empty($data['quantity_err']) && empty($data['product_id_err'])) {
					// Validated
					$productModel = $this->loadModel('Product');
					$product = $productModel->getProduct($data['product_id']);
					if ($this->userModel->addToCart($data, $product)) {
						flash('cart_transaction_successful', 'Product Added To Cart Successfully!');
						redirect('products/product/' . $data['product_id']);
					} else {
						die('Something went wrong.');
					}
				} else {
					flash('unauthorised_cart', 'Something went wrong!', 'alert alert-danger');
					redirect('products/product/' . $data['product_id']);
				}
			}
		} else {
			flash('unauthorised_cart', 'Please login to add an item to a cart', 'alert alert-danger');
			redirect('products/product/' . $_POST['product_id']);
		}
	}

	public function checkout($cart_id)
	{
		$cart = $this->loadModel('Cart');
		if ($cart->checkout($cart_id)) {
			flash('message', 'Order successfully placed. Our customer sales representative will call you soon to confirm your order. Thanks for your visit');
			redirect('users/account');
			$cart->clearShoppingCart($cart_id);
		} else {
			flash('message', 'Something went wrong', 'alert alert-danger');
			redirect('users/account');
		}
	}
}