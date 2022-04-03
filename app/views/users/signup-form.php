<?php require APPROOT . '/views/inc/header.php';?>
<section id="form">
	<div class="container">
		<h1 class="uppercase">CREATE NEW CUSTOMER ACCOUNT</h1>
		<p>Creating an account is easy. Just fill in the form below.</p>
		<form action="<?php getLink('users/register'); ?>" method="post">
			<h4>PERSONAL INFORMATION</h4>
			<?php flash('registration_failed'); ?>
			<label for="first_name" hidden="true">First Name:</label>
			<input type="text" id="first_name" name="first_name" placeholder="First Name" autocomplete="on">
			<?php echo isset($data['fname_err']) && $data['fname_err']!== ''?'<small class="text-red">*' . $data['fname_err'] . '</small>':''; ?>
			<label for="last_name" hidden="true">Last Name:</label>
			<input type="text" id="last_name" name="last_name" placeholder="Last Name" autocomplete="on">
			<?php echo isset($data['lname_err']) && $data['lname_err']!== ''?'<small class="text-red">*' . $data['lname_err'] . '</small>':''; ?>
			<label for="email" hidden="true">Email:</label>
			<input type="email" id="email" name="email" placeholder="Email" autocomplete="on">
			<?php echo isset($data['email_err']) && $data['email_err']!== ''?'<small class="text-red">*' . $data['email_err'] . '</small>':''; ?>
			<input type="checkbox" name="subscriber" value="1"><span> Sign Up For Newsletter</span>
			<hr>
			<h4>SIGN-IN INFORMATION</h4>
			<label for="password" hidden="true">Password:</label>
			<input type="password" name="password" id="password" placeholder="Password" autocomplete="on">
			<?php echo isset($data['password_err']) && $data['password_err']!== ''?'<small class="text-red">*' . $data['password_err'] . '</small>':''; ?>
			<label for="confirm_password" hidden="true">Password:</label>
			<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" autocomplete="on">
			<?php echo isset($data['confirm_password_err']) && $data['confirm_password_err']!== ''?'<small class="text-red">*' . $data['confirm_password_err'] . '</small>':''; ?>
			<hr>
			<h4>ADDRESS INFORMATION</h4>
			<label for="shipping_address" hidden="true">Shipping Address:</label>
			<input type="text" name="shipping_address" id="shipping_address" placeholder="Shipping Address" autocomplete="on">
			<?php echo isset($data['shipping_address_err']) && $data['shipping_address_err']!== ''?'<small class="text-red">*' . $data['shipping_address_err'] . '</small>':''; ?>
			<button type="submit" class="uppercase btn btn-dark btn-block w-100">Create an account</button>
		</form>
		<h1 class="uppercase">Already Have An Account?</h1>
		<p>If you have an account, sign in with your email address.</p>
		<a href="<?php getLink('users/signin'); ?>" class="uppercase"><button class="btn w-75 my-3 btn-dark">Sign In</button></a>
	</div>
</section>
<?php require APPROOT . '/views/inc/footer.php';?>
