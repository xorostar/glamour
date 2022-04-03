<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <form action="<?php getLink('admin/store'); ?>" method="post" enctype="multipart/form-data">
                <h1 class="text-center display-4 m-5">Store Configuration Form</h1>
                <hr>
                <?php flash('validation_message'); ?>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo $data['store']->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="logo">Logo:</label>
                    <img src="<?php getLink('img/' . $data['store']->logo); ?>" style="width:100px;"
                        class="d-block my-2 img-thumbnail" alt="">
                    <input type="hidden" value="<?php echo $data['store']->logo; ?>" name="old-logo">
                    <input type="file" class="form-control-file" id="logo" name="logo">
                </div>
                <div class="form-group">
                    <label for="email">Store Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $data['store']->email_id; ?>" required>
                </div>

                <div class="form-group">
                    <label for="facebook-link">Facebook Link:</label>
                    <input type="url" class="form-control" id="facebook-link" name="facebook-link"
                        value="<?php echo $data['store']->facebook_link; ?>">
                </div>
                <div class="form-group">
                    <label for="instagram-link">Instagram Link:</label>
                    <input type="url" class="form-control" id="instagram-link" name="instagram-link"
                        value="<?php echo $data['store']->instagram_link; ?>">
                </div>
                <div class="form-group">
                    <label for="twitter-link">Twitter Link:</label>
                    <input type="url" class="form-control" id="twitter-link" name="twitter-link"
                        value="<?php echo $data['store']->twitter_link; ?>">
                </div>
                <div class="form-group">
                    <label for="youtube-link">Youtube Link:</label>
                    <input type="url" class="form-control" id="youtube-link" name="youtube-link"
                        value="<?php echo $data['store']->youtube_link; ?>">
                </div>
                <div class="form-group">
                    <label for="google-plus-link">Google+ Link:</label>
                    <input type="url" class="form-control" id="google-plus-link" name="google-plus-link"
                        value="<?php echo $data['store']->google_plus_link; ?>">
                </div>
                <div class="form-group">
                    <label for="vimeo-link">Vimeo Link:</label>
                    <input type="url" class="form-control" id="vimeo-link" name="vimeo-link"
                        value="<?php echo $data['store']->vimeo_link; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Save</button>
            </form>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>