<?php $category = $this->getTableRow(); ?>
<?php $options = $this->getCategoryOptions();  ?>

<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading() ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl(); ?>" id="category">
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Parent Id *</strong> </label>
                <select name="category[parentId]" class="form-control selectpicker" tabindex="-98">
                    <?php if($options): ?>
                    <?php foreach ($options as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($category->parentId == $key) { ?> selected <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Category Name *</strong> </label>
                    <input type="text" name="category[name]" required="" class="form-control"
                        value="<?php echo $category->name; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label><strong>Status *</strong> </label>
                    <select name="category[status]" class="form-control selectpicker" tabindex="-98">
                        <option value="">Select..</option>
                        <?php foreach ($category->getStatusOption() as $key => $value) { ?>
                        <option value="<?php echo $key ?>" <?php if ($category->status === $key) { ?> selected
                            <?php } ?>>
                            <?php echo $value ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Category Details</strong></label>
                    <textarea name="category[description]" class="form-control"
                        rows="5"><?php echo $category->description; ?></textarea>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 40px;text-align:center;">
                <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="mage.setForm('#category').load()">Save</button>

                </div>
            </div>
        </div>
    </form>
</div>