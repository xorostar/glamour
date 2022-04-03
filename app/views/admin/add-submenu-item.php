<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">Add Submenu Item</h1>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php getLink('admin/addSubmenuItem'); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php flash('validation_message'); ?>
                                <h4 class="text-center pb-3">Add New Submenu Item</h4>
                                <div class="form-group">
                                    <label for="name">Submenu Item Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="order">Submenu Item Order:</label>
                                    <input type="number" name="order" id="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="parent-menu">Parent Menu</label>
                                    <select name="parent-menu" id="parent-menu" class="form-control">
                                        <?php foreach ($data['menu_items'] as $menu_item) { ?>
                                        <option value="<?php echo $menu_item->menu_item_id; ?>">
                                            <?php echo $menu_item->menu_item_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Submenu Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Add
                                    Submenu Item</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 class="text-center pb-3">Submenu Items</h4>
                                <table class="table table-hover table-sm text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Menu Item Name</th>
                                            <th>Submenu Item Name</th>
                                            <th>Order</th>
                                            <th>Thumbnail</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['submenu_items'] as $submenu_item) { ?>
                                        <tr>
                                            <td><?php echo $submenu_item->menu_item_name; ?></td>
                                            <td><?php echo $submenu_item->submenu_item_name; ?></td>
                                            <td><?php echo $submenu_item->submenu_item_order; ?></td>
                                            <td class="text-center"><img
                                                    src="<?php getLink('img/' . $submenu_item->image_uri); ?>" alt=""
                                                    style="height:50px !important;"></td>
                                            <td>
                                                <a href="<?php getLink('admin/editSubmenuItem/' . $submenu_item->submenu_item_id); ?>"
                                                    class="btn btn-primary m-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?php getLink('admin/deleteSubmenuItem/' . $submenu_item->submenu_item_id); ?>"
                                                    class="btn btn-danger m-1">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>