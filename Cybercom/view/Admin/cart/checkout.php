<?php $paymentMethods = $this->getPaymentMethods(); ?>
<?php $shippingMethods = $this->getShippingMethods();  ?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<?php $items = $this->getCart()->getItems(); ?>


<div class="container">
    <div class="row">
        <form method="POST" id="detail" action="<?php echo $this->getUrl()->getUrl('saveDetails') ?>" >
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items->getData() as $key => $item) : ?>
                        <tr>
                            <td><?php echo $this->getName($item->productId) ?></td>
                            <td><?php echo $item->quantity ?></td>
                            <td><?php echo $item->price * $item->quantity ?></td>
                            <td><?php echo $item->discount * $item->quantity ?></td>
                        </tr>
                        <?php $this->calculatePrice($item->price * $item->quantity) ?>
                        <?php $this->totalPrice($item->price  * $item->quantity, ($item->discount * $item->quantity)/100) ?>
                    <?php endforeach; ?>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td><?php echo $this->getPrice() ?></td>
                    </tr>
                    <tr>
                        <td>Final Total</td>
                        
                        <div style="display: none;"> 
                            <input type="text" name="product[total]" value="<?php echo $this->getPrice() - $this->getTotalPrice() ?>">
                        </div>
                        <div style="display: none;"> 
                            <input type="text" name="product[discount]" value="<?php echo $this->getTotalPrice()  ?>">
                        </div>
                        <td></td>
                        <td><?php echo $this->getPrice() - $this->getTotalPrice() ?></td>
                    </tr>
                    </tbody>
                </table>
            </ul>

            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Shipping Method</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Code</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($shippingMethods->getData() as $key => $shippingMethod) : ?>
                        <tr>
                            <th scope="row"><input type="radio" id="shipping" name="shipping[shippingId]" value="<?php echo $shippingMethod->shippingId ?>" <?php if($shippingMethod->shippingId == $this->getCart()->getOriginalData()['shippingmethodId']) { ?> checked <?php } ?> ></th>
                            <td><?php echo $shippingMethod->name ?></td>
                            <td><input id="shippingData" type="number" name="shipping[amount][<?php echo $shippingMethod->shippingId ?>]" value="<?php echo $shippingMethod->amount ?>"></td>
                            <td><?php echo $shippingMethod->code ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </ul>
            <h4 class="d-flex justify-content-between align-items-center mb-6">
                <span class="text-muted">Payment Method</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <?php foreach ($paymentMethods->getData() as $key => $paymentMethod) : ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <input type="radio" name="payment" value="<?php echo $paymentMethod->paymentId ?>" <?php if($paymentMethod->paymentId == $this->getCart()->getOriginalData()['paymentmethodId']) { ?> checked <?php } ?>>
                        <label class="custom-control-label"><?php echo $paymentMethod->name ?></label> <br>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        
        </div>
        <div class="col-12" style="text-align: center;padding-top:40px;">
            <input id="submit" type="submit" class="btn btn-success" value="Save" onclick="checkData()">
        </div>
        </form>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" method="POST" action="<?php echo $this->getUrl()->getUrl('save') ?>">
                <table border="1">
                    <tr>
                        <label><strong>Address *</strong></label>
                        <textarea name="billingAddress[address]" class="form-control"
                            rows="2"><?php echo $billingAddress->address ?></textarea>

                    </tr>
                    <tr>
                        <label for="city" class="form-label"><strong>City*</strong></label>
                        <input type="text" class="form-control" name="billingAddress[city]"
                            value="<?php echo $billingAddress->city; ?>">
                    </tr>
                    <tr>
                        <label for="state" class="form-label"><strong>State*</strong></label>
                        <input type="text" class="form-control" name="billingAddress[state]"
                            value="<?php echo $billingAddress->state; ?>">

                    </tr>
                    <tr>
                        <label for="state" class="form-label"><strong>Country*</strong></label>
                        <input type="text" class="form-control" name="billingAddress[country]"
                            value="<?php echo $billingAddress->country; ?>">

                    </tr>
                    <tr>
                        <label for="zip" class="form-label"><strong> Zip Code*</strong></label>
                        <input type="number" class="form-control" name="billingAddress[zip]"
                            value="<?php echo $billingAddress->zip; ?>">

                    </tr>
                    <tr>
                        <input type="checkbox" class="custom-control-input" id="same-address" name="shippingFlag"
                            value="<?php echo 1 ?>">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my
                            billing
                            address</label>

                    </tr>
                    <tr>
                        <input type="checkbox" class="custom-control-input" id="save-info" name="adressBookFlag"
                            value="<?php echo 1 ?>">
                        <label class="custom-control-label" for="save-info">Save this information for next
                            time</label>

                    </tr>
                </table>
                <input class="btn btn-primary" type="submit" name="submit" value="Save">
            </form>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Shipping address</h4>
                <form class="needs-validation" method="POST" action="<?php echo $this->getUrl()->getUrl('save') ?>">
                    <table border="1">
                        <tr>
                            <label><strong>Address *</strong></label>
                            <textarea name="shippingAddress[address]" class="form-control"
                                rows="2"><?php echo $shippingAddress->address ?></textarea>

                        </tr>
                        <tr>
                            <label for="city" class="form-label"><strong>City*</strong></label>
                            <input type="text" class="form-control" name="shippingAddress[city]"
                                value="<?php echo $shippingAddress->city; ?>">
                        </tr>
                        <tr>
                            <label for="state" class="form-label"><strong>State*</strong></label>
                            <input type="text" class="form-control" name="shippingAddress[state]"
                                value="<?php echo $shippingAddress->state; ?>">

                        </tr>
                        <tr>
                            <label for="state" class="form-label"><strong>Country*</strong></label>
                            <input type="text" class="form-control" name="shippingAddress[country]"
                                value="<?php echo $shippingAddress->country; ?>">

                        </tr>
                        <tr>
                            <label for="zip" class="form-label"><strong> Zip Code*</strong></label>
                            <input type="number" class="form-control" name="shippingAddress[zip]"
                                value="<?php echo $shippingAddress->zip; ?>">

                        </tr>

                        <tr>
                            <input type="checkbox" class="custom-control-input" id="save-info" name="adressBookFlag"
                                value="<?php echo 1 ?>">
                            <label class="custom-control-label" for="save-info">Save this information for next
                                time</label>

                        </tr>
                    </table>
                    <input class="btn btn-primary" type="submit" name="submit" value="Save">
                </form>

                <hr class="mb-4">
                <form method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'Order') ?>">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" >Place Order</button>
                </form>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">


</script>