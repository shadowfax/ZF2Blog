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

use Blog\Model\Base\Post;



class Posts
{
	
	
	/**
	 * 
	 * Enter description here ...
	 * @var Adapter
	 */
	protected $adapter;
	
	protected $tablename = 'blog_posts';
	
	private $_users;
	
	/**
     * @var ResultSetInterface
     */
    protected $resultSetPrototype = null;
	

    public function __construct(Adapter $adapter, $relatedTables = array())
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Post($relatedTables));
    }
   
    public function getPosts( $args = array() )
    {
    	$defaults = array(
			'posts_per_page'  => 5,
			'offset'          => 0,
			'category'        => '',
			'orderby'         => 'post_date',
			'order'           => 'DESC',
			'include'         => '',
			'exclude'         => '',
			'meta_key'        => '',
			'meta_value'      => '',
			'post_type'       => 'post',
			'post_mime_type'  => '',
			'post_parent'     => '',
			'post_status'     => 'publish',
			'suppress_filters' => true
    	);
    	
    	$args = array_merge($defaults, $args);
    	
    	// Enforce some fields
    	if (empty($args['post_type'])) $args['post_type'] = 'post';
    	if (empty($args['post_status'])) $args['post_status'] = 'publish';
    	if (empty($args['orderby'])) $args['orderby'] = 'post_date';
    	if (empty($args['order'])) $args['order'] = 'DESC';

  
    	
    	$sql = new Sql($this->adapter, $this->tablename);
    	$select = $sql->select();
    	$select->where(array('post_type' => $args['post_type']));
    	$select->where(array('post_status' => $args['post_status']), PredicateSet::OP_AND);
    	
    	// mime type
    	if (isset($args['post_mime_type'])) {
    		if (!empty($args['post_mime_type'])) {
    			$select->where(array('post_mime_type' => $args['post_mime_type']), PredicateSet::OP_AND);
    		}
    	}
    	
    	// Limit
    	if ($args['posts_per_page'] > 0) {
    		$select->limit($args['posts_per_page']);
    		$select->offset($args['offset']);
    	}
    	
    	// Order by
    	$select->order($args['orderby'] . ' ' . $args['order']);
    	
    	//die($select->getSqlString($this->tableGateway->getAdapter()->getPlatform()));
    	// Execute query
    	$statement=  $sql->prepareStatementForSqlObject($select);
    	$result = $statement->execute();
    	
    	// build result set
        $resultSet = clone $this->resultSetPrototype;
        $resultSet->initialize($result);
        
        return $resultSet;
    }

    public function getPost($id)
    {
        $id  = (int) $id;
        
        $sql = new Sql($this->adapter, $this->tablename);
    	$select = $sql->select();
    	$select->where(array('ID' => $id));
    	
    	$statement=  $sql->prepareStatementForSqlObject($select);
    	$result = $statement->execute();
    	
    	// build result set
        $resultSet = clone $this->resultSetPrototype;
        $resultSet->initialize($result);
        
        if ($resultSet->count() > 0) {
        	return $resultSet->current();
        }
        
        return new Post();
    }

}