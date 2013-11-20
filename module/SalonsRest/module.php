<?php
namespace SalonsRest;
 
 
use SalonsRest\Model\Salon;
use SalonsRest\Model\SalonTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
  public function getAutoloaderConfig()
  {
    return array(
    'Zend\Loader\ClassMapAutoloader' => array(
    __DIR__ . '/autoload_classmap.php',
    ),
    'Zend\Loader\StandardAutoloader' => array(
    'namespaces' => array(
    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
    ),
    ),
    );
  }
   
  public function getConfig()
  {
    return include __DIR__ . '/config/module.config.php';
  }
                    
       public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'SalonsRest\Model\SalonTable' =>  function($sm) {
                     $tableGateway = $sm->get('SalonTableGateway');
                     $table = new SalonTable($tableGateway);
                     return $table;
                 },
                 'SalonTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Salon());
                     return new TableGateway('dbo_x_salons', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
     
}