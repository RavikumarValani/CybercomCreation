<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading() ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl(); ?>" id="category-form">
        <div class="tabContent">
            <?php echo $this->getTabContent(); ?>
        </div>

    </form>
</div>