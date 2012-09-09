<?php
/**
 * Description of BaseController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Twitter_BaseController extends Zend_Controller_Action
{
    /**
     * @var \Zend_Service_Twitter
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
     * @return  \Twitter_Service
     */
    public function getTwitter()
    {
        if(null === $this->_twitter) {
            $this->_twitter = Service_Twitter::getInstance()->getTwitter();
        }
        return $this->_twitter;
    }
    
    /**
     * @return  \Zend_Session_Namespace
     */
    public function getSession()
    {
        if(null === $this->_session) {
            $this->_session = Service_Twitter::getInstance()->getSession();
        }
        return $this->_session;
    }
    
    /**
     * @return  \Zend_Cache_Core
     */
    public function getCache()
    {
        if(null === $this->_cache) {
            $this->_cache = Service_Twitter::getInstance()->getCache();
        }
        return $this->_cache;
    }
    
    /**
     * @see     \Zend_Controller_Action::preDispatch()
     */
    /*public function preDispatch()
    {
        parent::preDispatch();
        if($this->getTwitter()->isAuthorised()) {
            // This twitter client granted ONLY for @simukti and @wii_dya.
            if(! in_array($this->getTwitter()->getUsername(), array('wii_dya', 'simukti'))) {
                // So if you're not one of us, I'll wipe your session, and redirect you to Google UK
                $this->getSession()->unsetAll();
                Zend_Session::forgetMe();
                $this->_helper->redirector->gotoUrlAndExit('https://www.google.co.uk/');
            }
        }
    } */
    
    /**
     * @see     \Zend_Controller_Action::postDispatch()
     */
    public function postDispatch()
    {
        parent::postDispatch();
        $response = $this->getResponse();
        $response->setHeader('X-Powered-By', 'Sarjono Mukti Aji', true);
    }
}
