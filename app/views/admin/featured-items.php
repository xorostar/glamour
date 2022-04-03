<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
	<div class="row pt-3 pb-2 mb-3 border-bottom">
		<div class="container">
			<h1 class="text-center display-4 my-5">Add Featured Items</h1>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<?php flash('message'); ?>
					<?php if ($data['featured_count'] == 6) { ?>
					<div class="alert alert-danger">You have reached a maximum of 6 featured categories, to add any new
						featured item please remove an existing one.</div>
					<?php } else { ?>
					<div class="alert alert-info">You can select a maximum of 6 featured categories</div>
					<?php } ?>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<h4 class="text-center pb-3">Menu Items</h4>
								<table class="table table-hover table-sm text-center">
									<thead class="thead-light">
										<tr>
											<th>Menu Item Name</th>
											<th>Order</th>
											<th>Thumbnail</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data['menu_items'] as $menu_item) { ?>
										<tr>
											<td><?php echo $menu_item->menu_item_name; ?></td>
											<td><?php echo $menu_item->menu_item_order; ?></td>
											<td class="text-center"><img src="<?php getLink('img/' . $menu_item->image_uri); ?>" alt="" class="img-thumbnail" style="height:50px !important;"></td>
											<td>
												<?php if ($menu_item->featured == false) { ?>
												<?php if ($data['featured_count'] < 6) { ?>
												<a class="btn btn-sm my-1 btn-success" href="<?php echo getLink('admin/addToFeatured/' . $menu_item->menu_item_id . '?type=menu'); ?>">
													<i class="far fa-star"></i>
												</a>
												<?php } ?>
												<?php } else { ?>
												<a class="btn btn-sm my-1 btn-warning text-light" href="<?php echo getLink('admin/removeFromFeatured/' . $menu_item->menu_item_id . '?type=menu'); ?>">
													<i class="fas fa-star"></i>
												</a>
												<?php } ?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<h4 class="text-center pb-3">Submenu Items</h4>
								<table class="table table-hover table-sm text-center">
									<thead class="thead-light">
										<tr>
											<th>Menu Item Name</th>
											<th>Submenu Item Name</th>
											<th>Order</th>
											<th>Thumbnail</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data['submenu_items'] as $submenu_item) { ?>
										<tr>
											<td><?php echo $submenu_item->menu_item_name; ?></td>
											<td><?php echo $submenu_item->submenu_item_name; ?></td>
											<td><?php echo $submenu_item->submenu_item_order; ?></td>
											<td class="text-center"><img src="<?php getLink('img/' . $submenu_item->image_uri); ?>" alt="" style="height:50px !important;" class="img-thumbnail"></td>
											<td>
												<?php if ($submenu_item->featured_status == false) { ?>
												<?php if ($data['featured_count'] < 6) { ?>
												<a class="btn btn-sm my-1 btn-success" href="<?php echo getLink('admin/addToFeatured/' . $submenu_item->submenu_item_id . '?type=submenu'); ?>">
													<i class="far fa-star"></i>
												</a>
												<?php } ?>
												<?php } else { ?>
												<a class="btn btn-sm my-1 btn-warning text-light" href="<?php echo getLink('admin/removeFromFeatured/' . $submenu_item->submenu_item_id . '?type=submenu'); ?>">
													<i class="fas fa-star"></i>
												</a>
												<?php } ?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
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
