<?php $product = $this->getProduct(); ?>
<?php $customerGroup = $this->getCustomergroup(); ?>

<table border="1px" width="100%" class="table table-success table-striped ">
    <form method="POST" action="<?php echo $this->getUrl()->getUrl('save'); ?>">
        <button type="submit" class="row justify-content-start" >Update</button>
            <tr>
                <th>group Id</th>
                <th>Group Name</th>
                <th>Price</th>
                <th>Group Price</th>
            </tr>
            <?php if(!$customerGroup): ?>
                <tr>
                    <td>Record not found.</td>
                </tr>
            <?php else: ?>
            <?php foreach ($customerGroup->getData() as $key => $value): ?> 
            <tr>
            <?php $rowStatus = ($value->entityId) ? 'exist': 'new'; ?> 
                <td><?php echo $value->groupId ?></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->price ?></td>
                <td><input type="text" name="groupPrice[<?php echo $rowStatus; ?>][<?php echo $value->groupId ?>]" value="<?php echo $value->groupPrice ?>"></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
    </form>
</table>