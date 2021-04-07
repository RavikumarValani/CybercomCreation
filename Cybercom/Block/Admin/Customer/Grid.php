<?php
namespace Block\Admin\Customer;

    \Mage::loadFileByClassName("Block\Core\Grid");

    class Grid extends \Block\Core\Grid
    {
        protected $customers = [];
        
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/grid.php');
        }   

        public function prepareCollection()
        {
            $customer = \Mage::getModel('Customer');
            $query = "SELECT c.*,cg.name AS groupName,ca.address
            FROM `customer` AS c 
            LEFT JOIN customer_group AS cg
                ON c.groupId = cg.groupId
            LEFT JOIN `customer_address` AS ca 
                ON ca.customerId = c.customerId
                AND type = 'billing'
            ";

            if($this->getFilter()->hasFilters())
            {
                $query .= " WHERE 1=1";
                foreach($this->getFilter()->getFilters() as $type => $filters)
                {
                    if($type == $this->getFilter()->getType()[$type])
                    {
                        foreach($filters as $key => $value)
                        {
                            $query .= " AND `{$key}` LIKE '%{$value}%'";
                        }
                    }
                }
            }
            $collection = $customer->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('customerId',[
                'field' => 'customerId',
                'label' => 'Customer Id',
                'type' => 'number'
            ]);
            $this->addColumns('groupName',[
                'field' => 'groupName',
                'label' => 'Group',
                'type' => 'text'
            ]);
            $this->addColumns('firstname',[
                'field' => 'firstname',
                'label' => 'First Name',
                'type' => 'text'
            ]);
            $this->addColumns('lastname',[
                'field' => 'lastname',
                'label' => 'Last Name',
                'type' => 'text'
            ]);
            $this->addColumns('email',[
                'field' => 'email',
                'label' => 'Email',
                'type' => 'varchar'
            ]);
            $this->addColumns('password',[
                'field' => 'password',
                'label' => 'Password',
                'type' => 'varchar'
            ]);
            $this->addColumns('mobile',[
                'field' => 'mobile',
                'label' => 'Mobile',
                'type' => 'number'
            ]);
            $this->addColumns('address',[
                'field' => 'address',
                'label' => 'Address',
                'type' => 'varchar'
            ]);
            return $this;
        }

        public function prepareAction()
        {
            $this->addActions('edit', [
                'label' => 'Edit',
                'method' => 'getEditUrl',
                'ajax' => false,
                'class' => 'primary'
            ]);
            $this->addActions('delete', [
                'label' => 'Delete',
                'method' => 'getDeleteUrl',
                'ajax' => false,
                'class' => 'danger'
            ]);
            return $this;
        }

        public function getEditurl($row)
        {
            return $this->getUrl()->getUrl('form', null, ['customerId' => $row->customerId]);
        }

        public function getDeleteUrl($row)
        {
            return $this->getUrl()->getUrl('delete', null, ['customerId' => $row->customerId]);
        }

        public function getTitle()
        {
            return 'Manage Customer';
        }

        public function prepareButton()
        {
            $this->addButton('AddCustomer', [
                'label' => 'Add Customer',
                'method' => 'getAddUrl',
                'ajax' => false
            ]);
            $this->addButton('Filter', [
                'label' => 'Apply Filter',
                'method' => 'getFilterUrl',
                'ajax' => false
            ]);
            return $this;
        }

        public function getAddUrl()
        {
            return $this->getUrl()->getUrl('form');
        }

        public function getFilterUrl()
        {
            return $this->getUrl()->getUrl('filter');
        }

    }       

?>