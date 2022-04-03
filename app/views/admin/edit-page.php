<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
	<div class="row pt-3 pb-2 mb-3 border-bottom">
		<div class="container">
			<form action="<?php getLink('admin/editPage/' . $data['page']->page_id); ?>" method="post" enctype="multipart/form-data">
				<h1 class="text-center display-4 my-5">Edit Page</h1>
				<hr>
				<?php flash('validation_message'); ?>
				<div class="form-group">
					<label for="body">Page Content:</label>
					<textarea required id="body" name="body" class="form-control form-control-lg"><?php echo $data['page']->page_body; ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Save</button>
			</form>
		</div>
	</div>
</main>
<script src="<?php echo getLink('js/ckeditor.js'); ?>"></script>
<script>
	if (document.getElementById('body')) {
		ClassicEditor
			.create(document.querySelector('#body'))
			.then(editor => {
				console.log('Editor Initialized');
			})
			.catch(error => {
				console.error(error);
			});

	}

</script>
<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>
