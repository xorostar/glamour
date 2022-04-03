<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">All Products</h1>
            <hr>
            <?php flash('update_message'); ?>
            <div class="table-responsive" style="max-height:600px">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center thead-light">
                            <th>id</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Real Price</th>
                            <th>Discounted Price</th>
                            <th>Sale Item</th>
                            <th>Visibility</th>
                            <th>Discount Rate</th>
                            <th>Quantity</th>
                            <th>Categorized Under</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $db = new Database(); ?>
                        <?php foreach ($data['products'] as $product) { ?>
                        <?php
							$db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = {$product->product_id}");
							$image = $db->fetchAll()[0]->image_uri;
							?>
                        <tr class="text-center text-nowrap">
                            <td><?php echo $product->product_id; ?></td>
                            <td><?php echo $product->SKU; ?></td>
                            <td class="text-wrap"><?php echo $product->product_name; ?></td>
                            <td class="text-center"><img src="<?php getLink('img/' . $image); ?>" alt=""
                                    style="height:150px !important;"></td>
                            <td>Rs <?php echo number_format($product->price); ?></td>
                            <td>Rs
                                <?php echo number_format($product->price * ((100 - $product->discount_rate) / 100)); ?>
                            </td>
                            <td><?php echo $product->sale_item ? 'Yes' : 'No'; ?></td>
                            <td>
                                <select class="options form-control-sm">
                                    <option value="<?php getLink('admin/setProductVisible/' . $product->product_id); ?>"
                                        <?php echo $product->visibility ? 'selected' : ''; ?>>Yes</option>
                                    <option
                                        value="<?php getLink('admin/setProductInvisible/' . $product->product_id); ?>"
                                        <?php echo !$product->visibility ? 'selected' : ''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo $product->discount_rate . '%'; ?></td>
                            <td><?php echo $product->quantity; ?></td>
                            <td><?php echo $product->menu_item_name . ' / ' . $product->submenu_item_name; ?></td>
                            <td><?php echo $product->views; ?></td>
                            <td class="text-wrap">
                                <a href="<?php getLink('products/product/' . $product->product_id); ?>"
                                    class="btn btn-primary m-1"><i class="fas fa-eye"></i></a>
                                <a href="<?php getLink('admin' . '/editProduct/' . $product->product_id); ?>"
                                    class="btn btn-warning m-1"><i class="fas fa-edit"></i></a>
                                <a href="<?php getLink('admin' . '/delete_product/' . $product->product_id); ?>"
                                    class="btn btn-danger m-1"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
var options = Array.from(document.getElementsByClassName('options'));
options.forEach(function(option) {
    option.addEventListener('change', function() {
        window.location = this.value;
    });
})
</script>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>