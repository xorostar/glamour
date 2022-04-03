<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('login_successful'); ?>
<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
			$i = 0;
			foreach ($data['slider_images'] as $image) {
				?>
            <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $i; ?>"
                class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
            <?php
				$i++;
			}
			?>
        </ol>
        <div class="carousel-inner">
            <?php
			$i = 0;
			foreach ($data['slider_images'] as $image) {
				?>
            <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                <a href="<?php echo $image->link; ?>">
                    <img src="<?php getLink('img/' . $image->image_uri); ?>" class="d-block w-100" alt="...">
                </a>
            </div>
            <?php
				$i++;
			}
			?>
        </div>
        <?php
		if (count($data['slider_images']) > 1) {
			?>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <?php
	}
	?>
    </div>
</div>

<div id="category-section">
    <div class="container">
        <?php $counter = 0; ?>
        <?php foreach ($data['featured_menu_items'] as $featured_menu_item) { ?>
        <div class="section">
            <a href="<?php getLink('products/menu/' . $featured_menu_item->item_id); ?>" class="thumbnail-wrapper">
                <div class="thumbnail"
                    style="background-image: url(<?php getLink('img/' . $featured_menu_item->image_uri); ?>);"></div>
            </a>
            <div class="body">
                <h3 class="uppercase"><?php echo $featured_menu_item->menu_item_name; ?></h3>
                <a href="<?php getLink('products/menu/' . $featured_menu_item->item_id); ?>">Shop Now</a>
            </div>
        </div>
        <?php
			$counter++;
		}
		?>
        <?php foreach ($data['featured_submenu_items'] as $featured_submenu_item) { ?>
        <div class="section">
            <a href="<?php getLink('products/submenu/' . $featured_submenu_item->item_id); ?>"
                class="thumbnail-wrapper">
                <div class="thumbnail"
                    style="background-image: url(<?php getLink('img/' . $featured_submenu_item->image_uri); ?>);"></div>
            </a>
            <div class="body">
                <h3 class="uppercase"><?php echo $featured_submenu_item->submenu_item_name; ?></h3>
                <a href="<?php getLink('products/submenu/' . $featured_submenu_item->item_id); ?>">Shop Now</a>
            </div>
        </div>
        <?php
			$counter++;
		}
		?>
        <?php if ($counter == 0) { ?>
        Featured Items Coming Soon
        <?php } ?>
    </div>
</div>
<!--
<div id="blog-section">
	<div class="section-title">
		<h1 class="uppercase">Blogs and reviews</h1>
		<p class="title-desc uppercase">
			<a href="#">VIEW ALL BLOGS</a>
		</p>
	</div>
	<div class="container">
		<div class="section">
			<a href="#" class="thumbnail-wrapper">
				<div class="thumbnail" style="background-image: url(<?php getLink('img/banner-1.jpg'); ?>);"></div>
				<div class="posted-date">March 19, 2019</div>
			</a>
			<div class="body">
				<a href="#" class="capitalize">How to choose the best towels for yourself</a>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quia optio rem tempora quisquam consequuntur numquam quasi et ipsum laborum?</p>
				<a href="#" class="read-more"><i class="fas fa-angle-double-right"></i> Read more</a>
			</div>
		</div>
		<div class="section">
			<a href="#" class="thumbnail-wrapper">
				<div class="thumbnail" style="background-image: url(<?php getLink('img/banner-2.jpg'); ?>);"></div>
				<div class="posted-date">March 18, 2019</div>
			</a>
			<div class="body">
				<a href="#" class="capitalize">Create fashionable looks with unstiched fabric designs</a>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quia optio rem tempora quisquam consequuntur numquam quasi et ipsum laborum?</p>
				<a href="#" class="read-more"><i class="fas fa-angle-double-right"></i> Read more</a>
			</div>
		</div>
		<div class="section">
			<a href="#" class="thumbnail-wrapper">
				<div class="thumbnail" style="background-image: url(<?php getLink('img/banner-3.jpg'); ?>);"></div>
				<div class="posted-date">March 17, 2019</div>
			</a>
			<div class="body">
				<a href="#" class="capitalize">The ready-to-wear looks of the Spring and &amp; 2019</a>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quia optio rem tempora quisquam consequuntur numquam quasi et ipsum laborum?</p>
				<a href="#" class="read-more"><i class="fas fa-angle-double-right"></i> Read more</a>
			</div>
		</div>
	</div>
</div>
-->
<?php require APPROOT . '/views/inc/footer.php'; ?>