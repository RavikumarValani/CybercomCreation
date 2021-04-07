<?php $config = $this->getTableRow();?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;"><?php echo $this->getHeading(); ?></h1>
    </div>
    <form method="POST" action="<?php echo $this->getFormUrl(); ?>" id="attribute-form">
        
        <div class="row justify-content-start">
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Group Id *</strong> </label>
                    <input type="text" name="config[groupId]" required="" class="form-control"
                        value="<?php echo $config->groupId ?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-6" style="margin-top: 20px;">
                <div class="form-group">
                    <label><strong>Title *</strong> </label>
                    <input type="text" name="config[title]" required="" class="form-control"
                        value="<?php echo $config->title ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Code *</strong> </label>
                <input type="text" name="config[code]" class="form-control" step="any" required=""
                    value="<?php echo $config->code; ?>">
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 20px;">
            <div class="form-group">
                <label><strong>Value *</strong> </label>
                <input type="text" name="config[value]" class="form-control" step="any" required=""
                    value="<?php echo $config->value; ?>">
            </div>
        </div>
        

        <div class="col-md-12" style="margin-top: 40px;text-align: center;">
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>