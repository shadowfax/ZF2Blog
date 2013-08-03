<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */



namespace Blog\Model;

use Blog\Model\Base\User;

use Zend\Db\ResultSet\ResultSet;

use Zend\Db\Adapter\Adapter;

use Zend\Db\Sql\Predicate\PredicateSet;

use Zend\Db\Sql\Sql;



class Users
{
    /**
	 * 
	 * Enter description here ...
	 * @var Adapter
	 */
	protected $adapter;
	
	protected $tablename = 'blog_users';
	
	/**
     * @var ResultSetInterface
     */
    protected $resultSetPrototype = null;
    
	public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new User());
    }
    
    /**
     * Get a user based on the user ID
     * 
     * @param $id
     */
    public function getUserBy( $field, $value )
    {
    	$sql = new Sql($this->adapter, $this->tablename);
    	$select = $sql->select();
    	
    	switch ($field)
    	{
    		case 'id':
    			$value = (int)$value;
    			$select->where(array('ID' => $value));
    			break;
    		//case 'slug':
    		//	break;
    		case 'email':
    			$select->where(array('user_email' => $value));
    			break;
    		case 'login':
    			$select->where(array('user_login' => $value));
    			break;
    		default:
    			break;
    	}
    	
    	$statement=  $sql->prepareStatementForSqlObject($select);
    	$result = $statement->execute();
    	
    	// build result set
        $resultSet = clone $this->resultSetPrototype;
        $resultSet->initialize($result);
        
        if ($resultSet->count() === 1) {
        	return $resultSet->current();
        } else {
        	return new User();
        }
    }
    
    /**
     * Save a user into the database.
     *
     * @param $user
     */
	public function saveUser(User $user)
    {
    	
    	$data = array(
			'user_login'          => $user->login,
			'user_pass'           => $user->password,
			'user_nicename'       => $user->nicename,
			'user_email'	      => $user->email,
			'user_url'            => $user->url,
			'user_registered'     => $user->registered,
			'user_activation_key' => $user->activation_key,
			'user_status'         => $user->status,
			'display_name'        => $user->display_name,
    	);

        $id = (int)$user->id;
        
    }
    
    /**
     * Delete a user given the user id.
     * 
     * @param unknown_type $id
     */
	public function deleteUser($id)
    {
       
    }
}