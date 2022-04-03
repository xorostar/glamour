<?php require APPROOT . '/views/inc/header.php';?>
<section>
	<div class="container">
		<main>
			<section id="dashboard-area">
				<?php require APPROOT . '/views/users/sidebar.php'; ?>
				<div class="main">
					<h1 class="uppercase">Update Cart Item</h1>
					<div class="well">
						<h3>Update Cart Item Form</h3>
						<?php 
							$cart_item = $data['cart_item']; 
							flash('cart_item_update_err');
						?>

						<form action="<?php getLink('users/updateCartItem'); ?>" method="post" class="flex-space-around">
							<?php 
								$db = new Database(); 
								$db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = {$cart_item->product_id}");
								$image = $db->fetchAll()[0]->image_uri;
							?>
							<div>
								<img src="<?php getLink('img/' . $image) ?>" width="300px">
							</div>
							<div>
								<label>Item Name: <?php echo $cart_item->product_name; ?></label>
								<label>Product Price: <?php echo $cart_item->product_price; ?></label>
								<label>Old Quantity: <?php echo $cart_item->quantity; ?></label>
								<div class="form-inline mb-3">
									<label for="quantity">New Quantity: </label>
									<input type="number" name="quantity" name="quantity" id="quantity" value="<?php echo $cart_item->quantity; ?>" min="1" max="50">
								</div>
								<input type="hidden" value="<?php echo $cart_item->cart_item_id; ?>" name="cart_item_id">
								<button type="submit" class="uppercase btn btn-dark btn-block w-100">Save</button>
							</div>
						</form>
						<hr>
					</div>
				</div>
			</section>
		</main>
	</div>
</section>
<?php require APPROOT . '/views/inc/footer.php';?>
