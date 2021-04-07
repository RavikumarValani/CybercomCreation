<?php $categories = $this->getCategories(); ?>
<?php $this->setCategoriesOptions() ?>
<?php $color = ['danger', 'primary'];  ?>

<table class="table table-success table-striped  top-100 start-50 ">
    <a class="btn btn-success mb-4 p-2" href="<?php echo $this->getUrl()->getUrl('form') ?>" >Add Category</a>
    <tr>
        <th scope="col">Category Id</th>
        <th scope="col">Category Name</th>
        <th scope="col">Parent Id</th>
        <th scope="col">Path Id</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    <?php if(!$categories): ?>
        <tr>
            <td colspan="7" style="text-align: center;">Record Not Found</td>
        </tr>
    <?php else: ?>
    <?php foreach ($categories->getData() as $key => $value): ?>
    <tr>
        <td><?php echo $value->categoryId; ?></td>
        <td><?php echo $this->getName($value); ?></td>
        <td><?php echo $value->parentId; ?></td>
        <td><?php echo $value->pathId; ?></td>
        <td><a class="btn btn-<?php echo $color[$value->status] ?>" href="<?php echo $this->getUrl()->getUrl('status', null,['categoryId' => $value->categoryId]); ?>"> <?php echo $value->getStatusOption()[$value->status] ?> </a></td>
        <td>
            <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl('form',null,['categoryId'=>$value->categoryId]); ?>">Edit</a>
            <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl('delete',null,['categoryId'=>$value->categoryId]); ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>