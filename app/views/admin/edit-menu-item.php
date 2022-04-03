<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">Update Menu Item</h1>
            <hr>
            <form action="<?php getLink('admin/editMenuItem/' . $data['menu_item']->menu_item_id); ?>" method="post"
                enctype="multipart/form-data">
                <?php flash('validation_message'); ?>
                <h4 class="text-center pb-3">Update Menu Item</h4>
                <div class="form-group">
                    <label for="name">Menu Item Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="<?php echo $data['menu_item']->menu_item_name; ?>">
                </div>
                <div class="form-group">
                    <label for="order">Menu Item Order:</label>
                    <input type="number" name="order" id="number" class="form-control"
                        value="<?php echo $data['menu_item']->menu_item_order; ?>">
                </div>
                <div class="form-group">
                    <label for="image">Menu Image:</label>
                    <img src="<?php getLink('img/' . $data['menu_item']->image_uri); ?>" style="width:100px;"
                        class="my-2 img-thumbnail d-block" alt="">
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <input type="hidden" name="old-image" value="<?php echo $data['menu_item']->image_uri; ?>">
                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Update
                    Menu Item</button>
            </form>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>