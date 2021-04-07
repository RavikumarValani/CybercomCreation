<?php
namespace Block\Admin\Product\Edit\Tabs\Group;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Price extends  \Block\Core\Edit\Tabs
    {
        protected $product = null;
        public function __construct()
        {
            $this->setTemplate('./view/admin/product/edit/tabs/group/price.php');
        }

        public function setProduct(\Model\Product $product)
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
            $query = "SELECT cg.*,pgp.productId,pgp.entityId,pgp.price as groupPrice,
            if(p.price IS NULL,{$this->getProduct()->price},p.price) as price
            FROM customer_group cg
            LEFT JOIN product_group_price pgp
                ON pgp.customerGroupId = cg.groupId
                AND pgp.productId = {$this->getProduct()->productId}
            LEFT JOIN product p
                ON pgp.productId = p.productId
            ";
            
            $customerGroup = \Mage::getModel('Customer\Group');
            return $customerGroup->fetchAll($query);
            
        }
    }
