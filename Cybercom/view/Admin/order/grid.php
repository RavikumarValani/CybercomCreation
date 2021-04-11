<?php $order = $this->getOrder() ?>
<table border="1" class="table table-success table-striped ">
    <tr>
        <th>Order Id</th>
        <th>Customer Id</th>
        <th>Total Price</th>
    </tr>
        <?php foreach ($order->getData() as $key => $value) : ?>
    <tr>
            <td><?php echo $value->orderId ?></td>
            <td><?php echo $value->customerId ?></td>
            <td><?php echo $value->total ?></td>
    </tr>
        <?php endforeach; ?>
</table>
