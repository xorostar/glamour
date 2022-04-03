<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php getLink('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php getLink('css/dashboard-style.css'); ?>">
    <link rel="icon" href="<?php getLink('img/logo.ico'); ?>" type="image/x-icon">
    <title>Admin Panel</title>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php getLink('admin') ?>">Store Manager</a>
        <ul class="navbar-nav flex-row px-3">
            <li class="nav-item text-nowrap mx-3">
                <a class="nav-link" href="<?php getLink(''); ?>">Visit Store</a>
            </li>
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?php getLink('admin/logout') ?>">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $data['active'] == 'homepage' ? 'active' : ''; ?>"
                                href="<?php getLink('admin'); ?>">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $data['active'] == 'orders' ? 'active' : ''; ?>" href="
                                <?php getLink('admin/orders'); ?>">
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="collapse" data-target="#collapseProducts"
                            aria-expanded="false" aria-controls="collapseProducts">
                            <a class="nav-link <?php echo $data['active'] == 'products' ? 'active' : ''; ?>" href="
                                #">
                                <span data-feather="shopping-cart"></span>
                                Products
                                <span data-feather="chevron-down"></span>
                            </a>
                            <ul class="list-group list-group-flush collapse" id="collapseProducts">
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/products'); ?>">
                                        <span data-feather="eye"></span>
                                        View Products
                                    </a>
                                </li>
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/addProduct'); ?>">
                                        <span data-feather="plus-circle"></span>
                                        Add Products
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" data-toggle="collapse" data-target="#collapseCategories"
                            aria-expanded="false" aria-controls="collapseCategories">
                            <a class="nav-link <?php echo $data['active'] == 'menu' ? 'active' : ''; ?>" href=" #">
                                <span data-feather="archive"></span>
                                Menu
                                <span data-feather="chevron-down"></span>
                            </a>
                            <ul class="list-group list-group-flush collapse" id="collapseCategories">
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/addMenuItem'); ?>">
                                        <span data-feather="eye"></span>
                                        Add Menu Item
                                    </a>
                                </li>
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/addSubmenuItem'); ?>">
                                        <span data-feather="plus-circle"></span>
                                        Add Submenu Item
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" data-toggle="collapse" data-target="#collapseCustomers"
                            aria-expanded="false" aria-controls="collapseCustomers">
                            <a class="nav-link <?php echo $data['active'] == 'customers' ? 'active' : ''; ?>"
                                href="<?php getLink('admin/customers'); ?>">
                                <span data-feather="users"></span>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="collapse" data-target="#collapseContent" aria-expanded="false"
                            aria-controls="collapseContent">
                            <a class="nav-link <?php echo $data['active'] == 'content' ? 'active' : ''; ?>" href="#">
                                <span data-feather="layout"></span>
                                Content
                                <span data-feather="chevron-down"></span>
                            </a>
                            <ul class="list-group list-group-flush collapse" id="collapseContent">
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/pages'); ?>">
                                        <span data-feather="file"></span>
                                        Pages
                                    </a>
                                </li>
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/featuredcategories'); ?>">
                                        <span data-feather="star"></span>
                                        Featured Items
                                    </a>
                                </li>
                                <li class="nav-item list-group-item py-0 ml-3">
                                    <a class="nav-link" href="<?php getLink('admin/sliderImages'); ?>">
                                        <span data-feather="sliders"></span>
                                        Slider Images
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $data['active'] == 'store' ? 'active' : ''; ?>"
                                href="<?php getLink('admin/store'); ?>">
                                <span data-feather="shopping-bag"></span>
                                Store
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>