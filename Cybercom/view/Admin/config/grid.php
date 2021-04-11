<?php $configs = $this->getConfig(); ?>
<form method="POST" id="config" action="<?php echo $this->getUrl()->getUrl('save'); ?>">

<button class="btn btn-primary" type="button" onclick="mage.setForm('#config').load()" >Update</button>
    <input class="btn btn-success" type="button" value="Add Option" onclick="addRow(this)">

    <table class="table table-success table-striped " id="existingOption" width="100%">
        <tr>
            <th>Title</th>
            <th>Code</th>
            <th>Value</th>
            <th>Action</th>
        </tr>
        <?php if(!$configs): ?>
        <tr>
            <td colspan="3">Record Not Found</td>
        </tr>
        <?php else: ?>
        <?php foreach ($configs->getData() as $key => $config): ?>
        <tr>
            <td><input type="text" name="exist[<?php echo $config->configId ?>][title]"
                    value="<?php echo $config->title ?>"></td>
            <td><input type="text" name="exist[<?php echo $config->configId ?>][code]"
                    value="<?php echo $config->code ?>"></td>
            <td><input type="text" name="exist[<?php echo $config->configId ?>][value]"
                    value="<?php echo $config->value ?>"></td>
            <td><a class="btn btn-danger"  onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete','config',['configId'=>$config->configId]); ?>').load()">Delete</a></td>
        </tr>

        <?php endforeach; ?>
        <?php endif ?>
    </table>
</form>
<div style="display: none;">

    <table id="newOptionRow" class="table table-success table-striped " width="100%">
        <tr>
            <td><input type="text" name="new[title][]"></td>
            <td><input type="text" name="new[code][]"></td>
            <td><input type="text" name="new[value][]"></td>
            <td><input type="button" id="remove"  value="Remove Option" class="removeRow"></td>
        </tr>
    </table>
</div>

<script type="text/javascript">

$("#existingOption").on('click', '#remove', function() {
    $(this).closest('tr').remove();
});

function addRow(e) {
    var row = $("#newOptionRow tr").clone();
    $("#existingOption").append(row);
}
</script>