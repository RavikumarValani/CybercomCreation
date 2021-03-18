<?php $admin = $this->getAdmin(); ?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getTitle() ?></h1>
    </div>
    <form class="row g-3" style="padding-top: 0px;" method="POST"
        action="<?php echo $this->getUrl()->getUrl('save'); ?>">
        <div class="col-md-4">
            <label for="FirstName" class="form-label"><strong>User Name*</strong></label>
            <input type="text" class="form-control" id="UserName" name="admin[username]"
                value="<?php echo $admin->username; ?>">
        </div>
        <div class="col-6">
            <label for="Password" class="form-label"><strong> Password*</strong></label>
            <input type="password" class="form-control" id="Password" name="admin[password]"
                value="<?php echo $admin->password; ?>">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Status *</strong> </label>
                <select name="admin[status]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($admin->getStatusOption() as $key => $value) { ?>
                    <option value="<?php echo $key ?>" <?php if ($admin->status == $key) { ?> selected <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>

    </form>
</div>