<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Index extends  \Controller\Core\Admin
    {
        public function indexAction()
        {
            try
            {
                $dashboard = \Mage::getBlock('Admin\Index\Index');
                $layout = $this->getLayout();
                $layout->getContent()->addChild($dashboard);
                $this->toLayoutHtml();

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }

        public function selectCustomerAction()
        {
            $customerData = $this->getRequest()->getPost('customer');
            $customerId = $customerData['customerId'];
            $session = \Mage::getModel('Admin\Session');
            $session->customerId = $customerId;
            $this->indexAction();
            
        }
    }
    
?>