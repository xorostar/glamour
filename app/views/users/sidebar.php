<div class="sidebar">
	<div class="well navbar">
		<h4 class="uppercase">ACCOUNT DASHBOARD</h4>
		<hr>
		<a href="<?php getLink('users/account'); ?>" class="uppercase <?php echo $data['active'] == 'account' ? 'active' : '';?>">Account Dashboard</a>
		<a href="<?php getLink('users/update'); ?>" class="uppercase <?php echo $data['active'] == 'update' ? 'active' : '';?>">Update Information</a>
		<a href="<?php getLink('users/cart'); ?>" class="uppercase <?php echo $data['active'] == 'cart' ? 'active' : '';?>">My Cart</a>
		<a href="<?php getLink('users/orders'); ?>" class="uppercase <?php echo $data['active'] == 'order' ? 'active' : '';?>">My Orders</a>
		<a href="<?php getLink('users/orders_history'); ?>" class="uppercase <?php echo $data['active'] == 'order-history' ? 'active' : '';?>">Order History</a>
		<a href="<?php getLink('users/wishlist'); ?>" class="uppercase <?php echo $data['active'] == 'wishlist' ? 'active' : '';?>">My Wishlist</a>
	</div>
	<div class="well">
		<h4 class="uppercase">Wishlist</h4>
		<hr>
		<div class="alert alert-info">
			Wishlist Support Coming Soon!
		</div>
	</div>
</div>
