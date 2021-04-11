<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getTitle(); ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl(); ?>" id="payment">
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label><strong>Name *</strong> </label>
            <input type="text" name="payment[name]" required="" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><strong>Code *</strong> </label>
            <input type="number" name="payment[code]" class="form-control" step="any" required="">
        </div>
    </div>
    <div class="col-md-4" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Status *</strong> </label>
            <select name="payment[status]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($this->getPayment()->getStatusOption() as $key => $value) { ?>
                    <option value="<?php echo $key ?>" >
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 20px;">
        <div class="form-group">
            <label><strong>Description</strong></label>
            <textarea name="payment[description]" class="form-control" rows="5"></textarea>
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 40px;text-align:center;">
        <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="mage.setForm('#payment').load()">Save</button>

        </div>
    </div>
</div>
    </form>
</div>