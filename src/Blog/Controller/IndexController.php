<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $blog;
	
    public function indexAction()
    {
        return new ViewModel(
        	array(
        		'posts' => $this->getBlog()->getPosts()
        	)
        );
        
    }
    
	public function getBlog()
    {
        if (!$this->blog) {
            $sm = $this->getServiceLocator();
            $this->blog = $sm->get('Blog');
        }
        return $this->blog;
    }
}
