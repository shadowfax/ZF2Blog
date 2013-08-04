<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


namespace Blog\Model;

use Zend\ServiceManager\ServiceManager;

use Zend\Db\ResultSet\ResultSet;

use Zend\Db\Adapter\Adapter;

use Zend\Db\Sql\Predicate\PredicateSet;

use Zend\Db\Sql\Sql;

use Blog\Model\Base\PostMeta;

class PostMetas
{

	/**
	 * 
	 * Enter description here ...
	 * @var Adapter
	 */
	protected $adapter;
	
	protected $tablename = 'blog_postmeta';
	
	/**
     * @var ResultSetInterface
     */
    protected $resultSetPrototype = null;
	

    public function __construct(Adapter $adapter, ServiceManager $serviceManager)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new PostMeta());
    }
	
    public function getPostMeta($post_id, $key = null, $single = false)
    {
    	
    	$post_id = (int)$post_id;
    	
    	$sql = new Sql($this->adapter, $this->tablename);
    	$select = $sql->select();
    	$select->where(array('post_id' => $post_id));
    	
    	if (!empty($key)) {
    		$select->where(array('meta_key' => $key), PredicateSet::OP_AND);
    	}
    	
    	$statement=  $sql->prepareStatementForSqlObject($select);
    	$result = $statement->execute();
    	
    	// build result set
        $resultSet = clone $this->resultSetPrototype;
        $resultSet->initialize($result);
        
        if (!$single) {
        	return $resultSet;
        } elseif ($resultSet->count() !== 0) {
        	return $resultSet->current()->value;
        } else {
        	return null;
        }
    }
}


