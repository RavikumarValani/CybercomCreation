<?php $pageData = $this->getPageData(); ?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;">Add data</h1>
    </div>
    <form id="cms" class="row g-3" style="padding-top: 0px;" method="POST"
        action="<?php echo $this->getUrl()->getUrl('save'); ?>">
        <div class="col-md-4">
            <label for="Title" class="form-label"><strong>Title*</strong></label>
            <input type="text" class="form-control" id="title" name="pageData[title]"
                value="<?php echo $pageData->title; ?>">
        </div>
        <div class="col-6">
            <label for="Content" class="form-label"><strong> Content*</strong></label>
            <input type="text" class="form-control" id="content" name="pageData[content]"
                value="<?php echo $pageData->content; ?>">
        </div>
        <div class="col-6">
            <label for="Identifier" class="form-label"><strong> Identifier*</strong></label>
            <input type="text" class="form-control" id="identifier" name="pageData[identifier]"
                value="<?php echo $pageData->identifier; ?>">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label><strong>Status *</strong> </label>
                <select name="admin[status]" required="" class="form-control selectpicker" tabindex="-98">
                    <option value="">Select..</option>
                    <?php foreach ($pageData->getStatusOption() as $key => $value) { ?>
                    <option value="<?php echo $key ?>" <?php if ($pageData->status == $key) { ?> selected <?php } ?>>
                        <?php echo $value ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="mage.setForm('#cms').load()">Save</button>
        </div>

    </form>
</div>