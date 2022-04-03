<?php require APPROOT . '/views/inc/header.php'; ?>
<section id="page">
    <div class="container">
        <h2 class="uppercase"><?php echo $data['page']->page_title; ?></h2>
        <div class="body">
            <?php echo htmlspecialchars_decode($data['page']->page_body); ?>
        </div>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>