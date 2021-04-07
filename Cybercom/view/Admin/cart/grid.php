<?php $color = ['danger', 'primary'];  ?>
<?php $cartItems = $this->getCart()->getItems(); ?>
<?php $cartCustomer = $this->getCart()->getCustomer(); ?>
<?php $customers = $this->getCustomers();  ?>


<form method="POST" action="<?php echo $this->getUrl()->getUrl('selectCustomer', 'cart'); ?>">
<select name="customer[customerId]" required="" class="form-control selectpicker" tabindex="-98">
    <option value="">Select..</option>
    <?php foreach ($customers->getData() as $key => $customer) : ?>
    <option value="<?php echo $customer->customerId ?>" <?php if($cartCustomer) { ?> <?php if($cartCustomer->customerId == $customer->customerId) { ?> selected <?php } ?> <?php } ?> >
        <?php echo $customer->firstname ?> </option>
        
    <?php echo $customer->customerId; ?>
    <?php endforeach; ?>
</select>
<button type="submit">Go</button>
</form>
<a href="<?php echo $this->getUrl()->getUrl('grid', 'product'); ?>">Back to Item</a>
<form method="POST" action="<?php echo $this->getUrl()->getUrl('update'); ?>">
    <button type="submit">Update Cart</button>
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
                <button><a
                        href="<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$item->itemId]); ?>">Delete</a></button>
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
    <tr><a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl('index','cart\checkout'); ?>">Checkout</a><tr>
    <?php endif; ?>
    </table>
</form>