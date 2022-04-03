<?php 
	require APPROOT . '/views/inc/header.php';
	$product = $data['product'];
?>
<section>
	<div class="container">
		<?php flash('review_submission_successful'); ?>
		<?php flash('unauthorised_cart'); ?>
		<?php flash('cart_transaction_successful'); ?>
		<div class="product">
			<?php
				$db = new Database();
				$db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = {$product->product_id}");
				$images = $db->fetchAll();
			?>
			<div class="product-thumbnail">
				<img src="<?php getLink('img/' . $images[0]->image_uri); ?>" alt="<?php echo $images[0]->image_uri; ?>">
			</div>
			<div class="product-thumbnails">
				<?php for($i = 0; $i< count($images); $i++){ ?>
				<img src="<?php getLink('img/' . $images[$i]->image_uri); ?>" alt="<?php echo $images[$i]->image_uri; ?>" onclick="switchImage(event);">
				<?php } ?>
			</div>
			<div class="product-options">
				<h2><?php echo $product->product_name; ?></h2>
				<small class="uppercase">SKU# <?php echo $product->SKU ?></small>
				<!--				<a href="#" class="uppercase">Be the first to review this product</a>-->
				<a href="#review-form" class="uppercase">Write a review</a>
				<h4 class="uppercase text-red">
					<?php echo $product->quantity>0?'In Stock':'Out Of Stock'; ?>
				</h4>
				<div class="inline">
					<?php if($product->sale_item){
							?>
					<h2>PKR <?php echo number_format($product->price*((100-$product->discount_rate)/100)); ?> </h2>
					<span class="text-red">&nbsp;was</span><strike> PKR <?php echo number_format($product->price); ?></strike>
					<?php
						}else{
					?>
					<h2>PKR <?php echo number_format($product->price); ?></h2>
					<?php
						} ?>
				</div>
				<?php if($product->quantity > 0){ ?>
				<form action="<?php getLink('users/addToCart'); ?>" method="post">
					<label for="quantity">Select Quantity: </label>
					<input type="number" value="1" min="1" max="50" name="quantity">
					<input type="hidden" value="<?php echo $product->product_id; ?>" name="product_id">
					<button class="uppercase btn btn-dark btn-block w-100 mt-5" type="submit">Add To Cart</button>
				</form>
				<?php } ?>
				<form action="<?php getLink('users/addToWishlist'); ?>" method="post">
					<input type="hidden" value="<?php echo $product->product_id; ?>">
					<button class="uppercase btn btn-light btn-block w-100" type="submit">Add To Wishlist</button>
				</form>
			</div>
		</div>
		<div class="product-details">
			<h3>Details</h3>
			<hr>
			<p><?php echo $product->description; ?></p>
		</div>
		<div class="product-reviews">
			<h3>Reviews</h3>
			<hr>
			<?php flash('review_submission_failed'); ?>
			<div class="reviews">
				<?php if(isset($_SESSION['user_id'])){ ?>
				<div class="review-form" id="review-form">
					<form action="<?php getLink('users/post_review') ?>" method="post">
						<div class="form-group">
							<div class="inline">
								<label for="summary">Summary</label><span class="required">*</span>
							</div>
							<input type="text" name="review_summary" id="summary" placeholder="">
						</div>
						<div class="form-group">
							<div class="inline">
								<label for="review">Review</label><span class="required">*</span>
							</div>
							<textarea name="review" id="review" rows="10"></textarea>
						</div>
						<input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
						<button type="submit" class="btn btn-dark">Submit Review</button>
					</form>
				</div>
				<?php }else{ ?>
				<div class="alert alert-warning">
					<i class="fas fa-exclamation-triangle"></i>
					Only registered users can write reviews. Please <a href="<?php getLink('users/signin'); ?>">Sign in</a> or <a href="<?php getLink('users/signup'); ?>">Create an account</a>
				</div>
				<?php } ?>
				<?php $product_reviews = $data['product_reviews'];?>
				<?php foreach($product_reviews as $review){ ?>
				<div class="review">
					<p><?php echo $review->review_summary; ?></p>
					<p><?php echo $review->review; ?></p>
					<div class="review-details">
						<p>By <?php echo $review->first_name . ' ' . $review->last_name;?></p>
						<p><?php echo $review->created_at;?></p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<script>
	var selected = document.querySelector('.product-thumbnails img');
	selected.classList.add('selected');

	function switchImage(e) {
		selected.classList.remove('selected');
		selected = e.currentTarget;
		selected.classList.add('selected');
		var targetSrc = e.currentTarget.src;
		var thumbnail = document.querySelector('.product-thumbnail img');
		thumbnail.src = targetSrc;
	}

</script>
<?php require APPROOT . '/views/inc/footer.php';?>
