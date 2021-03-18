
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark" id="navbarCollapse" style="height: 100px;margin-bottom: 100px;">
        <div class="container-fluid" >
            <a class="navbar-brand" href="">myShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active-light" aria-current="page" href="">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Product
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('grid','product',null,true); ?>">Product  List</a></li>
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('form','product',null,true); ?>">Add product</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Popular Product</a></li>
                            <li><a class="dropdown-item" href="#">Best Discount Product</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('grid','category',null,true); ?>" >Category List</a></li>
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('form','category',null,true); ?>">Add Category</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Customer
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('grid','customer',null,true); ?>">Customer List</a></li>
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('form','customer',null,true); ?>">Add Customer</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo $this->getUrl()->getUrl('form','customerGroup',null,true); ?>">Customer Group</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Payment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('grid','payment',null,true); ?>">PaymentList</a></li>
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('form','payment',null,true); ?>">Payment</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shipping
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('grid','shipping',null,true); ?>">shipping List</a></li>
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('form','shipping',null,true); ?>">shipping</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Attribute
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('grid','attribute',null,true); ?>">Attribute List</a></li>
                            <li><a class="dropdown-item" href = "<?php echo $this->getUrl()->getUrl('form','attribute',null,true); ?>">Add Attribute</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo $this->getUrl()->getUrl('grid','admin',null,true); ?>">admin List</a></li>
                            <li><a class="dropdown-item" href="<?php echo $this->getUrl()->getUrl('form','admin',null,true); ?>">Add admin</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    
