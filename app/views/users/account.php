<?php require APPROOT . '/views/inc/header.php';?>
<section>
	<div class="container">
		<main>
			<section id="dashboard-area">
				<?php require APPROOT . '/views/users/sidebar.php'; ?>
				<div class="main">
					<?php flash('message'); ?>
					<h1 class="uppercase">MY DASHBOARD</h1>
					<div class="well">
						<h3>Account Information</h3>
						<hr>
						<div class="mt-3">
							<h4>Contact Information</h4>
							<p><?php echo $data['user']->first_name . ' ' . $data['user']->last_name; ?></p>
							<p><?php echo $data['user']->email_id; ?></p>
							<p><?php echo $data['user']->shipping_address; ?></p>
						</div>
						<div class="mt-3">
							<h4>Newsletter</h4>
							<?php flash('subscription_successful'); ?>
							<?php flash('unsubscription_successful'); ?>
							<?php if($data['user']->subscriber){?>
							<p>You are subscribed to our newsletter</p>
							<a href="<?php getLink('users/unsubscribe'); ?>"><button class="btn btn-dark">Unsubscribe</button></a>
							<?php }else{ ?>
							<p>You are not subscribed to our newsletter</p>
							<a href="<?php getLink('users/subscribe'); ?>"><button class="btn btn-dark">Subscribe</button></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
		</main>
	</div>
</section>
<?php require APPROOT . '/views/inc/footer.php';?>
