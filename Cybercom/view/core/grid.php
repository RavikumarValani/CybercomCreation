<?php $collection = $this->getCollection();  ?>
<?php $actions = $this->getActions();  ?>
<?php $buttons = $this->getButtons(); ?>
<?php $columns = $this->getColumns();  ?>
<?php $filter = $this->getFilter();  ?>
<?php $color = ['danger', 'primary'];  ?>

<div class="row justify-content-start">
        <h1  style="margin-bottom: 40px;"><?php echo $this->getTitle() ?></h1>
</div>

<form method="POST" action="<?php echo $this->getFilterUrl() ?>" id="grid" enctype="multipart/form-data">
<table class="table table-success table-striped ">
   <?php if($buttons): ?>
        <?php foreach ($buttons as $key => $button) : ?>
            <?php if($button['ajax'] ): ?>
                <a class="btn btn-success" style="margin-right: 10px;" onclick="<?=$this->getButtonUrl($button['method']) ?>"><?=$button['label'] ?></a>
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