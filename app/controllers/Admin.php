<?php

class Admin extends Controller
{

    public function __construct()
    {
        $this->adminModel = $this->loadModel('Administrator');
        $this->menuModel = $this->loadModel('Menu');
        $this->userModel = $this->loadModel('User');
        $this->productModel = $this->loadModel('Product');
        $this->menuItemModel = $this->loadModel('MenuItems');
        $this->pageModel = $this->loadModel('Page');
        $this->storeModel = $this->loadModel('Store');
        $this->orderModel = $this->loadModel('Order');
    }

    public function index()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $lifetime_sales = $this->orderModel->getLifetimeSales();
        $average_order = $this->orderModel->getAverageOrder();
        $orders_count = $this->orderModel->getOrdersCount();
        $pending_orders_count = $this->orderModel->getPendingOrdersCount();
        $last_orders = $this->orderModel->getOrdersByLimit(5);
        $customers_count = $this->userModel->getCustomersCount();
        $new_customers = $this->userModel->getNewCustomersByLimit(5);
        $best_selling_product_ids = $this->productModel->getBestSellingProductIds(5);
        $most_viewed_products = $this->productModel->getMostViewedProducts(5);
        $this->loadView('admin/homepage', ['active' => 'homepage', 'lifetime_sales' => $lifetime_sales, 'average_order' => $average_order, 'orders_count' => $orders_count, 'pending_orders_count' => $pending_orders_count, 'customers_count' => $customers_count, 'last_orders' => $last_orders, 'new_customers' => $new_customers, 'best_selling_product_ids' => $best_selling_product_ids, 'most_viewed_products' => $most_viewed_products]);
    }

    public function signin()
    {
        $this->loadView('admin/signin-form', ['active' => 'signin']);
    }

    public function store()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $logo = '';
            $email = $_POST['email'];
            $fb = $_POST['facebook-link'];
            $insta = $_POST['instagram-link'];
            $yt = $_POST['youtube-link'];
            $twit = $_POST['twitter-link'];
            $gplus = $_POST['google-plus-link'];
            $vimeo = $_POST['vimeo-link'];
            $unique_filename = uniqid();
            $target_dir = dirname(APPROOT) . '/public/img/';
            $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["logo"]["name"]), PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_filename;
            $uploadOk = 1;
            $check = getimagesize($_FILES["logo"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk) {
                move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
                $logo = $new_filename;
                unlink(dirname(APPROOT) . '/public/img/' . $_POST['old-logo']);
            } else {
                $logo = $_POST['old-logo'];
            }

            $data = [
                'name' => $name,
                'logo' => $logo,
                'email' => $email,
                'fb' => $fb,
                'insta' => $insta,
                'yt' => $yt,
                'twit' => $twit,
                'gplus' => $gplus,
                'vimeo' => $vimeo,
            ];

            if ($this->storeModel->updateStoreData($data)) {
                flash('validation_message', 'Store information updated successfully!');
                redirect('admin/store');
            } else {
                flash('validation_message', 'Something went wrong! Changes could not be saved successfully');
                redirect('admin/store');
            }
        } else {
            $data = $this->storeModel->getStoreData();
            $this->loadView('admin/store', ['active' => 'store', 'store' => $data]);
        }
    }

    public function editMenuItem($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $order = $_POST['order'];
            $image = '';
            $unique_filename = uniqid();
            $target_dir = dirname(APPROOT) . '/public/img/';
            $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_filename;
            $uploadOk = 1;
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $new_filename;
                unlink(dirname(APPROOT) . '/public/img/' . $_POST['old-image']);
            } else {
                $image = $_POST['old-image'];
            }

            $data = [
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'order' => $order
            ];

            if ($this->menuModel->updateMenuItem($data)) {
                flash('validation_message', 'Menu Item Updated Successfully!');
                redirect('admin/addMenuItem');
            } else {
                flash('validation_message', 'Something went wrong! Changes could not be saved successfully');
                redirect('admin/addMenuItem');
            }
        } else {
            $menu_item = $this->menuModel->getMenuItemById($id);
            $this->loadView('admin/edit-menu-item', ['active' => 'menu', 'menu_item' => $menu_item]);
        }
    }

    public function editSubmenuItem($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $order = $_POST['order'];
            $parent_menu = $_POST['parent-menu'];
            $image = '';
            $unique_filename = uniqid();
            $target_dir = dirname(APPROOT) . '/public/img/';
            $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_filename;
            $uploadOk = 1;
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $new_filename;
                unlink(dirname(APPROOT) . '/public/img/' . $_POST['old-image']);
            } else {
                $image = $_POST['old-image'];
            }

            $data = [
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'order' => $order,
                'parent' => $parent_menu
            ];

            if ($this->menuModel->updateSubmenuItem($data)) {
                flash('validation_message', 'Submenu Item Updated Successfully!');
                redirect('admin/addSubmenuItem');
            } else {
                flash('validation_message', 'Something went wrong! Changes could not be saved successfully');
                redirect('admin/addSubmenuItem');
            }
        } else {
            $menu_items = $this->menuModel->getMenuItems();
            $submenu_item = $this->menuModel->getSubmenuItem($id);
            $this->loadView('admin/edit-submenu-item', ['active' => 'menu', 'menu_items' => $menu_items, 'submenu_item' => $submenu_item]);
        }
    }

    public function deleteMenuItem($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $this->menuModel->deleteMenuItem($id);
        flash('message', 'Menu Item Deleted Successfully.', 'alert alert-danger');
        redirect('admin/addMenuItem');
    }

    public function customers()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $customers = $this->userModel->getUsers();
        $this->loadView('admin/customers', ['active' => 'customers', 'customers' => $customers]);
    }

    public function featuredCategories()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $featuredCount = $this->menuModel->getFeaturedCount();
        $menu_items = $this->menuModel->getMenuItems();
        $submenu_items = $this->menuModel->getSubmenuItems();
        $this->loadView('admin/featured-items', ['active' => 'content', 'menu_items' => $menu_items, 'submenu_items' => $submenu_items, 'featured_count' => $featuredCount]);
    }

    public function addToFeatured($id)
    {
        flash('message', 'Added an item to featured items successfully');
        $this->menuModel->addFeaturedItem($id, $_GET['type']);
        redirect('admin/featuredCategories');
    }
    public function removeFromFeatured($id)
    {
        flash('message', 'Remved an item from featured items successfully', 'alert alert-danger');
        $this->menuModel->removeFeaturedItem($id, $_GET['type']);
        redirect('admin/featuredCategories');
    }

    public function addMenuItem()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $order = $_POST['order'];
            $unique_filename = uniqid();
            $target_dir = dirname(APPROOT) . '/public/img/';
            $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_filename;
            $uploadOk = 1;
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $new_filename;
            }

            $data = [
                'name' => $name,
                'image' => $image,
                'order' => $order
            ];

            if ($this->menuModel->addMenuItem($data)) {
                flash('validation_message', 'Menu Item Added Successfully!');
                redirect('admin/addMenuItem');
            } else {
                flash('validation_message', 'Something went wrong! Changes could not be saved successfully');
                redirect('admin/addMenuItem');
            }
        } else {
            $menu_items = $this->menuModel->getMenuItems();
            $this->loadView('admin/add-menu-item', ['active' => 'menu', 'menu_items' => $menu_items]);
        }
    }

    public function addSubmenuItem()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $order = $_POST['order'];
            $parent_menu = $_POST['parent-menu'];
            $unique_filename = uniqid();
            $target_dir = dirname(APPROOT) . '/public/img/';
            $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_filename;
            $uploadOk = 1;
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $new_filename;
            }

            $data = [
                'name' => $name,
                'image' => $image,
                'order' => $order,
                'parent' => $parent_menu
            ];

            if ($this->menuModel->addSubmenuItem($data)) {
                flash('validation_message', 'Submenu Item Added Successfully!');
                redirect('admin/addSubmenuItem');
            } else {
                flash('validation_message', 'Something went wrong!');
                redirect('admin/addSubmenuItem');
            }
        } else {
            $menu_items = $this->menuModel->getMenuItems();
            $submenu_items = $this->menuModel->getSubmenuItems();
            $this->loadView('admin/add-submenu-item', ['active' => 'menu', 'menu_items' => $menu_items, 'submenu_items' => $submenu_items]);
        }
    }
    public function products()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $products = $this->productModel->getProducts();
        $this->loadView('admin/products', ['active' => 'products', 'products' => $products]);
    }

    public function addProduct()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $sku = $_POST['sku'];
            $discount = $_POST['discount'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $menu_item_id = $_POST['menu_item_id'];
            $description = $_POST['description'];

            $data = [
                'name' => $name,
                'sku' => $sku,
                'discount' => $discount,
                'price' => $price,
                'quantity' => $quantity,
                'menu_item_id' => $menu_item_id,
                'description' => $description,
            ];

            if ($id = $this->productModel->addProduct($data)) {
                $target_dir = dirname(APPROOT) . '/public/img/';
                $totalImages = count($_FILES['images']['name']);
                for ($i = 0; $i < $totalImages; $i++) {
                    $unique_filename = uniqid();
                    $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["images"]["name"][$i]), PATHINFO_EXTENSION);
                    $target_file = $target_dir . $new_filename;
                    $uploadOk = 1;
                    $check = getimagesize($_FILES["images"]["tmp_name"][$i]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                    if ($uploadOk) {
                        move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file);
                        $this->productModel->saveImage($id, $new_filename);
                    }
                }
                flash('validation_message', 'Product was added successfully!');
                redirect('admin/addProduct');
            } else {
                flash('validation_message', 'Something went wrong! Product could not be saved successfully');
                redirect('admin/addProduct');
            }
        } else {
            $submenuItems = $this->menuModel->getSubmenuItems();
            $this->loadView('admin/add-product', ['active' => 'products', 'submenu_items' => $submenuItems]);
        }
    }

    public function orders()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $orders = $this->orderModel->getOrders();
        $this->loadView('admin/orders', ['active' => 'orders', 'orders' => $orders]);
    }

    public function order($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $order = $this->orderModel->getOrder($id);
        $this->loadView('admin/order', ['active' => 'orders', 'order' => $order]);
    }

    public function setOrderStatus($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if (isset($_GET['status'])) {
            flash('update_message', 'Order Status Updated Successfully!');
            $this->orderModel->setOrderStatus($id, $_GET['status']);
            redirect('admin/orders');
        } else {
            redirect('admin/orders');
        }
    }


    public function sliderImages()
    {
        $sliderImages = $this->storeModel->getSliderImages();
        $submenuItems = $this->menuModel->getSubmenuItems();
        $menuItems = $this->menuModel->getMenuItems();
        $this->loadView('admin/slider-images', ['active' => 'content', 'slider_images' => $sliderImages, 'submenu_items' => $submenuItems, 'menu_items' => $menuItems]);
    }

    public function addSliderImage()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $link = $_POST['link'];
            $order = $_POST['order'];
            $image = '';
            $unique_filename = uniqid();
            $target_dir = dirname(APPROOT) . '/public/img/';
            $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_filename;
            $uploadOk = 1;
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $image = $new_filename;
            }

            $data = [
                'link' => $link,
                'order' => $order,
                'image' => $image
            ];

            if ($this->storeModel->insertSliderImage($data)) {
                flash('validation_message', 'Slider Image Added Successfully!');
                redirect('admin/sliderImages');
            } else {
                flash('validation_message', 'Something went wrong! Changes could not be saved successfully');
                redirect('admin/sliderImages');
            }
        } else {
            redirect('admin');
        }
    }

    public function deleteSliderItem($id)
    {
        $this->storeModel->deleteSliderItem($id);
        flash('validation_message', 'Slider Image Removed Successfully!');
        redirect('admin/sliderImages');
    }

    public function pages()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        $pages = $this->pageModel->getPages();
        $this->loadView('admin/pages', ['active' => 'content', 'pages' => $pages]);
    }

    public function editPage($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->pageModel->updatePage($id, htmlspecialchars($_POST['body']));
            flash('message', 'Page Updated Successfully');
            redirect('admin/pages');
        } else {
            $page = $this->pageModel->getPageById($id);
            $this->loadView('admin/edit-page', ['active' => 'content', 'page' => $page]);
        }
    }

    public function editProduct($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $sku = $_POST['sku'];
            $discount = $_POST['discount'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $menu_item_id = $_POST['menu_item_id'];
            $description = $_POST['description'];

            $data = [
                'product_id' => $id,
                'name' => $name,
                'sku' => $sku,
                'discount' => $discount,
                'price' => $price,
                'quantity' => $quantity,
                'menu_item_id' => $menu_item_id,
                'description' => $description,
            ];
            $cleared = false;
            if ($this->productModel->updateProduct($data)) {
                if (count($_FILES['images']['name']) > 0) {
                    $target_dir = dirname(APPROOT) . '/public/img/';
                    $totalImages = count($_FILES['images']['name']);
                    for ($i = 0; $i < $totalImages; $i++) {
                        $unique_filename = uniqid();
                        $new_filename = $unique_filename . '.' . pathinfo(basename($_FILES["images"]["name"][$i]), PATHINFO_EXTENSION);
                        $target_file = $target_dir . $new_filename;
                        $uploadOk = 1;
                        $check = getimagesize($_FILES["images"]["tmp_name"][$i]);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $uploadOk = 0;
                        }
                        if ($uploadOk) {
                            if ($cleared == false) {
                                $old_images = $this->productModel->getProductImages($id);
                                $this->productModel->clearProductImages($id);
                                foreach ($old_images as $image) {
                                    unlink(dirname(APPROOT) . '/public/img/' . $image->image_uri);
                                }
                                $cleared = true;
                            }
                            move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file);
                            $this->productModel->saveImage($id, $new_filename);
                        }
                    }
                }
                flash('validation_message', 'Product successfully updated!');
                redirect('admin/editProduct/' . $id);
            } else {
                flash('validation_message', 'Something went wrong! Product could not be saved successfully');
                redirect('admin/editProduct/' . $id);
            }
        } else {
            $submenuItems = $this->menuModel->getSubmenuItems();
            $product = $this->productModel->getProduct($id);
            $this->loadView('admin/edit-product', ['active' => 'products', 'submenu_items' => $submenuItems, 'product' => $product]);
        }
    }

    public function delete_product($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        flash('update_message', 'Product Set To Not Visible');
        $this->productModel->setProductInvisible($id);
        redirect('admin/products');
    }

    public function setProductVisible($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        flash('update_message', 'Product Set To Visible');
        $this->productModel->setProductVisible($id);
        redirect('admin/products');
    }

    public function setProductInvisible($id)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/signin');
            return;
        }
        flash('update_message', 'Product Set To Not Visible');
        $this->productModel->setProductInvisible($id);
        redirect('admin/products');
    }


    public function login()
    {
        // Init Data
        $data = [
            'username' => '',
            'password' => '',
            'username_err' => '',
            'password_err' => ''
        ];

        //Check For POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form
            // Sanititze post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Filtered form data
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);
            $data['username_err'] = '';
            $data['password_err'] = '';

            // Validate Email
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check if user exists
            if ($this->adminModel->findAdminByUsername($data['username'])) {
                // User Found
            } else {
                flash('login_failed', 'Invalid username or Password', 'alert alert-danger');
                redirect('admin');
                return;
            }

            // Making sure that errors are empty
            if (empty($data['username_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInAdmin = $this->adminModel->login($data['username'], $data['password']);
                if ($loggedInAdmin) {
                    // Create Session
                    $this->createAdminSession($loggedInAdmin);
                    return;
                } else {
                    // Load view
                    flash('login_failed', 'Invalid username or Password', 'alert alert-danger');
                    redirect('admin');
                    return;
                }
            } else {
                //load view
                flash('login_failed', 'Invalid username or Password', 'alert alert-danger');
                redirect('admin');
                return;
            }
        } else {
            // Load view
            redirect('admin');
            return;
        }
    }
    public function logout()
    {
        unset($_SESSION['admin_id']);
        session_destroy();
        flash('logout_successful', 'User Successfully Logged Out', 'alert alert-danger');
        redirect('admin');
    }

    public function createAdminSession($admin)
    {
        $_SESSION['admin_id'] = $admin->administrator_id;
        redirect('admin');
    }
}