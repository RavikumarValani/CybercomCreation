<?php $color = ['danger', 'primary'];  ?>

<?php $collection = $this->getCollection();  ?>
<?php $actions = $this->getActions();  ?>
<?php $buttons = $this->getButtons();  ?>
<?php $columns = $this->getColumns();  ?>
<?php $filter = $this->getFilter();  ?>
<?php $color = ['danger', 'primary'];  ?>

<div class="row justify-content-start">
        <h1  style="margin-bottom: 40px;"><?php echo $this->getTitle() ?></h1>
</div>

<form method="POST" action="<?php echo $this->getFilterUrl() ?>" id="grid" enctype="multipart/form-data">
<table class="table table-success table-striped ">
<button type="submit" class="btn btn-success">filter</button>
   <?php if($buttons): ?>
        <?php foreach ($buttons as $key => $button) : ?>
            <?php if($button['ajax'] ): ?>

            <?php else: ?> 
                <a class="btn btn-success" style="margin-right: 10px;"
                    href="<?=$this->getButtonUrl($button['method']) ?>"><?=$button['label'] ?></a>
            <?php endif ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <?php if($columns): ?>
            <?php foreach ($columns as $key => $column) : ?>
                <th><?php echo $column['label']; ?></th>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if($actions): ?>
            <th>Action</th>
        <?php endif ?>
    </tr>

    <?php if(!$collection): ?>
        <tr>
            <td style="text-align: center;" colspan="7">Record Not Found</td>
        </tr>
    <?php else: ?>
        <?php if($columns): ?>
            <?php foreach ($columns as $key => $column) : ?>
                <td> <input type="text" name="filter[<?php echo $column['type'] ?>][<?php echo $column['field'] ?>]" value="<?php echo $filter->getValue($column['field'], $column['type']) ?>" /> </td>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php foreach ($collection->getData() as $row):  ?>
            <tr>
                <?php if($columns): ?>
                    <?php foreach ($columns as $key => $column) : ?>
                        <td> <?php echo $this->getFieldValue($row, $column['field']); ?></td>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if($actions) : ?>
                    <td>
                        <?php foreach ($actions as $key => $action) : ?>
                            <?php if($action['ajax'] ): ?>

                            <?php else: ?>
                                <a class="btn btn-<?=$action['class'] ?>"
                                    href="<?=$this->getMethodUrl($row, $action['method']) ?>"><?=$action['label'] ?></a>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>
</form>






<!-- <?php $customers = $this->getCustomers();?>
<div id="tabContent"></div>
<table class="table table-success table-striped  top-50 start-50 ">
<a class="btn btn-success mb-4 p-2" href="<?php echo $this->getUrl()->getUrl('form') ?>" >Add Customer</a>

    <tr>
        <th scope="col">#</th>
        <th scope="col">Customer Group</th>
        <th scope="col">FirstName</th>
        <th scope="col">LastName</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Mobile</th>
        <th scope="col">Address</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    <?php if(!$customers): ?>
        <tr>
            <td colspan="9" style="text-align: center;">Record Not Found</td>
        </tr>
    <?php else: ?>
    <?php foreach ($customers->getData() as $key => $value): ?>
    <tr>
        <td><?php echo $value->customerId; ?></td>
        <td><?php echo $value->groupName; ?></td>
        <td><?php echo $value->firstname; ?></td>
        <td><?php echo $value->lastname; ?></td>
        <td><?php echo $value->email; ?></td>
        <td><?php echo $value->password; ?></td>
        <td><?php echo $value->mobile; ?></td>
        <td><?php echo $value->address; ?></td>
        <td><a class="btn btn-<?php echo $color[$value->status] ?>" href="<?php echo $this->getUrl()->getUrl('status', null,['customerId' => $value->customerId]); ?>"> <?php echo $value->getStatusOption()[$value->status] ?> </a></td>

        <td>
            <button><a href="<?php echo $this->getUrl()->getUrl('form',null,['customerId'=>$value->customerId]); ?>">Edit</a></button>
            <button><a href="<?php echo $this->getUrl()->getUrl('delete',null,['customerId'=>$value->customerId]); ?>">Delete</a></button>
        </td>
    </tr>

    <?php endforeach; ?>
    <?php endif; ?>
</table> -->