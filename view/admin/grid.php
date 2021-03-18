<table class="table table-success table-striped  top-100 start-50 ">
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
        foreach ($admins->getData() as $key => $value) {
    ?>
    <tr>
        <td><?php echo $value->id; ?></td>
        <td><?php echo $value->username; ?></td>
        <td><?php echo $value->password; ?></td>
        <td><a style="display: block;text-align:center;color:white;text-decoration:none;width:90px;"
                href="<?php echo $this->getUrl()->getUrl('status',null,['id'=>$value->id,'status'=>$value->status],true); ?>"><?php if($value->status == 0 ) { echo "<p style='Background-color:red;'>" . "Disable" . "</p>" ;} ?><?php if($value->status == 1 ){ echo "<p style='Background-color:blue;'>" . "Enable" . "</p>" ;} ?></a>
        </td>

        <td>
            <button><a href="<?php echo $this->getUrl()->getUrl('form',null,['id'=>$value->id],true); ?>">Edit</a></button>
            <button><a
                    href="<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->id],true); ?>">Delete</a></button>
        </td>
    </tr>

    <?php
    }
    ?>
</table>