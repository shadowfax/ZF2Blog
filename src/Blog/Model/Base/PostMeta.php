<?php


/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Model\Base;


use Zend\ServiceManager\ServiceManager;



class PostMeta
{
	
    protected $_fields = array(
    	'meta_id'    => 0,
    	'post_id'    => 0,
    	'meta_key'   => null,
    	'meta_value' => null
    );
    
    public function exchangeArray($data)
    {
        $this->_fields['meta_id']    = (!empty($data['meta_id'])) ? $data['meta_id'] : 0;
        $this->_fields['post_id']    = (!empty($data['post_id'])) ? $data['post_id'] : 0;
        $this->_fields['meta_key']   = (!empty($data['meta_key'])) ? $data['meta_key'] : null;
        $this->_fields['meta_value'] = (!empty($data['meta_value'])) ? $data['meta_value'] : null;
    }
    
	public function __set($name, $value)
    {
    	switch($name)
    	{
    		case 'meta_id':
       			$this->_fields['meta_id'] = (int)$value;
    			break;
    		case 'post_id':
    			$this->_fields['post_id'] = (int)$value;
    			break;
    		case 'key':
    			$this->_fields['meta_key'] = (string)$value;
    			break;
    		case 'value':
    			$this->_fields['meta_value'] = $value;
    			break;
    		default:
    			throw new \Exception('The field ' . $name . ' has not been defined');
    			break;
    	}
    }
    
    public function __get($name)
    {
    	switch($name)
    	{
    		case 'meta_id':
       			return $this->_fields['meta_id'];
    			break;
    		case 'post_id':
    			return $this->_fields['post_id'];
    			break;
    		case 'key':
    			return $this->_fields['meta_key'];
    			break;
    		case 'value':
    			return $this->_fields['meta_value'];
    			break;
    		default:
    			throw new \Exception('The field ' . $name . ' has not been defined');
    			break;
    	}
    }
}