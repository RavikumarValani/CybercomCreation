<?php $customerGroup = $this->getTableRow(); ?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;">Add Detail</h1>
    </div>
    <form class="row g-3" id="group" style="padding-top: 0px;" method="POST"
        action="<?php echo $this->getUrl()->getUrl('save'); ?>">
        <div class="row justify-content-start">
            <div class="row justify-content-start">
                <div class="col-md-4" style="margin-top: 20px;">
                    <label for="name" class="form-label"><strong>Name*</strong></label>
                    <input type="text" class="form-control" name="customerGroup[name]" value="<?php echo $customerGroup->name; ?>">
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-md-4" style="margin-top: 20px;">
                    <label for="type" class="form-label"><strong>Status*</strong></label>
                    <input type="text" class="form-control" name="customerGroup[status]" value="<?php echo $customerGroup->status; ?>">
                </div>
            </div>
            <div class="col-12" style="text-align: center;padding-top:40px;">
                <button type="button" class="btn btn-primary" onclick="mage.setForm('#group').load()">Save</button>
            </div>

    </form>
</div>