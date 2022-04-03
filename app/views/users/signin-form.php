<?php require APPROOT . '/views/inc/header.php';?>
<section id="form">
	<div class="container">
		<h1 class="uppercase">Registered Customers</h1>
		<p>If you have an account, sign in with your email address.</p>
		<?php flash('registration_successful'); ?>
		<?php flash('logout_successful'); ?>
		<form action="<?php getLink('users/login'); ?>" method="post">
			<label for="email" hidden="true">Email:</label>
			<input type="email" id="email" name="email" placeholder="Enter Email Here" autocomplete="on">
			<label for="password" hidden="true">Password:</label>
			<input type="password" name="password" id="password" placeholder="Enter Password Here" autocomplete="on">
			<?php flash('login_failed'); ?>
			<button type="submit" class="uppercase btn btn-dark btn-block w-100">Login</button>
		</form>
		<h1 class="uppercase">New Customers</h1>
		<p>Creating an account has many benefits: check out faster, keep more than one address, track orders and more.</p>
		<a href="<?php getLink('users/signup'); ?>" class="uppercase"><button class="btn btn-dark mx-auto w-75 my-3 btn-block">Create An Account</button></a>
	</div>
</section>
<?php require APPROOT . '/views/inc/footer.php';?>
