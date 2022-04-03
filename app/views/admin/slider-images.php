<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<?php print_r($data['slider_images']); ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 my-5">Slider Images</h1>
            <hr>
            <?php flash('validation_message'); ?>
            <div class="bd-example mb-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        $i = 0;
                        foreach ($data['slider_images'] as $image) {
                            ?>
                        <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $i; ?>"
                            class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
                        <?php
                            $i++;
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($data['slider_images'] as $image) {
                            ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <a href="<?php echo $image->link; ?>">
                                <img src="<?php getLink('img/' . $image->image_uri); ?>" class="d-block w-100"
                                    alt="...">
                            </a>
                        </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <?php
                    if (count($data['slider_images']) > 1) {
                        ?>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <?php
                }
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <?php if (count($data['slider_images']) < 3) { ?>
                            <div class="alert alert-info text-center">A Slider is only allowed to have 3 images maximum
                                so
                                choose
                                wisely.</div>
                            <form action="<?php getLink('admin/addSliderImage'); ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="link">Link To:</label>
                                    <select class="form-control" id="link" name="link" required>
                                        <?php foreach ($data['menu_items'] as $menu_item) { ?>
                                        <option value="<?php getLink('products/menu/' . $menu_item->menu_item_id); ?>">
                                            <?php echo $menu_item->menu_item_name; ?>
                                        </option>
                                        <?php } ?>
                                        <?php foreach ($data['submenu_items'] as $submenu_item) { ?>
                                        <option
                                            value="<?php getLink('products/submenu/' . $submenu_item->submenu_item_id); ?>">
                                            <?php echo $submenu_item->menu_item_name . ' / ' . $submenu_item->submenu_item_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="order">Order:</label>
                                    <select name="order" id="order" class="form-control" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Slider Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">Add Slider
                                    Image</button>
                            </form>
                            <?php } else { ?>
                            <div class="alert alert-danger text-center">Slider already has 3 items, to add a new one
                                please
                                delete an
                                existing one.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h4 class="text-center pb-3">Slider Items</h4>
                                <table class="table table-hover table-sm text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Slider Image</th>
                                            <th>Order</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['slider_images'] as $image) { ?>
                                        <tr>
                                            <td class="text-center"><img
                                                    src="<?php getLink('img/' . $image->image_uri); ?>" alt=""
                                                    style="height:50px !important;">
                                            </td>
                                            <td><?php echo $image->slide_order; ?></td>
                                            <td>
                                                <a href="<?php getLink('admin/deleteSliderItem/' . $image->id); ?>"
                                                    class="btn btn-danger m-1">
                                                    <i class="fas fa-trash"></i>
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
            </div>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>