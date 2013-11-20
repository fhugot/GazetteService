<?php
// module/Album/src/Album/Model/AlbumTable.php:
namespace SalonsRest\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

class SalonTable  
{
   protected $tableGateway;
 
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
  
  
   
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getSalon($id)
    {
        $id  = (int) $id;
        $where = new Where() ;
        $where -> equalTo( 'dbo_x_salons.id', $id ) ;
     
        $select = new \Zend\Db\Sql\Select ;
        $select->from( $this->tableGateway->getTable() )    ;
               //  ->columns(array('id'))
                $select-> join ( 'dbo_x_lieux_exposition' , 'dbo_x_salons.lieux_exposition_id=dbo_x_lieux_exposition.id');
                $select-> join ( 'dbo_localite' , 'dbo_localite.id=dbo_x_lieux_exposition.localite_id');
                $select-> where( $where ) ;

   //     echo $select->getSqlString();
 
        $result = $this->tableGateway->selectWith($select) ;
        foreach ($result as $row) {
          // echo 'test';
            return $row ;
        }
        return $result;
         
    }

    public function getSalonFromDepartmentId($deptId)
    {
        $deptId  = (int) $deptId;
        $where = new Where() ;
        $where -> equalTo( 'dbo_localite.departement_id', $deptId ) ;
     
        $select = new \Zend\Db\Sql\Select ;
        $select->from( $this->tableGateway->getTable() )    ;
               //  ->columns(array('id'))
                $select-> join ( 'dbo_x_lieux_exposition' , 'dbo_x_salons.lieux_exposition_id=dbo_x_lieux_exposition.id');
                $select-> join ( 'dbo_localite' , 'dbo_localite.id=dbo_x_lieux_exposition.localite_id');
                $select-> where( $where ) ;

   //     echo $select->getSqlString();
 
        $result = $this->tableGateway->selectWith($select) ;
        return $result;
         
    }


}