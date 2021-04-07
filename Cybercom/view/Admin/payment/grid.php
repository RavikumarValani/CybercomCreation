<!-- <?php $color = ['danger', 'primary'];  ?>
<table class="table table-success table-striped  top-50 start-50 ">
<a class="btn btn-success mb-4 p-2" href="<?php echo $this->getUrl()->getUrl('form') ?>" >Add Payment Method</a>

    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Code</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    <?php $payment = $this->getPayment(); ?>
    <?php    foreach ($payment as $key => $value) {  ?>

    <tr>
        <td><?php echo $value->id; ?></td>
        <td><?php echo $value->name; ?></td>
        <td><?php echo $value->code; ?></td>
        <td><?php echo $value->description; ?></td>
        <td><a class="btn btn-<?php echo $color[$value->status] ?>" href="<?php echo $this->getUrl()->getUrl('status', null,['id' => $value->id]); ?>"> <?php echo $value->getStatusOption()[$value->status] ?> </a></td>
        
        <td>
            <button><a href="<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->id]); ?>">Delete</a></button>
        </td>
    </tr>

    <?php } ?>
</table> -->