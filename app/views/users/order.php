<?php require APPROOT . '/views/inc/header.php';?>
<section>
	<div class="container">
		<main>
			<section id="dashboard-area">
				<?php require APPROOT . '/views/users/sidebar.php'; ?>
				<div class="main">
					<h1 class="uppercase">ORDER</h1>
					<div class="well">
						<h3>Order Details</h3>
						<hr>
						<table class="table uppercase mt-3">
							<thead class="bg-dark">
								<tr>
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
									if(count($data['order']) > 0){
										foreach($data['order'] as $order_item){
								?>
								<tr>
									<?php
										$db->query("SELECT image_uri FROM product_images WHERE product_id = {$order_item->product_id}");
										$image = $db->fetchOne()->image_uri;
										$db->query("SELECT * FROM products WHERE product_id = {$order_item->product_id}");
										$product = $db->fetchOne();
									?>
									<td class="img"><img src="<?php getLink('img/' . $image) ?>" height="100%"></td>
									<td><?php echo $product->product_name; ?></td>
									<td>PKR <?php echo number_format($order_item->product_price); ?></td>
									<td><?php echo $order_item->quantity; ?></td>
									<td>PKR <?php echo number_format($order_item->total_price); ?></td>
									<td>
										<a class="d-block m-1" href="<?php getLink('products/product/' . $product->product_id); ?>"><button class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button></a>
									</td>
								</tr>
								<?php }}else{ ?>
								<tr>
									<td colspan="6">
										<h1 class="text-center">The current order is empty</h1>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot class="bg-dark">
								<tr>
									<td colspan="6" class="text-center uppercase">
										<h3>Total Amount: <?php echo number_format($data['order'][0]->order_total_amount); ?></h3>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</main>
	</div>
</section>
<?php require APPROOT . '/views/inc/footer.php';?>
