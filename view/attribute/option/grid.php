<?php $attribute = $this->getAttribute(); ?>
<?php $options = $attribute->getOptions()->getData(); ?>
<form method="POST" action="<?php echo $this->getUrl()->getUrl('update'); ?>">
<input class="btn btn-primary" type="submit" value="Update">
<input class="btn btn-success" type="button" value="Add Option" onclick="addRow(this)">
<table class="table table-success table-striped " id="existingOption" width="100%">
    <?php foreach ($options as $key => $option): ?>
        <tr>
            <td><input type="text" name="exist[<?php echo $option->optionId ?>][name]" value="<?php echo $option->name ?>" ></td>
            <td><input type="text" name="exist[<?php echo $option->optionId ?>][sortOrder]" value="<?php echo $option->sortOrder ?>"></td>
            <td><input type="button" value="Remove Option" class="removeRow" ></td>
        </tr>

    <?php endforeach; ?>
    
</table>
</form>
<div style="display: none;">

<table id="newOptionRow" class="table table-success table-striped " width="100%">
        <tr>
            <td><input type="text" name="new[name][]"  ></td>
            <td><input type="text" name="new[sortOrder][]"></td>
            <td><input type="button" value="Remove Option" class="removeRow"></td>
        </tr>
</table>
</div>

<script type="text/javascript">


    $("#existingOption").on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });

    function addRow(e) {
        var row = $("#newOptionRow tr").clone();
        $("#existingOption").append(row);
    }

</script>