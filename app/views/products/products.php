<?php require APPROOT . '/views/inc/header.php';?>
<section>
	<div class="container">
		<div class="breadcrumb uppercase">
			<span><a href="<?php getLink(''); ?>">Home</a></span>
			<i class="fas fa-long-arrow-alt-right"></i>
			<span><a href="#"><?php echo $data['active_menuItem']->menu_item_name; ?></a></span>
			<?php if($data['active_submenuItem']){?>
			<i class="fas fa-long-arrow-alt-right"></i>
			<span><a href="#"><?php echo $data['active_submenuItem']->submenu_item_name; ?></a></span>
			<?php } ?>

		</div>
		<main>
			<?php if($data['active_submenuItem']){?>
			<h2 class="uppercase py-3"><?php echo $data['active_submenuItem']->submenu_item_name; ?></h2>
			<?php }else{ ?>
			<h2 class="uppercase py-3"><?php echo $data['active_menuItem']->menu_item_name; ?></h2>
			<?php } ?>
			<section id="product-area">
				<div class="sidebar">
					<?php if(count($data['submenuItems'])){ ?>
					<div class="well">
						<h4 class="uppercase">Filter</h4>
						<hr>
						<ul class="root">
							<li>
								<span class="uppercase" onclick="toggleList(event)">Category <i class="fas fa-angle-down" style="position:absolute; right: 10px;"></i></span>
								<ul class="hidden" style="padding-left:10px;">
									<?php
										foreach($data['submenuItems'] as $submenuItem){
										?>
									<li><a href="<?php echo URLROOT . '/products/submenu/' . $submenuItem->submenu_item_id; ?>"><i class="fas fa-angle-right"></i> <?php echo $submenuItem->submenu_item_name;?></a></li>
									<?php
										}
										?>
								</ul>
							</li>
						</ul>
						<!--
						<ul class="root">
							<li>
								<span class="uppercase" onclick="toggleList(event)">Size <i class="fas fa-angle-down" style="position:absolute; right: 10px;"></i></span>
								<ul class="hidden" style="padding-left:10px;">
									<li><a href="#"><i class="fas fa-angle-right"></i> XS</a></li>
									<li><a href="#"><i class="fas fa-angle-right"></i> SM</a></li>
									<li><a href="#"><i class="fas fa-angle-right"></i> M</a></li>
									<li><a href="#"><i class="fas fa-angle-right"></i> L</a></li>
									<li><a href="#"><i class="fas fa-angle-right"></i> XL</a></li>
								</ul>
							</li>
						</ul>
						<ul class="root">
							<li>
								<span class="uppercase" onclick="toggleList(event)">Product Type <i class="fas fa-angle-down" style="position:absolute; right: 10px;"></i></span>
								<ul class="hidden" style="padding-left:10px;">
									<li><a href="#"><i class="fas fa-angle-right"></i> 1PC</a></li>
									<li><a href="#"><i class="fas fa-angle-right"></i> 2PC</a></li>
									<li><a href="#"><i class="fas fa-angle-right"></i> 3PC</a></li>
								</ul>
							</li>
						</ul>
-->
					</div>
					<?php } ?>
					<div class="well">
						<h4 class="uppercase">Wishlist</h4>
						<hr>
						<div class="alert alert-info">
							Wishlist Support Coming Soon!
						</div>
					</div>
				</div>
				<div class="products">
					<div class="sort-options">
						<span class="left"><?php echo $data['products_count'] == 1 ? $data['products_count'] . ' item' : $data['products_count'] . ' items' ; ?> </span>
						<span class="right" style="position:relative;">
							<label for="sorting-options">Sort By </label>
							<select id="sorting-options">
								<option value="<?php echo sortbyurl('position');?>" <?php echo !isset($_GET['sortby']) || $_GET['sortby'] == 'position'?'selected' : ''; ?>>Position</option>
								<option value="<?php echo sortbyurl('price'); ?>" <?php echo isset($_GET['sortby']) && $_GET['sortby'] == 'price'?'selected' : '';?>>Price</option>
								<option value="<?php echo sortbyurl('quantity'); ?>" <?php echo isset($_GET['sortby']) && $_GET['sortby'] == 'quantity'?'selected' : '';?>>Quantity</option>
								<option value="<?php echo sortbyurl('newest'); ?>" <?php echo isset($_GET['sortby']) && $_GET['sortby'] == 'newest'?'selected' : '';?>>Newest</option>
							</select>
							<?php if((isset($_GET['sortorder']) && $_GET['sortorder'] == 'desc') || !isset($_GET['sortorder'])){ ?>
							<a href="<?php echo sortorderurl('asc'); ?>">
								<i class="fas fa-arrow-down"></i>
							</a>
							<?php } ?>
							<?php if(isset($_GET['sortorder']) && $_GET['sortorder'] == 'asc'){ ?>
							<a href="<?php echo sortorderurl('desc'); ?>">
								<i class="fas fa-arrow-up"></i>
							</a>
							<?php } ?>
						</span>
					</div>
					<?php 
					if($data['products']){
						$db = new Database();
						foreach($data['products'] as $product){
							$db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = {$product->product_id}");
							$image = $db->fetchAll()[0]->image_uri;
					?>
					<div class="product">
						<a href="<?php getLink("products/product/{$product->product_id}"); ?>" class="product-thumbnail">
							<img src="<?php getLink('img/' . $image); ?>" alt="">
							<?php if($product->sale_item){ ?>
							<span class="right discount-sticker"><?php echo $product->discount_rate . '%'; ?></span>
							<?php } ?>
							<span class="left"><i class="far fa-heart"></i></span>
						</a>
						<div class="price">
							<a class="uppercase" href="<?php getLink("products/product/{$product->product_id}"); ?>"><?php echo $product->product_name; ?></a>
							<div class="uppercase">
								<?php 
								if($product->quantity > 0){
							?>
								<?php if($product->sale_item){
							?>
								PKR <?php echo number_format($product->discounted_price); ?>
								<strike>PKR <?php echo number_format($product->price); ?></strike><?php
						}else{
							?>
								PKR <?php echo number_format($product->price); ?>
								<?php
						} ?>
								<?php }else{
									?>

								<span class="text-red">OUT OF STOCK</span>
								<?php
								} ?>
							</div>
							<a href="<?php getLink("products/product/{$product->product_id}"); ?>">Learn More</a>
						</div>
					</div>
					<?php
					}
}else{ ?>
					<h1 style="font-weight:bold; font-size:40px; text-align:center; margin:auto; grid-column:1/4;" class="p-5">Products Coming Soon</h1>
					<?php } ?>
				</div>
			</section>
		</main>
	</div>
</section>
<script>
	function toggleList(e) {
		e.currentTarget.firstElementChild.classList.toggle('fa-angle-down');
		e.currentTarget.firstElementChild.classList.toggle('fa-angle-up');
		e.currentTarget.nextElementSibling.classList.toggle('hidden');
		e.currentTarget.nextElementSibling.classList.toggle('visible');
	}

	var sortingOptions = document.getElementById('sorting-options');
	sortingOptions.addEventListener('change', function() {
		window.location = this.value;
	});

</script>
<?php require APPROOT . '/views/inc/footer.php';?>
