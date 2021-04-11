<?php $attributes = $this->getAttributes(); ?>
<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    <div class="container">
        <h1 style="margin-bottom: 40px;">Attribute</h1>
    </div>
    <form method="POST" id="pattribute" action="<?php echo $this->getUrl()->getUrl('save', 'Product\Attribute') ?>" enctype="multipart/form-data">
    <table border="1" class="table table-success table-striped ">
        <?php if(!$attributes): ?>
            <tr>
                <td colspan="2">Record not found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($attributes->getData() as $key => $attribute): ?>
                <tr>
                    <td><?php echo $attribute->name ?><td>
                    <td>
                <?php if($attribute->getOptions()): ?>
                        <?php if($attribute->inputType == 'select'): ?>
                                <select name="attribute[attributeOptionId]">
                                <?php foreach ($attribute->getOptions()->getData() as $key => $option): ?>
                                    <option value="<?php echo $option->optionId ?>"><?php echo $option->name ?></option>
                                <?php endforeach; ?>
                                </select>
                        <?php endif; ?>
                <?php endif; ?></td>

                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <button type="button" class="btn btn-success" onclick="mage.setForm('#pattribute').load()">Save</button>  
    </form>
</div>