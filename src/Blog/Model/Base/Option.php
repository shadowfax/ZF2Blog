<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Model\Base;

class Option
{
    public $option_id;
    public $option_name;
    public $option_value;
    public $autoload;

    public function exchangeArray($data)
    {
        $this->option_id    = (!empty($data['option_id'])) ? $data['option_id'] : 0;
        $this->option_name  = (!empty($data['option_name'])) ? $data['option_name'] : null;
        $this->option_value = (!empty($data['option_value'])) ? $data['option_value'] : null;
        $this->autoload     = (!empty($data['autoload'])) ? $data['autoload'] : 'yes';
    }
    
    public function __set($name, $value)
    {
    	switch ($name) {
    		case 'name':
    			$this->option_name = $value;
    			break;
    		case 'value':
    			$this->option_value = $value;
    			break;
    		case 'autoload':
    			$this->autoload = $value;
    			break;
    	}
    }
    
	public function __get($name)
    {
    	switch ($name) {
    		case 'id';
    			return $this->option_id;
    			break;
    		case 'name':
    			return $this->option_name;
    			break;
    		case 'value':
    			return $this->option_value;
    			break;
    		case 'autoload':
    			return $this->autoload;
    			break;
    	}
    	
    	return null;
    }
    
}