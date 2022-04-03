<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">Order Details</h1>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Order Id</th>
                            <th scope="col">Item</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">QTY</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$db = new Database();
						if (count($data['order']) > 0) {
							foreach ($data['order'] as $order_item) {
								?>
                        <tr>
                            <?php
									$db->query("SELECT image_uri FROM product_images WHERE product_id = {$order_item->product_id}");
									$image = $db->fetchOne()->image_uri;
									$db->query("SELECT * FROM products WHERE product_id = {$order_item->product_id}");
									$product = $db->fetchOne();
									?>
                            <td><?php echo $order_item->order_id; ?></td>
                            <td class="img"><img src="<?php getLink('img/' . $image) ?>"
                                    style="height:150px !important;"></td>
                            <td><?php echo $product->product_name; ?></td>
                            <td>PKR <?php echo number_format($order_item->product_price); ?></td>
                            <td><?php echo $order_item->quantity; ?></td>
                            <td>PKR <?php echo number_format($order_item->total_price); ?></td>
                            <td>
                                <a class="d-block m-1"
                                    href="<?php getLink('products/product/' . $product->product_id); ?>"><button
                                        class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button></a>
                            </td>
                        </tr>
                        <?php }
					} else { ?>
                        <tr>
                            <td colspan="6">
                                <h1 class="text-center">This order has no items currently</h1>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h3>Total Amount: <?php echo number_format($data['order'][0]->total_amount); ?></h3>
                            </td>
                        </tr>
                    </tfoot>
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