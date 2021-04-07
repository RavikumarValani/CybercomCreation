<!-- <?php $attributes = $this->getAttributes(); ?>

<table border="1" width="100%" class="table table-success table-striped ">
    <a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl('form') ?>">Add Record</a>
    <tr>
        <th>Attribute Id</th>
        <th>Entity Type Id</th>
        <th>Name</th>
        <th>Code</th>
        <th>Input Type</th>
        <th>Back End Type</th>
        <th>Sort Order</th>
        <th>Back End Model</th>
        <th colspan="3" style="text-align: center;">Action</th>
    </tr>
    <?php if(!$attributes): ?>
        <tr>
            <td colspan="9" style="text-align: center;">No Record Found</td>
        </tr>
    <?php else: ?>
    <?php foreach ($attributes->getData() as $key => $value): ?>
    
    <tr>
        <td><?php echo $value->attributeId ?></td>
        <td><?php echo $value->entityTypeId ?></td>
        <td><?php echo $value->name ?></td>
        <td><?php echo $value->code ?></td>
        <td><?php echo $value->inputType ?></td>
        <td><?php echo $value->backEndType ?></td>
        <td><?php echo $value->sortOrder ?></td>
        <td><?php echo $value->backEndModel ?></td>
        <td><a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl('form',null,['attributeId' => $value->attributeId]); ?>">Update</a></td>
        <td><a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('delete',null,['attributeId' => $value->attributeId]); ?>">Delete</a></td>
        <td><a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl('options',null,['attributeId' => $value->attributeId]); ?>">Option</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table> -->