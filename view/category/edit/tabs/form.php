<?php $category = $this->getCategory(); ?>
<?php $options = $this->getParentOptions(); ?>

<div class="col-md-4">
    <div class="form-group">
        <label><strong>Parent Id *</strong> </label>
        <select name="category[parentId]" class="form-control selectpicker" tabindex="-98">
            <option value="0">Select..</option>
            <?php if($options): ?>
            <?php foreach ($options->getData() as $option): ?>
            <option value="<?php echo $option->categoryId ?>">
                <?php echo $option->name ?> </option>
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
            <select name="category[status]" required="" class="form-control selectpicker" tabindex="-98">
                <option value="">Select..</option>
                <?php foreach ($category->getStatusOption() as $key => $value) { ?>
                <option value="<?php echo $key ?>" <?php if ($category->status == $key) { ?> selected <?php } ?>>
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
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
</div>