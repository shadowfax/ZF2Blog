<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */




namespace Blog\Service;

use Blog\Model\UsersMetas;

use Blog\Model\Base\UserMeta;

use Blog\Model\Users;

use Zend\Db\TableGateway\TableGateway;

use Zend\Db\ResultSet\ResultSet;

use Blog\Model\Posts;

use Blog\Model\Base\Option;
use Blog\Model\Base\Post;
use Blog\Model\Base\User;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;


class Blog implements ServiceManagerAwareInterface
{
	protected $serviceManager;
	
	protected $adapter;
	
	private $_tableGateways = array(
		'blog_options' => null,
		'blog_posts'   => null,
		'blog_users'   => null,
		'blog_usermeta' => null,
	);
	
	
	/**
     * Set service manager
     *
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
		$this->serviceManager = $serviceManager;    
    }
    
    
    public function setAdapter($adapter)
    {
    	$this->adapter = $adapter;
    }
    
    /**
     * Posts aliases
     */
    public function getPosts( $args = array() )
    {
    	$posts = $this->getTableGateway('blog_posts');
    	return $posts->getPosts($args);
    }
    
    /**
     * Users aliases
     */
    public function getUserBy( $field, $value )
    {
    	$users = $this->getTableGateway('blog_users');
    	return $users->getUserBy($field, $value);
    }
    
    
    
    private function getTableGateway( $name )
    {
    	if (is_null($this->_tableGateways[$name])) {
    	
	        switch($name) {
	        	case Option::TABLE_NAME:
	        		
	        		break;
	        	case Post::TABLE_NAME:
	        		$relatedTables = array(
	        			User::TABLE_NAME => $this->getTableGateway(User::TABLE_NAME)
	        		);
	        		
	        		$this->_tableGateways[$name] = new Posts($this->adapter, $relatedTables);
	        		break;
	        	case User::TABLE_NAME:
	        		$relatedTables = array(
	        			UserMeta::TABLE_NAME => $this->getTableGateway(UserMeta::TABLE_NAME)
	        		);
	        		
	        		$this->_tableGateways[$name] = new Users($this->adapter, $relatedTables);
	        		break;
	        	case UserMeta::TABLE_NAME:
	        		$this->_tableGateways[$name] = new UsersMetas($this->adapter);
	        		break;
	        }
    	}
    	
    	return $this->_tableGateways[$name];
    }
}