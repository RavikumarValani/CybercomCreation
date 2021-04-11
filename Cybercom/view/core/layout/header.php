
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
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','product'); ?>').load();" href="javascript:void(0);">Product  List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','product'); ?>').load();" href="javascript:void(0);" >Add product</a></li>
                            
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','category'); ?>').load();" href="javascript:void(0);">Category List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','category'); ?>').load();" href="javascript:void(0);">Add Category</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Customer
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','customer'); ?>').load();" href="javascript:void(0);">Customer List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','customer'); ?>').load();" href="javascript:void(0);">Add Customer</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','customer\group'); ?>').load();" href="javascript:void(0);">Customer Group</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Payment
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','payment'); ?>').load();" href="javascript:void(0);">PaymentList</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','payment'); ?>').load();" href="javascript:void(0);">Payment</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shipping
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','shipping'); ?>').load();" href="javascript:void(0);">shipping List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','shipping'); ?>').load();" href="javascript:void(0);">shipping</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CMS Page
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','CMSPage'); ?>').load();" href="javascript:void(0);">CMS List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','CMSPage'); ?>').load();" href="javascript:void(0);">Add CMS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Attribute
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','attribute'); ?>').load();" href="javascript:void(0);">Attribute List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','attribute'); ?>').load();" href="javascript:void(0);">Add Attribute</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin'); ?>').load();" href="javascript:void(0);">admin List</a></li>
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form','admin'); ?>').load();" href="javascript:void(0);">Add admin</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Config
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','config\group'); ?>').load()">Config Group</a></li>
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

    
