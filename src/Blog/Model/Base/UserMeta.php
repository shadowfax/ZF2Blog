<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */



namespace Blog\Model\Base;

class UserMeta
{
	/**
	 * Table name
	 * 
	 * @var string
	 */
	const TABLE_NAME   = 'blog_usermeta';
	
    public function exchangeArray($data)
    {
        $this->_fields['meta_id']    = (!empty($data['meta_id'])) ? $data['meta_id'] : 0;
        $this->_fields['user_id']    = (!empty($data['user_id'])) ? $data['user_id'] : 0;
        $this->_fields['meta_key']   = (!empty($data['meta_key'])) ? $data['meta_key'] : null;
        $this->_fields['meta_value'] = (!empty($data['meta_value'])) ? $data['meta_value'] : null;
    }
    
    public function __set($name, $value)
    {
    	switch ($name) {
    		case 'meta_id':
    			$this->_fields['meta_id'] = $value;
    			break;
    		case 'user_id':
    			$this->_fields['user_id'] = $value;
    			break;
    		case 'meta_key':
    			$this->_fields['meta_key'] = $value;
    			break;
    		case 'meta_value':
    			$this->_fields['meta_value'] = $value;
    			break;
    		default:
    			throw new \Exception('The field ' . $name . ' has not been defined');
    			break;
    	}
    }
    
	public function __get($name)
    {
    	switch ($name) {
    		case 'meta_id';
    			return $this->_fields['meta_id'];
    			break;
    		case 'user_id':
    			return $this->_fields['user_id'];
    			break;
    		case 'meta_key':
    			return $this->_fields['meta_key'];
    			break;
    		case 'meta_value':
    			return $this->_fields['meta_value'];
    			break;
    		default:
    			throw new \Exception('The field ' . $name . ' has not been defined');
    			break;
    	}
    	
    	return null;
    }
    
    
}