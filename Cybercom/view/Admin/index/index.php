<?php $customers = $this->getCustomers();  ?>
<form method="POST" id="customer" action="">
<select name="customer[customerId]" required="" class="form-control selectpicker" tabindex="-98">
    <option value="">Select..</option>
    <?php foreach ($customers->getData() as $key => $customer) : ?>
    <option value="<?php echo $customer->customerId ?>"  >
        <?php echo $customer->firstname ?> </option>
        
    <?php echo $customer->customerId; ?>
    <?php endforeach; ?>
</select>
<button type="submit" onclick="mage.setForm('#customer').setUrl('<?php echo $this->getUrl()->getUrl('selectCustomer', 'index'); ?>').load()">Go</button>
</form>
<div id="carouselExampleCaptions" class="carousel slide  " data-bs-ride="carousel" style="margin-top: 0px;">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./view/admin/index/image/1.jpg" class="d-block w-100%" style="padding-top: 0px;" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h3>WELCOME TO myShop</h3>
                <p>What you want,myShop give it</p>
                <button class="btn btn-danger">Popular Prodect</button>
                <button class="btn btn-primary">Best Discount</button>
                <button class="btn btn-success">Today's Best Deal</button>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./view/admin/index/image/2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Best Dealer for you</h5>
                <p>What you want,myShop give it</p>
                <button class="btn btn-danger">RANI SALT COMPANY</button>
                <button class="btn btn-primary">MEDICLUE SURGICAL</button>
                <button class="btn btn-success">FOUR SONZ ENTERPRISES</button>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./view/admin/index/image/3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Best Dealer for you</h5>
                <p>What you want,myShop give it</p>
                <button class="btn btn-danger">RANI SALT COMPANY</button>
                <button class="btn btn-primary">MEDICLUE SURGICAL</button>
                <button class="btn btn-success">FOUR SONZ ENTERPRISES</button>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>