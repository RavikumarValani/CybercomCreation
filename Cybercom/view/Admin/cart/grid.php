<?php $color = ['danger', 'primary'];  ?>
<?php $cartItems = $this->getCart()->getItems(); ?>
<?php $cartCustomer = $this->getCart()->getCustomer(); ?>
<?php $customers = $this->getCustomers();  ?>



<a class="btn btn-primary" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'product'); ?>').load()">Back to Item</a>
<form id="cart" method="POST" action="<?php echo $this->getUrl()->getUrl('update'); ?>">
    <button type="button" onclick="mage.setForm('#cart').load()">Update Cart</button>
    <table class="table table-success table-striped  top-100 start-50 ">

        <tr>
            <th scope="col">Item Id</th>
            <th scope="col">Product Id</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Row Total</th>
            <th scope="col">Discount</th>
            <th scope="col">Final Total</th>
            <th scope="col">Action</th>
        </tr>
        <?php if(!$cartItems): ?>
            <tr>
                <td>Record Not Found</td>
            </tr>
        <?php else: ?>
        <?php    foreach ($cartItems->getData() as $key => $item) :  ?>
        <tr>
            <td><?php echo $item->itemId; ?></td>
            <td><?php echo $item->productId; ?></td>
            <td><input type="number" name="quantity[<?php echo $item->itemId ?>]" value="<?php echo $item->quantity ?>">
            </td>
            <td><?php echo $item->price; ?></td>
            <td><?php echo $item->price * $item->quantity; ?></td>
            <td><?php echo $item->discount * $item->quantity; ?></td>
            <td><?php echo ($item->price * $item->quantity - $item->discount * $item->quantity); ?></td>

            <td>
                <a class="btn btn-danger" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$item->itemId]); ?>').load()">Delete</a></button>
            </td>
        </tr>

        <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <table border="1">
    <?php if(!$cartItems): ?>
            <tr>
                <td>Please select the item.</td>
            </tr>
    <?php else: ?>
    <tr><a class="btn btn-success" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('index','cart\checkout'); ?>').load()">Checkout</a><tr>
    <?php endif; ?>
    </table>
</form>