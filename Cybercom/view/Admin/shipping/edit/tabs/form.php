<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getTitle(); ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl(); ?>" id="shipping-form">

<div class="row">
    <div class="col-md-6" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Name *</strong> </label>
            <input type="text" name="shipping[name]" required="" class="form-control">
        </div>
    </div>
    <div class="col-md-6" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Code *</strong> </label>
            <input type="number" name="shipping[code]" class="form-control" step="any" required="">
        </div>
    </div>
    <div class="col-md-6" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Amount *</strong> </label>
            <input type="number" name="shipping[amount]" class="form-control" step="any" required="">
        </div>
    </div>
    <div class="col-md-4" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Status *</strong> </label>
            <select name="shipping[status]" required="" class="form-control selectpicker" tabindex="-98">
                <option value="">Select..</option>
                <?php foreach ($this->getShipping()->getStatusOption() as $key => $value) { ?>
                <option value="<?php echo $key ?>" >
                    <?php echo $value ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Description</strong></label>
            <textarea name="shipping[description]" class="form-control" rows="5"></textarea>
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 40px;text-align:center;">
        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
</div>
    </form>
</div>