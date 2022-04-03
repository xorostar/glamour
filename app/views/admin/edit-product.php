<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <form action="<?php getLink('admin/editProduct/' . $data['product']->product_id); ?>" method="post"
                enctype="multipart/form-data">
                <h1 class="text-center display-4 my-5">Edit Product</h1>
                <hr>
                <?php flash('validation_message'); ?>
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="<?php echo $data['product']->product_name; ?>">
                </div>
                <div class="form-group">
                    <label for="sku">SKU:</label>
                    <input type="text" class="form-control" id="sku" name="sku" required
                        value="<?php echo $data['product']->SKU; ?>">
                </div>
                <div class="form-group">
                    <label for="discount-rate">Discount in % (If any):</label>
                    <input type="number" class="form-control" id="discount-rate" name="discount"
                        value="<?php echo $data['product']->discount_rate; ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" required
                        value="<?php echo $data['product']->price; ?>">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required
                        value="<?php echo $data['product']->quantity; ?>">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="menu_item_id" required>
                        <?php foreach ($data['submenu_items'] as $submenu_item) { ?>
                        <option value="<?php echo $submenu_item->submenu_item_id; ?>"
                            <?php echo $submenu_item->submenu_item_id == $data['product']->menu_item_id ? 'selected' : ''; ?>>
                            <?php echo $submenu_item->menu_item_name . ' / ' . $submenu_item->submenu_item_name; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="images">Images:</label>
                    <div class="d-block">
                        <?php
						$db = new Database();
						$db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = {$data['product']->product_id}");
						$images = $db->fetchAll();
						foreach ($images as $image) {
							?>
                        <img src="<?php getLink('img/' . $image->image_uri); ?>" style="width:100px;"
                            class="my-2 img-thumbnail" alt="">
                        <?php } ?>
                    </div>
                    <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                </div>
                <div class="form-group">
                    <label for="description">Product Description:</label>
                    <textarea required name="description" id="description"
                        class="form-control"><?php echo $data['product']->description; ?> </textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Save</button>
            </form>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>