<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
    <form class="row g-3" style="padding-top: 0px;" id="address" method="POST" action="<?php echo $this->getUrl()->getUrl('save','Customer\Address'); ?>">
<div class="row">
<div class="col-6 p-5 border border-dark ">
    <div class="container">
        <h1 style="margin-bottom: 40px;">Billing Address</h1>
    </div>
        <div style="display: none;">
            <input type="text" value="billing" name="billingAddress[type]">
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Address *</strong></label>
                <textarea name="billingAddress[address]" class="form-control"
                    rows="2"><?php echo $billingAddress->address ?></textarea>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="city" class="form-label"><strong>City*</strong></label>
                <input type="text" class="form-control" name="billingAddress[city]" value="<?php echo $billingAddress->city; ?>">
            </div>
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="city" class="form-label"><strong>Country*</strong></label>
                <input type="text" class="form-control" name="billingAddress[country]" value="<?php echo $billingAddress->country; ?>">
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-4" style="margin-top: 20px;">
                <label for="state" class="form-label"><strong>State*</strong></label>
                <input type="text" class="form-control" name="billingAddress[state]" value="<?php echo $billingAddress->state; ?>">
            </div>
            <div class="col-4" style="margin-top: 20px;">
                <label for="zip" class="form-label"><strong> Zip Code*</strong></label>
                <input type="number" class="form-control" name="billingAddress[zip]" value="<?php echo $billingAddress->zip; ?>">
            </div>
        </div>
    
</div>
<div class="col-6 p-5 border border-dark ">
    <div class="container">
        <h1 style="margin-bottom: 40px;">Shipping Address</h1>
    </div>
        <div style="display: none;">
            <input type="text" value="shipping" name="shippingAddress[type]">
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Address *</strong></label>
                <textarea name="shippingAddress[address]" class="form-control"
                    rows="2"><?php echo $shippingAddress->address ?></textarea>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="city" class="form-label"><strong>City*</strong></label>
                <input type="text" class="form-control" name="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>">
            </div>
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="city" class="form-label"><strong>Country*</strong></label>
                <input type="text" class="form-control" name="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>">
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-4" style="margin-top: 20px;">
                <label for="state" class="form-label"><strong>State*</strong></label>
                <input type="text" class="form-control" name="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>">
            </div>
            <div class="col-4" style="margin-top: 20px;">
                <label for="zip" class="form-label"><strong> Zip Code*</strong></label>
                <input type="number" class="form-control" name="shippingAddress[zip]" value="<?php echo $shippingAddress->zip; ?>">
            </div>
        </div>
    
</div>
</div>
        <div class="col-12" style="text-align: center;padding-top:40px;">
            <button type="button" class="btn btn-primary" onclick="mage.setForm('#address').load()">Save</button>
        </div>
</form>