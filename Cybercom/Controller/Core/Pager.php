<?php
namespace Controller\Core;
    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Pager extends \Controller\Core\Admin
    {
        protected $totalRecords = null;
        protected $recordsPerPage = null;
        protected $numberOfPages = null;
        protected $start = null;
        protected $end = null;
        protected $previous = null;
        protected $next = null;
        protected $currentPage = null;

        public function setTotalRecords($record)
        {
            $this->totalRecords = $record;
            return $this;
        }
        public function getTotalRecords()
        {
            return $this->totalRecords;
        }

        public function setRecordsPerPage($records)
        {
            $this->recordsPerPage = (int)$records;
            return $this;
        }
        public function getRecordsPerPage()
        {
            return $this->recordsPerPage;
        }

        protected function setNumberOfPages($page)
        {
            $this->numberOfPages = (int)$page;
            return $this;
        }
        public function getNumberOfPages()
        {
            return $this->numberOfPages;
        }

        protected function setStart($start)
        {
            $this->start = $start;
            return $this;
        }
        public function getStart()
        {
            return $this->start;
        }

        protected function setEnd($end)
        {
            $this->end = $end;
            return $this;
        }
        public function getEnd()
        {
            return $this->end;
        }

        protected function setPrevious($previous)
        {
            $this->previous = $previous;
            return $this;
        }
        public function getPrevious()
        {
            return $this->previous;
        }

        protected function setNext($next)
        {
            $this->next = $next;
            return $this;
        }
        public function getNext()
        {
            return $this->next;
        }

        public function setCurrentPage($page)
        {
            $this->currentPage = (int)$page;
            return $this;
        }
        public function getCurrentPage()
        {
            return $this->currentPage;
        }

        public function calculate()
        {
            if($this->getTotalRecords() <= $this->getRecordsPerPage())
            {
                $this->setNumberOfPages(1);
                $this->setEnd(null);
                $this->setPrevious(null);
                $this->setNext(null);
                return $this;
            }

            $page = ceil($this->getTotalRecords/$this->getRecordsPerPage());
            $this->setNumberOfPages($page);
            $this->setEnd($page);

            if($this->getCurrentPage() > $this->getNumberOfPages())
            {
                $this->setCurrentPage($this->getNumberOfPages());
            }

            if($this->getCurrentPage() < $this->getStart())
            {
                $this->setCurrentPage($this->getStart());
            }

            if($this->getCurrentPage() == $this->getStart())
            {
                $this->setStart(null);
                $this->setPrevious(null);
                if($this->getCurrentPage() < $this->getNumberOfPages())
                {
                    $this->setNext($this->getCurrentPage() + 1);
                }

                return $this;   
            }

            if($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd())
            {
                $this->setPrevious($this->getCurrentPage() - 1);
                $this->setNext($this->getCurrentPage() + 1);
            }

        }
    }
    
?>