<?php $attribute = $this->getTableRow();?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading(); ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl(); ?>" id="attribute-form">
        <div class="col-md-4" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Entity Type *</strong> </label>
                <select name="attribute[entityTypeId]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($attribute->getEntityTypeIdOptions() as $key => $value) { ?>
                    <option value="<?php echo $value ?>" <?php if ($attribute->entityTypeId == $key) { ?> selected
                        <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Name *</strong> </label>
                    <input type="text" name="attribute[name]" required="" class="form-control"
                        value="<?php echo $attribute->name ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Code *</strong> </label>
                <input type="text" name="attribute[code]" class="form-control" step="any" required=""
                    value="<?php echo $attribute->code; ?>">
            </div>
        </div>
        <div class="col-md-4" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Input Type *</strong> </label>
                <select name="attribute[inputType]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($attribute->getInputTypeOptions() as $key => $value) { ?>
                    <option value="<?php echo $value ?>" <?php if ($attribute->inputType == $key) { ?> selected
                        <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="row justify-content-start">
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Sort Order *</strong> </label>
                    <input type="text" name="attribute[sortOrder]" required="" class="form-control"
                        value="<?php echo $attribute->sortOrder ?>">
                </div>
            </div>
        </div>

        <div class="col-md-4" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Back End Type *</strong> </label>
                <select name="attribute[backEndType]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($attribute->getBackEndTypeOptions() as $key => $value) { ?>
                    <option value="<?php echo $value ?>" <?php if ($attribute->backEndType == $key) { ?> selected
                        <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-md-12" style="margin-top: 40px;text-align: center;">
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>