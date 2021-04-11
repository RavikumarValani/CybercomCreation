<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getTitle() ?></h1>
    </div>
    <form class="row g-3" id="admin" style="padding-top: 0px;" method="POST"
        action="<?php echo $this->getUrl()->getUrl('save'); ?>">
        <div class="col-md-4">
            <label for="FirstName" class="form-label"><strong>Admin Name*</strong></label>
            <input type="text" class="form-control" id="UserName" name="admin[username]"">
        </div>
        <div class="col-6">
            <label for="Password" class="form-label"><strong> Password*</strong></label>
            <input type="password" class="form-control" id="Password" name="admin[password]" >
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Status *</strong> </label>
                <select name="admin[status]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($this->getAdmin()->getStatusOption() as $key => $value) { ?>
                    <option value="<?php echo $key ?>" <?php if ($this->getAdmin()->status == $key) { ?> selected <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12">
        <button type="button" class="btn btn-primary" onclick="mage.setForm('#admin').load()">Save</button>

        </div>

    </form>
</div>