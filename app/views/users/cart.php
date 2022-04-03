<?php require APPROOT . '/views/inc/header.php';?>
<section>
	<div class="container">
		<main>
			<section id="dashboard-area">
				<div class="sidebar">
					<div class="well navbar">
						<h4 class="uppercase">ACCOUNT DASHBOARD</h4>
						<hr>
						<a href="<?php getLink('users/account'); ?>" class="uppercase"><i class="fas fa-arrow-circle-left"></i> Back to dashboard</a>
						<?php if(count($data['cart_items']) > 0){ ?>
						<h4 class="uppercase">Summary</h4>
						<hr>
						<h5 class="mt-3">Estimated Shipping and Tax</h5>
						<hr>
						<h5>TCS/Blue Ex Shipping: <strong>PKR 0</strong></h5>
						<h5>Subtotal: <strong>PKR <?php echo number_format($data['cart_total']); ?></strong></h5>
						<h5>Shipping: <strong>PKR 0</strong></h5>
						<hr>
						<div class="flex-in-between mt-3" style="font-size:13px;">
							<h3 class="uppercase">ORDER TOTAL:</h3>
							<h3 class="uppercase">PKR <?php echo number_format($data['cart_total']); ?></h3>
						</div>
						<a href="<?php getLink('users/checkout/' . $data['cart_items'][0]->cart_id); ?>"><button class="btn btn-dark btn-block w-100 uppercase mt-3">Checkout</button></a>
						<?php } ?>
					</div>
					<div class="well">
						<h4 class="uppercase">Wishlist</h4>
						<hr>
						<div class="alert alert-info">
							Wishlist Support Coming Soon!
						</div>
					</div>
				</div>
				<div class="main">
					<h1 class="uppercase">SHOPPING CART</h1>
					<div class="well">
						<h3>Your shopping cart items</h3>
						<hr>
						<?php flash('cart_item_updated');?>
						<?php flash('cart_item_removed');?>
						<?php flash('shopping_cart_removed'); ?>
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
									if(count($data['cart_items']) > 0){
										foreach($data['cart_items'] as $cart_item){
								?>
								<tr>
									<?php
										$db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = {$cart_item->product_id}");
										$image = $db->fetchAll()[0]->image_uri;
									?>
									<td class="img"><img src="<?php getLink('img/' . $image) ?>" height="100%"></td>
									<td><?php echo $cart_item->product_name; ?></td>
									<td>PKR <?php echo number_format($cart_item->product_price); ?></td>
									<td><?php echo $cart_item->quantity; ?></td>
									<td>PKR <?php echo number_format($cart_item->total_price); ?></td>
									<td>
										<a class="d-block m-1" href="<?php getLink('products/product/' . $cart_item->product_id); ?>"><button class="btn btn-block btn-primary"><i class="fas fa-eye"></i></button></a>
										<a class="d-block m-1" href="<?php getLink('users/updateCartItem?cart_item_id=' . $cart_item->cart_item_id); ?>"><button class="btn btn-block btn-warning"><i class="fas fa-edit"></i></button></a>
										<a onclick="confirmAction(event)" class="d-block m-1" href="<?php getLink('users/removeCartItem?cart_item_id=' . $cart_item->cart_item_id);?>"><button class="btn btn-block btn-danger"><i class="fas fa-trash"></i></button></a>
									</td>
								</tr>
								<?php }}else{ ?>
								<tr>
									<td colspan="6">
										<h3 class="text-center py-5 px-3" style="font-weight:400;">There are currently no items in cart.</h3>
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="6">
										<a href="<?php getLink(''); ?>"><button class="btn btn-dark uppercase">Continue Shopping</button></a>
										<?php if(count($data['cart_items']) > 0){ ?>
										<a onclick="confirmAction(event)" href="<?php getLink('users/clearShoppingCart?cart_id=' . $cart_item->cart_id);?>"><button class="btn btn-dark uppercase">Clear Shopping Cart</button></a>
										<a href="<?php getLink('users/checkout/' . $cart_item->cart_id); ?>"><button class="btn btn-dark uppercase">Checkout</button></a>
										<?php } ?>
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
