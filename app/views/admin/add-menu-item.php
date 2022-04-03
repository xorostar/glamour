<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">Add Menu Item</h1>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <?php if (count($data['menu_items']) == 8) { ?>
                            <div class="alert alert-info text-center">Menu already has 8 items, to add a new option
                                either delete an existing item or edit any current one.</div>
                            <?php } else {
                            flash('message');
                            ?>
                            <form action="<?php getLink('admin/addMenuItem'); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php flash('validation_message'); ?>
                                <h4 class="text-center pb-3">Add New Menu Item</h4>
                                <div class="form-group">
                                    <label for="name">Menu Item Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="order">Menu Item Order:</label>
                                    <select name="order" id="order" class="form-control" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Menu Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                </div>
                                <div class="text-muted text-center pb-2">Menu supports a maximum of 8 options, so choose
                                    wisely.</div>
                                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Add
                                    Menu Item</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 class="text-center pb-3">Menu Items</h4>
                                <table class="table table-hover table-sm text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Menu Item Name</th>
                                            <th>Order</th>
                                            <th>Thumbnail</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['menu_items'] as $menu_item) { ?>
                                        <tr>
                                            <td><?php echo $menu_item->menu_item_name; ?></td>
                                            <td><?php echo $menu_item->menu_item_order; ?></td>
                                            <td class="text-center"><img
                                                    src="<?php getLink('img/' . $menu_item->image_uri); ?>" alt=""
                                                    style="height:50px !important;"></td>
                                            <td>
                                                <a href="<?php getLink('admin/editMenuItem/' . $menu_item->menu_item_id); ?>"
                                                    class="btn btn-primary m-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?php getLink('admin/deleteMenuItem/' . $menu_item->menu_item_id); ?>"
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