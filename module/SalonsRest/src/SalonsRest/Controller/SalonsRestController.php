<?php

namespace SalonsRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use SalonsRest\Model\Salon;          // <-- Add this import
use SalonsRest\Model\SalonTable;     // <-- Add this import
use Zend\View\Model\JsonModel;

class SalonsRestController extends AbstractRestfulController
{
    protected $salonTable;

    public function getList()
    {
        $results = $this->getSalonTable()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }

        return new JsonModel(array(
            'data' => $data,
        ));
    }

    public function get($id)
    {
        $salon = $this->getSalonTable()->getSalon($id);
        
        return new JsonModel(array(
            'data' => $salon,
        ));
    }


    public function getSalonTable()
    {
        if (!$this->salonTable) {
            $sm = $this->getServiceLocator();
            $this->salonTable = $sm->get('SalonsRest\Model\SalonTable');
        }
        return $this->salonTable;
    }
}