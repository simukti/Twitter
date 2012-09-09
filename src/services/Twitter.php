<?php
/**
 * Description of Twitter
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Service_Twitter
{
    /**
     * @var \Service_Twitter
     */
    protected static $_instance = null;
    
    /**
     * @var \Zend_Controller_Front
     */
    protected static $_frontController;
    
    /**
     * @var \Twitter_Service
     */
    protected $_twitter;
    
    /**
     * @var \Zend_Session_Namespace
     */
    protected $_session;
    
    /**
     * @var \Zend_Cache_Core
     */
    protected $_cache;
    
    /**
     * @var \Form_Tweet
     */
    protected $_form;
    
    /**
     * @var \Zend_View
     */
    protected $_view;
    
    /**
     * This class is a singleton 
     */
    private function __construct() {}
    
    /**
     * Disable object cloning on singleton class 
     */
    private function __clone() {}
    
    /**
     * @return  \Service_Twitter
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_frontController = Zend_Controller_Front::getInstance();
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    /**
     * @return  \Zend_View
     */
    public function getView()
    {
        if(!$this->view instanceof Zend_View_Interface) {
            $this->view = self::$_frontController->getParam('bootstrap')->getResource('view');
        }
        return $this->view;
    }
    
    /**
     * @return  \Twitter_Service
     */
    public function getTwitter()
    {
        if(! $this->_twitter) {
            $callback = self::$_frontController->getRouter()->assemble(array(), 'oauth-callback');
            $view     = $this->getView();
            
            $options = array(
                'consumerKey'       => $view->twitterOption('consumer_key'),
                'consumerSecret'    => $view->twitterOption('consumer_secret'),
                'callbackUrl'       => $view->serverUrl() . $callback,
                'requestTokenUrl'   => 'https://api.twitter.com/oauth/request_token',
                'authorizeUrl'      => 'https://api.twitter.com/oauth/authorize',
                'accessTokenUrl'    => 'https://api.twitter.com/oauth/access_token',
            );
            
            $session = $this->getSession();
            
            if($session->accessToken && $session->accessToken instanceof Zend_Oauth_Token_Access) {
                $token = $session->accessToken;
                $options['username'] = $token->screen_name;
                $options['accessToken'] = $token;
            }
            
            $this->_twitter = new Twitter_Service($options);
        }
        
        return $this->_twitter;
    }
    
    /**
     * @return  \Zend_Session_Namespace
     */
    public function getSession()
    {
        if(null === $this->_session) {
            $view     = $this->getView();
            $this->_session = new Zend_Session_Namespace('twitter_' . md5($view->twitterOption('consumer_key')));
        }
        return $this->_session;
    }
    
    /**
     * @return  \Zend_Cache_Core
     */
    public function getCache()
    {
        $manager = self::$_frontController->getParam('bootstrap')->getResource('cachemanager');
        $cache = $manager->getCache('rest');
        
        return $cache;
    }
    
    /**
     * @return  \Form_Tweet
     */
    public function getForm()
    {
        if(null === $this->_form) {
            $this->_form = new Form_Tweet();
        }
        return $this->_form;
    }
}
