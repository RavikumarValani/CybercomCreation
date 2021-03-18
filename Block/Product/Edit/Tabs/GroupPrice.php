<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Product_Edit_Tabs_GroupPrice extends  Block_Core_Template
    {
        protected $product = null;
        public function __construct()
        {
            $this->setTemplate('./view/product/edit/tabs/groupprice.php');
        }

        public function setProduct(Model_Product $product)
        {
            $this->product = $product;
            return $this;
        }
        public function getProduct()
        {
            return $this->product;
        }

        public function getCustomerGroup()
        {
            $query = "SELECT cg.*,pgp.productid,pgp.entityId,pgp.price as groupPrice,
            if(p.price IS NULL,'{$this->getProduct()->price}',p.price) as price
            FROM customer_group cg
            LEFT JOIN product_group_price pgp
                ON pgp.customerGroupid = cg.groupId
                AND pgp.productId = '{$this->getProduct()->id}'
            LEFT JOIN product p
                ON pgp.productId = p.id
            ";
            $customerGroup = Mage::getModel('CustomerGroup');
            return $customerGroup->fetchAll($query)->getData();
            
        }
    }
