<?php require APPROOT . '/views/inc/dashboard-header.php'; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5">
    <div class="row pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <h1 class="text-center display-4 m-5">Pages</h1>
            <hr>
            <?php flash('message'); ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Page Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['pages'] as $page) { ?>
                        <tr>
                            <td><?php echo $page->page_title; ?></td>
                            <td>
                                <a href="<?php getLink('pages/page/' . $page->page_title); ?>"
                                    class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                <a href="<?php getLink('admin/editPage/' . $page->page_id); ?>"
                                    class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/dashboard-footer.php'; ?>