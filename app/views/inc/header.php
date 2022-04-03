<?php $store_data = loadStoreData(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php getLink('css/all.min.css') ?>">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Playfair+Display:400,700,900"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="<?php getLink('css/global.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/helper-classes.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/header.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/footer.css'); ?>">
    <?php
	if ($data['active'] == 'homepage') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/hero-slider.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/category-section.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/blog-section.css'); ?>">
    <script src="<?php getLink('js/jquery.min.js') ?>"></script>
    <script src="<?php getLink('js/popper.min.js'); ?>"></script>
    <script src="<?php getLink('js/bootstrap.min.js'); ?>"></script>
    <?php
}
?>

    <?php
	if ($data['active'] == 'signin' || $data['active'] == 'signup') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/form.css'); ?>">
    <?php
}
?>

    <?php
	if ($data['active'] == 'products') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/products.css'); ?>">
    <?php
}
?>

    <?php
	if ($data['active'] == 'pages') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/pages.css'); ?>">
    <?php
}
?>

    <?php
	if ($data['active'] == 'product') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/product.css'); ?>">
    <?php
}
?>

    <?php
	if ($data['active'] == 'lookbook') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/lookbook.css'); ?>">
    <?php
}
?>

    <?php
	if ($data['active'] == 'account' || $data['active'] == 'update' || $data['active'] == 'cart' || $data['active'] == 'orders' || $data['active'] == 'wishlist' || $data['active'] == 'order' || $data['active'] == 'order-history') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/account.css'); ?>">
    <?php
}
?>

    <?php
	if ($data['active'] == 'update') {
		?>
    <link rel="stylesheet" href="<?php getLink('css/update.css'); ?>">
    <?php
}
?>
    <link rel="icon" href="<?php getLink('img/' . $store_data->logo); ?>">
    <script>
    function confirmAction(e) {
        if (confirm('Are you sure you want to perform this action?')) {
            return;
        } else {
            e.preventDefault();
        }
    }
    </script>
    <title>
        <?php echo isset($data['active_category']) ? ucwords($data['active_category']) . ' | ' . $store_data->name : ucwords($data['active']) . ' | ' . $store_data->name; ?>
    </title>
</head>

<body>
    <header>
        <div class="top-panel">
            <div class="container">
                <ul class="left inline-list uppercase">
                    <li>
                        Free Shipping Across Pakistan
                    </li>
                </ul>
                <ul class="right inline-list uppercase">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <li>
                        <a href="<?php getLink('users/account'); ?>">My Account</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="<?php getLink('pages/lookbook'); ?>">Lookbook</a>
                    </li>
                    <li>
                        <a href="#"><i class="far fa-heart"></i> Wishlist</a>
                    </li>
                    <?php if (!isset($_SESSION['user_id'])) { ?>
                    <li>
                        <a href="<?php getLink('users/signup'); ?>"><i class="far fa-user-circle"></i> Create an
                            account</a>
                    </li>
                    <?php } ?>
                    <li>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                        <a href="<?php getLink('users/logout'); ?>">Sign Out</a>
                        <?php } else { ?>
                        <a href="<?php getLink('users/signin'); ?>">Sign In</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="branding">
            <div class="container">
                <a href="<?php echo URLROOT; ?>" id="logo">
                    <img src="<?php getLink('img/' . $store_data->logo); ?>" alt="logo">
                    <h1>
                        <?php echo $store_data->name; ?>
                    </h1>
                </a>
                <a id="my-cart" href="<?php getLink('users/cart') ?>">
                    <div class="left">
                        <i class="fas fa-shopping-cart"></i>
                        <div id="cart-items-quantity"><?php echo getCartItemsCount(); ?></div>
                    </div>
                    <div class="right">
                        <div class="top">
                            My Cart
                        </div>
                        <div class="bottom">
                            PKR <?php echo number_format(getCartItemsTotal()); ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <nav>
            <div class="container">
                <ul class="inline-list uppercase left">
                    <?php $menu_items = loadMenu();
					foreach ($menu_items as $menu_item) {
						?>
                    <li>
                        <a
                            href="<?php getLink('products/menu/' . $menu_item->menu_item_id); ?>"><?php echo $menu_item->menu_item_name; ?></a>
                        <?php
							$submenuItems = loadSubmenu($menu_item);
							if (count($submenuItems) > 0) {
								?>
                        <i class="fas fa-caret-down"></i>
                        <div class="submenu">
                            <ul>
                                <li>
                                    <a href="<?php getLink('products/menu/' . $menu_item->menu_item_id); ?>"><?php echo $menu_item->menu_item_name; ?>
                                    </a>
                                </li>
                                <?php
										foreach ($submenuItems as $submenuItem) {
											?>
                                <li><a
                                        href="<?php getLink('products/submenu/' . $submenuItem->submenu_item_id); ?>"><?php echo $submenuItem->submenu_item_name; ?></a>
                                </li>
                                <?php
									}
									?>
                            </ul>
                        </div>
                    </li>
                    <?php
					}
				}
				?>
                </ul>
                <div class="right search">
                    <input type="text" id="search" placeholder="Search entire store here..." autocomplete="off">
                    <label for="search"><i class="fab fa-sistrix"></i></label>
                </div>
            </div>
        </nav>
    </header>