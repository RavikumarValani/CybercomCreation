<?php $pageData = $this->getPageData();?>
<?php $color = ['danger', 'primary'];  ?>
<table class="table table-success table-striped  top-50 start-50 ">
<a class="btn btn-success mb-4 p-2" href="<?php echo $this->getUrl()->getUrl('form') ?>" >Add Page</a>

    <tr>
        <th scope="col">Page Id</th>
        <th scope="col">Title</th>
        <th scope="col">Identifier</th>
        <th scope="col">Content</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    <?php if(!$pageData): ?>
        <tr>
            <td colspan="6" style="text-align: center;">Record Not Found</td>
        </tr>
    <?php else: ?>
    <?php foreach ($pageData->getData() as $key => $value): ?>
    <tr>
        <td><?php echo $value->pageId; ?></td>
        <td><?php echo $value->title; ?></td>
        <td><?php echo $value->identifier; ?></td>
        <td><?php echo $value->content; ?></td>
        <td><a class="btn btn-<?php echo $color[$value->status] ?>" href="<?php echo $this->getUrl()->getUrl('status', null,['pageId' => $value->pageId]); ?>"> <?php echo $value->getStatusOption()[$value->status] ?> </a></td>

        <td>
            <button><a href="<?php echo $this->getUrl()->getUrl('form',null,['pageId'=>$value->pageId]); ?>">Edit</a></button>
            <button><a href="<?php echo $this->getUrl()->getUrl('delete',null,['pageId'=>$value->pageId]); ?>">Delete</a></button>
        </td>
    </tr>

    <?php endforeach; ?>
    <?php endif; ?>
</table>