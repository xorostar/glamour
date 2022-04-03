<?php require APPROOT . '/views/inc/header.php';?>

<div class="container">
	<h1 style="text-align:center; font-weight:700; background-color:#282828; padding:30px; color:#fff;">
		Welcome to our Lookbook
	</h1>
	<div class="gallery">
		<?php
foreach($data['images'] as $image){
	?>
		<a href="<?php getLink('products/product/' . $image->product_id); ?>">
			<img src="<?php getLink('img/' . $image->image_uri); ?>" alt="" width="100%" height="auto" class="gallery-img">
		</a>
		<?php
}
?>
	</div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
