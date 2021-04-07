<!-- <table class="table table-success table-striped  top-100 start-50 ">
<a class="btn btn-success mb-4 p-2" href="<?php echo $this->getUrl()->getUrl('form') ?>" >Add Admin</a>
    <tr>
        <th scope="col">#</th>
        <th scope="col">User Name</th>
        <th scope="col">Password</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    <?php
        $admins = $this->getAdmins();
        $color = ['danger', 'primary']; 
        foreach ($admins->getData() as $key => $value) {
    ?>
    <tr>
        <td><?php echo $value->id; ?></td>
        <td><?php echo $value->username; ?></td>
        <td><?php echo $value->password; ?></td>
        <td><a class="btn btn-<?php echo $color[$value->status] ?>" href="<?php echo $this->getUrl()->getUrl('status', null,['id' => $value->id]); ?>"> <?php echo $value->getStatusOption()[$value->status] ?> </a></td>

        <td>
            <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->id],true); ?>">Delete</a>
        </td>
    </tr>

    <?php
    }
    ?>
</table> -->