<?php $configGroup = $this->getTableRow();?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading(); ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl() ?>" id="configGroup">
        
        <div class="row justify-content-start">
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Name *</strong> </label>
                    <input type="text" name="configGroup[name]" required="" class="form-control"
                        value="<?php echo $configGroup->name ?>">
                </div>
            </div>
        </div>
        
\

        <div class="col-md-12" style="margin-top: 40px;text-align: center;">
            <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="mage.setForm('#configGroup').load()">Save</button>

            </div>
        </div>
    </form>
</div>