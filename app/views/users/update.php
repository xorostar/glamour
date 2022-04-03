<?php require APPROOT . '/views/inc/header.php';?>
<section>
	<div class="container">
		<main>
			<section id="dashboard-area">
				<?php require APPROOT . '/views/users/sidebar.php'; ?>
				<?php $user = $data['user']; ?>
				<div class="main">
					<h1 class="uppercase">Update Information</h1>
					<div class="well">
						<h3>Update Form</h3>
						<hr>
						<div class="mt-3">
							<form action="<?php getLink('users/update'); ?>" method="post">
								<?php flash('update_successful'); ?>
								<?php flash('update_failed'); ?>
								<label for="first_name">First Name:</label>
								<input type="text" id="first_name" name="first_name" placeholder="First Name" autocomplete="on" value="<?php echo $user->first_name; ?>">
								<?php echo isset($data['fname_err']) && $data['fname_err']!== ''?'<small class="text-red">*' . $data['fname_err'] . '</small>':''; ?>
								<label for="last_name">Last Name:</label>
								<input type="text" id="last_name" name="last_name" placeholder="Last Name" autocomplete="on" value="<?php echo $user->last_name; ?>">
								<?php echo isset($data['lname_err']) && $data['lname_err']!== ''?'<small class="text-red">*' . $data['lname_err'] . '</small>':''; ?>
								<label for="email">Email:</label>
								<input type="email" id="email" name="email" placeholder="Email" autocomplete="on" value="<?php echo $user->email_id; ?>">
								<?php echo isset($data['email_err']) && $data['email_err']!== ''?'<small class="text-red">*' . $data['email_err'] . '</small>':''; ?>
								<div style="display:flex;">
									<input type="checkbox" name="subscriber" value="1" style="margin-right:10px;" <?php echo $user->subscriber?'checked':''; ?>><span> Sign Up For Newsletter</span>
								</div>
								<br>
								<hr>
								<br>
								<h4>ADDRESS INFORMATION</h4>
								<label for="shipping_address">Shipping Address:</label>
								<input type="text" name="shipping_address" id="shipping_address" placeholder="Shipping Address" autocomplete="on" value="<?php echo $user->shipping_address; ?>">
								<?php echo isset($data['shipping_address_err']) && $data['shipping_address_err']!== ''?'<small class="text-red">*' . $data['shipping_address_err'] . '</small>':''; ?>
								<button type="submit" class="uppercase btn btn-dark btn-block w-100">Save</button>
							</form>
						</div>
					</div>
				</div>
			</section>
		</main>
	</div>
</section>
<?php require APPROOT . '/views/inc/footer.php';?>
