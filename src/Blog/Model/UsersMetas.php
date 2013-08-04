<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */



namespace Blog\Model;

use Blog\Model\Base\UserMeta;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Predicate\PredicateSet;
use Zend\Db\Sql\Sql;



class UsersMetas
{
    /**
	 * 
	 * Enter description here ...
	 * @var Adapter
	 */
	protected $adapter;
	
	/**
     * @var ResultSetInterface
     */
    protected $resultSetPrototype = null;
    
	public function __construct(Adapter $adapter, $relatedTables = array())
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new UserMeta($relatedTables));
    }
    
    /**
     * This function returns the value of a specific metakey pertaining to 
     * the user whose ID is passed via the userid parameter.
     *
     * @param int    $user_id    The ID of the user whose data should be retrieved.
     * @param string $metakey    The metakey value to be returned.
     * @return string
     */
    public function getUserMeta($user_id, $metakey)
    {
    	$user_id = (int)$user_id;
    	
    	$sql = new Sql($this->adapter, UserMeta::TABLE_NAME);
    	$select = $sql->select();
    	
    	$select->where(array('user_id' => $user_id));
    	$select->where(array('meta_key' => $metakey), PredicateSet::OP_AND);
    	
    	$statement = $sql->prepareStatementForSqlObject($select);
    	$result = $statement->execute();
    	
    	// build result set
        $resultSet = clone $this->resultSetPrototype;
        $resultSet->initialize($result);
        
        if ($resultSet->count() > 0) {
        	return $resultSet->current()->meta_value;
        } else {
        	return '';
        }
    	
    }
}