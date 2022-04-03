<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="card  text-center">
				<div class="card-body">
					<h4>Lifetime Sales</h4>
					<h5 class="text-primary">Rs <?php echo number_format($data['lifetime_sales']); ?></h5>
				</div>
			</div>
			<div class="card mt-2 text-center">
				<div class="card-body">
					<h4>Average Order</h4>
					<h5>Rs <?php echo number_format($data['average_order']); ?></h5>
				</div>
			</div>
			<div class="card mt-5">
				<div class="card-body">
					<div class="table-responsive">
						<h4 class="text-left pb-3">Last Orders</h4>
						<table class="table table-hover table-sm">
							<thead class="thead-light">
								<tr>
									<th scope="col">Customer</th>
									<th scope="col">Order Status</th>
									<th scope="col">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data['last_orders'] as $order) { ?>
								<tr>
									<td><?php echo $order->customer_name; ?></td>
									<td><?php echo $order->status ?></td>
									<td><?php echo number_format($order->total_amount); ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<h6>Revenue</h6>
							<h4 class="text-primary">Rs <?php echo number_format($data['lifetime_sales']); ?></h4>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<h6>Orders</h6>
							<h4><?php echo number_format($data['orders_count']); ?></h4>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<h6>Pending</h6>
							<h4><?php echo number_format($data['pending_orders_count']); ?></h4>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<h6>Customers</h6>
							<h4><?php echo number_format($data['customers_count']); ?></h4>
						</div>
					</div>
				</div>
			</div>
			<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="best-seller-tab" data-toggle="tab" href="#bestsellers" role="tab" aria-controls="bestsellers" aria-selected="true">Best Sellers</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="mostviewedproducts-tab" data-toggle="tab" href="#mostviewedproducts" role="tab" aria-controls="mostviewedproducts" aria-selected="false">Most Viewed Products</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="newcustomers-tab" data-toggle="tab" href="#newcustomers" role="tab" aria-controls="newcustomers" aria-selected="false">New Customers</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="bestsellers" role="tabpanel" aria-labelledby="best-seller-tab">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<h4 class="text-left pb-3">Best Selling Products <small class="text-muted">(Top
										5)</small></h4>
								<table class="table table-hover table-sm">
									<thead class="thead-light">
										<tr>
											<th>Id</th>
											<th>SKU</th>
											<th>Name</th>
											<th>Image</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php $db = new Database(); ?>
										<?php foreach ($data['best_selling_product_ids'] as $id) { ?>
										<?php
                                            $id = $id->product_id;
                                            $db->query("SELECT * FROM products WHERE product_id = $id");
                                            $product = $db->fetchOne();
                                            $db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = $id");
                                            $image = $db->fetchOne()->image_uri;
                                            ?>
										<tr>
											<td><?php echo $product->product_id; ?></td>
											<td><?php echo $product->SKU; ?></td>
											<td><?php echo $product->product_name; ?></td>
											<td class="text-center"><img src="<?php getLink('img/' . $image); ?>" alt="" style="height:50px !important;"></td>
											<td>
												<a href="<?php getLink('products/product/' . $product->product_id); ?>" class="btn btn-primary m-1">
													<i class="fas fa-eye"></i>
												</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="mostviewedproducts" role="tabpanel" aria-labelledby="mostviewedproducts-tab">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<h4 class="text-left pb-3">Most View Products <small class="text-muted">(Top 5)</small>
								</h4>
								<table class="table table-hover table-sm">
									<thead class="thead-light">
										<tr>
											<th>Id</th>
											<th>SKU</th>
											<th>Name</th>
											<th>Image</th>
											<th>Views</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php $db = new Database(); ?>
										<?php foreach ($data['most_viewed_products'] as $product) { ?>
										<?php
                                            $db->query("SELECT image_uri FROM product_images WHERE product_images.product_id = $product->product_id");
                                            $image = $db->fetchOne()->image_uri;
                                            ?>
										<tr>
											<td><?php echo $product->product_id; ?></td>
											<td><?php echo $product->SKU; ?></td>
											<td><?php echo $product->product_name; ?></td>
											<td class="text-center"><img src="<?php getLink('img/' . $image); ?>" alt="" style="height:50px !important;"></td>
											<td><?php echo $product->views; ?></td>
											<td>
												<a href="<?php getLink('products/product/' . $product->product_id); ?>" class="btn btn-primary m-1">
													<i class="fas fa-eye"></i>
												</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="newcustomers" role="tabpanel" aria-labelledby="newcustomers">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<h4 class="text-left pb-3">New Customers <small class="text-muted">(Top 5)</small></h4>
								<table class="table table-hover table-sm">
									<thead class="thead-light">
										<tr>
											<th scope="col">Customer</th>
											<th scope="col">Email</th>
											<th scope="col">Subscriber</th>
											<th scope="col">Joining</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data['new_customers'] as $customer) { ?>
										<tr>
											<td><?php echo $customer->first_name . ' ' . $customer->last_name; ?></td>
											<td><?php echo $customer->email_id; ?></td>
											<td><?php echo $customer->subscriber ? 'Yes' : 'No'; ?></td>
											<td><?php echo $customer->created_at; ?></td>
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

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>
