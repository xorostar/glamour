<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <form action="<?php getLink('admin/addProduct'); ?>" method="post" enctype="multipart/form-data">
                <h1 class="text-center display-4 my-5">Add Product</h1>
                <hr>
                <?php flash('validation_message'); ?>
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="sku">SKU:</label>
                    <input type="text" class="form-control" id="sku" name="sku" required>
                </div>
                <div class="form-group">
                    <label for="discount-rate">Discount in % (If any):</label>
                    <input type="number" class="form-control" id="discount-rate" name="discount">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="menu_item_id" required>
                        <?php foreach ($data['submenu_items'] as $submenu_item) { ?>
                        <option value="<?php echo $submenu_item->submenu_item_id; ?>">
                            <?php echo $submenu_item->menu_item_name . ' / ' . $submenu_item->submenu_item_name; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="images">Images:</label>
                    <input type="file" class="form-control-file" id="images" name="images[]" multiple required>
                </div>
                <div class="form-group">
                    <label for="description">Product Description:</label>
                    <textarea required name="description" id="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Add Product</button>
            </form>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>