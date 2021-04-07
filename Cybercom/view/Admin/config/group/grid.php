<?php $config = $this->getConfig(); ?>
<?php $groups = $config->getGroups(); ?>
<form method="POST" action="<?php echo $this->getUrl()->getUrl('update'); ?>">

    <input class="btn btn-primary" type="submit" value="Update">
    <input class="btn btn-success" type="button" value="Add Group" onclick="addRow(this)">

    <table class="table table-success table-striped " id="existingOption" width="100%">

        <?php if(!$groups): ?>
        <tr>
            <td colspan="3">Record Not Found</td>
        </tr>
        <?php else: ?>
        <?php foreach ($groups->getData() as $key => $group): ?>
        <tr>
            <td><input type="text" name="exist[<?php echo $group->groupId ?>][name]"
                    value="<?php echo $group->name ?>"></td>
            <td><input type="button" value="Remove group" class="removeRow"></td>
        </tr>

        <?php endforeach; ?>
        <?php endif ?>
    </table>
</form>
<div style="display: none;">

    <table id="newOptionRow" class="table table-success table-striped " width="100%">
        <tr>
            <td><input type="text" name="new[name][]"></td>
            <td><input type="button" value="Remove Option" class="removeRow"></td>
        </tr>
    </table>
</div>

<script type="text/javascript">
$("#existingOption").on('click', '.removeRow', function() {
    $(this).closest('tr').remove();
});

function addRow(e) {
    var row = $("#newOptionRow tr").clone();
    $("#existingOption").append(row);
}
</script>