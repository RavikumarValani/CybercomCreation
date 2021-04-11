<?php $attribute = $this->getAttribute(); ?>
<?php $options = $attribute->getOptions(); ?>
<form method="POST" id="option" action="<?php echo $this->getUrl()->getUrl('save', 'Attribute\Option'); ?>">

    <button class="btn btn-primary" type="button" onclick="mage.setForm('#option').load()" >Update</button>
    <input class="btn btn-success" type="button" value="Add Option" onclick="addRow(this)">

    <table class="table table-success table-striped " id="existingOption" width="100%">

        <?php if(!$options): ?>
        <tr>
            <td colspan="3">Record Not Found</td>
        </tr>
        <?php else: ?>
        <?php foreach ($options->getData() as $key => $option): ?>
        <tr>
            <td><input type="text" name="exist[<?php echo $option->optionId ?>][name]"
                    value="<?php echo $option->name ?>"></td>
            <td><input type="text" name="exist[<?php echo $option->optionId ?>][sortOrder]"
                    value="<?php echo $option->sortOrder ?>"></td>
            <td><button type="button" onclick="mage.setUrl('<?php echo $this->getUrl()->geturl('delete', 'Attribute\Option',['optionId' => $option->optionId]) ?>').load()" class="btn btn-danger">Delete</button></td>
        </tr>

        <?php endforeach; ?>
        <?php endif ?>
    </table>
</form>
<div style="display: none;">

    <table id="newOptionRow" class="table table-success table-striped " width="100%">
        <tr>
            <td><input type="text" name="new[name][]"></td>
            <td><input type="text" name="new[sortOrder][]"></td>
            <td><input type="button" id="remove" value="Remove Option" class="removeRow"></td>
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