<?php $customer = $this->getTableRow(); ?>
<?php $customerGroup = $this->getCustomerGroup(); ?>

<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading(); ?></h1>
    </div>
    <form class="row g-3" style="padding-top: 0px;" method="POST" action="<?php echo $this->getFormUrl(); ?>">

        <div class="col-md-6" style="padding-top: 6px;">
            <div class="form-group">
                <label><strong>Customer Group *</strong> </label>
                <select name="customer[groupId]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="0">Select..</option>
                    <?php if($customerGroup): ?>
                    <?php foreach ($customerGroup->getData() as $key => $value): ?>
                    <option value="<?php echo $value->groupId ?>" <?php if ($value->groupId == $customer->groupId) { ?> selected
                        <?php } ?>>
                        <?php echo $value->name ?> </option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="FirstName" class="form-label"><strong>FirstName*</strong></label>
                <input type="text" class="form-control" id="FirstName" name="customer[firstname]"
                    value="<?php echo $customer->firstname; ?>">
            </div>
            <div class="col-md-4" style="margin-top: 20px;">
                <label for="LastName" class="form-label"><strong>LastName*</strong></label>
                <input type="text" class="form-control" id="LastName" name="customer[lastname]"
                    value="<?php echo $customer->lastname; ?>">
            </div>
        </div>
        <div class="col-6">
            <label for="Email" class="form-label"><strong>Email*</strong></label>
            <input type="email" class="form-control" id="Email" name="customer[email]"
                value="<?php echo $customer->email; ?>">
        </div>
        <div class="col-6">
            <label for="Password" class="form-label"><strong> Password*</strong></label>
            <input type="password" class="form-control" id="Password" name="customer[password]"
                value="<?php echo $customer->password; ?>">
        </div>
        <div class="col-md-6">
            <label for="Mobile" class="form-label"><strong>Mobile*</strong></label>
            <input type="number" class="form-control" id="Mobile" name="customer[mobile]"
                value="<?php echo $customer->mobile; ?>">
        </div>
        <div class="col-md-6" style="padding-top: 6px;">
            <div class="form-group">
                <label><strong>Status *</strong> </label>
                <select name="customer[status]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($customer->getStatusOption() as $key => $value) { ?>
                    <option value="<?php echo $key ?>" <?php if ($customer->status == $key) { ?> selected <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12" style="text-align: center;padding-top:40px;">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </form>
</div>