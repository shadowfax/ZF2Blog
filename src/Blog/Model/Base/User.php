<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */



namespace Blog\Model\Base;

class User
{
	/**
	 * Table name
	 * 
	 * @var string
	 */
	const TABLE_NAME = 'blog_users';
	
	/**
	 * Related tables
	 * 
	 * @var array
	 */
	private $relatedTables = array();
	
	protected $_fields = array(
		'ID'                  => 0,
		'user_login'          => null,
		'user_pass'           => null,
		'user_nicename'       => null,
		'user_email'	      => null,
		'user_url'            => null,
		'user_registered'     => '0000-00-00 00:00:00',
		'user_activation_key' => null,
		'user_status'         => 0,
		'display_name'        => null,
	);

	public function __construct($relatedTables = array())
	{
		$this->relatedTables = $relatedTables;
	}
	
    public function exchangeArray($data)
    {
        $this->_fields['ID']                  = (!empty($data['ID'])) ? $data['ID'] : 0;
        $this->_fields['user_login']          = (!empty($data['user_login'])) ? $data['user_login'] : null;
        $this->_fields['user_pass']           = (!empty($data['user_pass'])) ? $data['user_pass'] : null;
        $this->_fields['user_nicename']       = (!empty($data['user_nicename'])) ? $data['user_nicename'] : null;
        $this->_fields['user_email']          = (!empty($data['user_email'])) ? $data['user_email'] : null;
        $this->_fields['user_url']            = (!empty($data['user_url'])) ? $data['user_url'] : null;
        $this->_fields['user_registered']     = (!empty($data['user_registered'])) ? $data['user_registered'] : '0000-00-00 00:00:00';
        $this->_fields['user_activation_key'] = (!empty($data['user_activation_key'])) ? $data['user_activation_key'] : null;
        $this->_fields['user_status']         = (!empty($data['user_status'])) ? $data['user_status'] : 0;
        $this->_fields['display_name']        = (!empty($data['display_name'])) ? $data['display_name'] : null;
    }
    
    public function __set($name, $value)
    {
    	switch ($name) {
    		case 'login':
    			$this->_fields['user_login'] = $value;
    			break;
    		case 'password':
    			$this->_fields['user_pass'] = $value;
    			break;
    		case 'nicename':
    			$this->_fields['user_nicename'] = $value;
    			break;
    		case 'email':
    			$this->_fields['user_email'] = $value;
    			break;
    		case 'url':
    			$this->_fields['user_url'] = $value;
    			break;
    		case 'registered':
    			$this->_fields['user_registered'] = $value;
    			break;
    		case 'activation_key':
    			$this->_fields['user_activation_key'] = $value;
    			break;
    		case 'status':
    			$this->_fields['user_status'] = $value;
    			break;
    		case 'display_name':
    			$this->_fields['display_name'] = $value;
    			break;
    	}
    }
    
	public function __get($name)
    {
    	switch ($name) {
    		case 'id':
    		case 'ID':
    			return $this->_fields['ID'];
    			break;
    		case 'login':
    		case 'user_login':
    			return $this->_fields['user_login'];
    			break;
    		case 'password':
    		case 'user_pass':
    			return $this->_fields['user_pass'];
    			break;
    		case 'nicename':
    		case 'user_nicename':
    			return $this->_fields['user_nicename'];
    			break;
    		case 'email':
    		case 'user_email':
    			return $this->_fields['user_email'];
    			break;
    		case 'url':
    		case 'user_url':
    			return $this->_fields['user_url'];
    			break;
    		case 'registered':
    		case 'user_registered':
    			return $this->_fields['user_registered'];
    			break;
    		case 'activation_key':
    		case 'user_activation_key':
    			return $this->_fields['user_activation_key'];
    			break;
    		case 'status':
    		case 'user_status':
    			return $this->_fields['user_status'];
    			break;
    		case 'display_name':
    			// Make sure a display name is present.
    			if (!empty($this->_fields['display_name'])) {
    				return $this->_fields['display_name'];
    			} elseif (!empty($this->_fields['user_nicename'])) {
    				return $this->_fields['user_nicename'];
    			} else {
    				return $this->_fields['user_login'];
    			}
    			break;
    	}
    	
    	return null;
    }
    
    /**
     * This function returns the value of a specific metakey pertaining to 
     * the current user.
     *
     * @param string $metakey    The metakey value to be returned.
     * @return string
     */
    public function getUserMeta($metakey)
    {
    	if (isset($this->relatedTables[UserMeta::TABLE_NAME])) {
    		return $this->relatedTables[UserMeta::TABLE_NAME]->getUserMeta($this->_fields['ID'], $metakey);
    	} else {
    		throw new \Exception('No meta table has been defined for users');
    	}
    }
}