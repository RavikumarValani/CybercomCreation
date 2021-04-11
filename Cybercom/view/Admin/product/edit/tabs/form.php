<?php $product = $this->getTableRow(); ?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading() ?></h1>
    </div>
    <form method="POST" id="product" action="<?php echo $this->getFormUrl(); ?>" enctype="multipart/form-data">

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-3">
                <div class="form-group">
                    <label><strong>Sku *</strong> </label>
                    <input type="text" name="product[sku]" required="" class="form-control"
                        value="<?php echo $product->sku ?>">
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="form-group">
                        <label><strong>Product Name *</strong> </label>
                        <input type="text" name="product[name]" required="" class="form-control"
                            value="<?php echo $product->name ?>">
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: 20px;">
                    <div class="form-group">
                        <label><strong>Product Image</strong> </label>
                        <input type="file" name="product[image]" value="<?php echo $product->image; ?>"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Product Price *</strong> </label>
                    <input type="number" name="product[price]" class="form-control" step="any" required=""
                        value="<?php echo $product->price; ?>">
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Product Quantity</strong> </label>
                    <input type="text" name="product[quantity]" class="form-control"
                        value="<?php echo $product->quantity; ?>">
                </div>
            </div>
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Discount *</strong> </label>
                    <input type="text" name="product[discount]" required="" class="form-control"
                        value="<?php echo $product->discount; ?>">
                </div>
            </div>
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Status *</strong> </label>
                    <select name="product[status]" required="" class="form-control selectpicker" tabindex="-98">
                        <option value="">Select..</option>
                        <?php foreach ($product->getStatusOption() as $key => $value) { ?>
                        <option value="<?php echo $key ?>" <?php if ($product->status == $key) { ?> selected <?php } ?>>
                            <?php echo $value ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Alert Quantity</strong> </label>
                    <input type="number" name="alert_qty" class="form-control" step="any">
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Product Details</strong></label>
                    <textarea name="product[description]" class="form-control"
                        rows="5"><?php echo $product->description ?></textarea>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 40px;text-align: center;">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="mage.setForm('#product').load()">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>