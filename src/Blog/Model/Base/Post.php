<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog\Model\Base;

use Blog\Model\Base\User;
use Blog\Model\Users;

class Post
{
    /**
	 * Table name
	 * 
	 * @var string
	 */
	const TABLE_NAME = 'blog_posts';
	
	/**
	 * Related tables
	 * 
	 * @var array
	 */
	private $relatedTables = array();
	
	
	/**
	 * Author data
	 * 
	 * @var User
	 */
	private $_author;
	
	public function __construct($relatedTables = array())
	{
		$this->relatedTables = $relatedTables;
	}
	
    protected $_fields = array(
    	'ID'                    => 0,
    	'post_author'           => 0,
    	'post_date'             => '0000-00-00 00:00:00',
    	'post_date_gmt'         => '0000-00-00 00:00:00',
    	'post_content'          => null,
    	'post_title'            => null,
    	'post_excerpt'          => null,
    	'post_status'           => 'publish',
    	'comment_status'        => 'open',
    	'ping_status'           => 'open',
    	'post_password'         => null,
    	'post_name'             => null,
    	'to_ping'               => null,
    	'pinged'                => null,
    	'post_modified'         => '0000-00-00 00:00:00',
    	'post_modified_gmt'     => '0000-00-00 00:00:00',
    	'post_content_filtered' => null,
    	'post_parent'           => 0,
    	'guid'                  => null,
    	'menu_order'            => 0,
    	'post_type'             => 'post',
    	'post_mime_type'        => null,
    	'comment_count'         => 0
    );
    

    public function exchangeArray($data)
    {
    	
        $this->_fields['ID']                    = (!empty($data['ID'])) ? $data['ID'] : 0;
        $this->_fields['post_author']           = (!empty($data['post_author'])) ? $data['post_author'] : 0;
        $this->_fields['post_date']             = (!empty($data['post_date'])) ? $data['post_date'] : '0000-00-00 00:00:00';
        $this->_fields['post_date_gmt']         = (!empty($data['post_date_gmt'])) ? $data['post_date_gmt'] : '0000-00-00 00:00:00';
        $this->_fields['post_content']          = (!empty($data['post_content'])) ? $data['post_content'] : null;
        $this->_fields['post_title']            = (!empty($data['post_title'])) ? $data['post_title'] : null;
        $this->_fields['post_excerpt']          = (!empty($data['post_excerpt'])) ? $data['post_excerpt'] : null;
        $this->_fields['post_status']           = (!empty($data['post_status'])) ? $data['post_status'] : 'publish';
        $this->_fields['comment_status']        = (!empty($data['comment_status'])) ? $data['comment_status'] : 'open';
        $this->_fields['ping_status']           = (!empty($data['ping_status'])) ? $data['ping_status'] : 'open';
        $this->_fields['post_password']         = (!empty($data['post_password'])) ? $data['post_password'] : null;
        $this->_fields['post_name']             = (!empty($data['post_name'])) ? $data['post_name'] : null;
        $this->_fields['to_ping']               = (!empty($data['to_ping'])) ? $data['to_ping'] : null;
        $this->_fields['pinged']                = (!empty($data['pinged'])) ? $data['pinged'] : null;
        $this->_fields['post_modified']         = (!empty($data['post_modified'])) ? $data['post_modified'] : '0000-00-00 00:00:00';
        $this->_fields['post_modified_gmt']     = (!empty($data['post_modified_gmt'])) ? $data['post_modified_gmt'] : '0000-00-00 00:00:00';
        $this->_fields['post_content_filtered'] = (!empty($data['post_content_filtered'])) ? $data['post_content_filtered'] : null;
        $this->_fields['post_parent']           = (!empty($data['post_parent'])) ? $data['post_parent'] : 0;
        $this->_fields['guid']                  = (!empty($data['guid'])) ? $data['guid'] : null;
        $this->_fields['menu_order']            = (!empty($data['menu_order'])) ? $data['menu_order'] : 0;
        $this->_fields['post_type']             = (!empty($data['post_type'])) ? $data['post_type'] : 'post';
        $this->_fields['post_mime_type']        = (!empty($data['post_mime_type'])) ? $data['post_mime_type'] : null;
        $this->_fields['comment_count']         = (!empty($data['comment_count'])) ? $data['comment_count'] : 0;
    }
    
    public function __set($name, $value)
    {
    	switch ($name)
    	{
    		case 'author':
    			if ($value instanceof User) {
    				$this->_fields['post_author'] = $value->ID;
    			} elseif (is_numeric($value)) {
    				$this->_fields['post_author'] = $value;
    			} else {
    				throw new \Exception("Post author must be an integer or a User object.");
    			}
    			break;
    		case 'date':
    			$this->_fields['post_date'] = $value;
    			break;
    		case 'date_gmt':
    			$this->_fields['post_date_gmt'] = $value;
    			break;
    		case 'content':
    			$this->_fields['post_content'] = $value;
    			break;
    		case 'title':
    			$this->_fields['post_title'] = $value;
    			break;
    		case 'excerpt':
    			$this->_fields['post_excerpt'] = $value;
    			break;
    		case 'status':
    			$this->_fields['post_status'] = $value;
    			break;
    		case 'comment_status':
    			$this->_fields['comment_status'] = $value;
    			break;
    		case 'ping_status':
    			$this->_fields['ping_status'] = $value;
    			break;
    		case 'password':
    			$this->_fields['post_password'] = $value;
    			break;
    		case 'name':
    			$this->_fields['name'] = $value;
    			break;
    		case 'to_ping':
    			$this->_fields['to_ping'] = $value;
    			break;
    		case 'pinged':
    			$this->_fields['pinged'] = $value;
    			break;
    		case 'modified':
    			$this->_fields['post_modified'] = $value;
    			break;
    		case 'modified_gmt':
    			$this->_fields['post_modified_gmt'] = $value;
    			break;
    		case 'content_filtered':
    			$this->_fields['post_content_filtered'] = $value;
    			break;
    		case 'parent':
    			$this->_fields['post_parent'] = $value;
    			break;
    		case 'guid':
    			$this->_fields['guid'] = $value;
    			break;
    		case 'menu_order':
    			$this->_fields['menu_order'] = $value;
    			break;
    		case 'type':
    			$this->_fields['post_type'] = $value;
    			break;
    		case 'mime_type':
    			$this->_fields['post_mime_type'] = $value;
    			break;
    		case 'comment_count':
    			$this->_fields['comment_count'] = $value;
    			break;
    		default:
    			throw new \Exception('The field ' . $name . ' has not been defined');
    	}
    }
    
	public function __get($name)
    {
    	
    	switch ($name) {
    		case 'author':
    			return $this->_fields['post_author'];
    			break;
    		case 'date':
    			return $this->_fields['post_date'];
    			break;
    		case 'date_gmt':
    			return $this->_fields['post_date_gmt'];
    			break;
    		case 'content':
    			return $this->_fields['post_content'];
    			break;
    		case 'title':
    			return $this->_fields['post_title'];
    			break;
    		case 'excerpt':
    			return $this->_fields['post_excerpt'];
    			break;
    		case 'status':
    			return $this->_fields['post_status'];
    			break;
    		case 'comment_status':
    			return $this->_fields['comment_status'];
    			break;
    		case 'ping_status':
    			return $this->_fields['ping_status'];
    			break;
    		case 'password':
    			return $this->_fields['post_password'];
    			break;
    		case 'name':
    			return $this->_fields['name'];
    			break;
    		case 'to_ping':
    			return $this->_fields['to_ping'];
    			break;
    		case 'pinged':
    			return $this->_fields['pinged'];
    			break;
    		case 'modified':
    			return $this->_fields['post_modified'];
    			break;
    		case 'modified_gmt':
    			return $this->_fields['post_modified_gmt'];
    			break;
    		case 'content_filtered':
    			return $this->_fields['post_content_filtered'];
    			break;
    		case 'parent':
    			return $this->_fields['post_parent'];
    			break;
    		case 'guid':
    			return $this->_fields['guid'];
    			break;
    		case 'menu_order':
    			return $this->_fields['menu_order'];
    			break;
    		case 'type':
    			return $this->_fields['post_type'];
    			break;
    		case 'mime_type':
    			return $this->_fields['post_mime_type'];
    			break;
    		case 'comment_count':
    			return $this->_fields['comment_count'];
    			break;
    		default:
    			throw new \Exception('The field ' . $name . ' has not been defined');
    			break;
    	}
    	
    	return null;
    }
    
    /**
     * Retrieves the post's author object
     * 
     * @return User
     * @throws \Exception
     */
    protected function __getAuthor()
    {
    	if (is_null($this->_author)) {
    		if (isset($this->relatedTables[User::TABLE_NAME])) {
    			$this->_author = $this->relatedTables[User::TABLE_NAME]->getUserBy('id', $this->_fields['post_author']);
    			if (empty($this->_author)) {
    				throw new \Exception('No author found for this post');
    			}
    		} else {
    			throw new \Exception('No user table has been defined for posts');
    		}
    	}
    	
    	return $this->_author;
    }
    
    /**
     * Retrieve the post author.
     * 
     * @return String
     */
    public function getTheAuthor()
    {
    	return $this->__getAuthor()->display_name;
    }
    
    /**
     * This tag returns a link to the Website for the author of a post.
     * The Website field is set in the user's profile. The text for the 
     * link is the author's Profile Display name publicly as field. 
     * This tag must be used within The Loop.
	 *
	 * get_the_author_link() returns the link for use in PHP. To display 
	 * the link instead, use the_author_link().
     *
     * @return String
     */
    public function getTheAuthorLink()
    {
    	$url = $this->__getAuthor()->getUserMeta($this->_fields['post_author'], 'url');
    	if (empty($url)) {
    		$url = $this->__getAuthor()->user_url;
    		if (empty($url)) {
    			return $this->__getAuthor()->display_name;
    		}
    	} else {
    		return '<a href="' . $url . '" rel="external nofollow">' . $this->__getAuthor()->display_name . '</a>';
    	}
    }
    
    
    
    public function commentsAllowed()
    {
    	if (strcasecmp($this->_fields['comments_status'], 'open') === 0) {
    		return true;
    	}
    	return false;
    }
    
}