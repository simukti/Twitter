<?php
/**
 * Description of OauthController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class OauthController extends Twitter_BaseController
{
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
    public function indexAction()
    {
        if($this->getTwitter()->isAuthorised()) {
            $this->_helper->redirector->gotoRouteAndExit(array(), 'index-index');
        }
        $this->view->headTitle('Welcome to ' . $this->view->twitterOption('app_name'));
    }
    
    public function loginAction()
    {
        $twitter = $this->getTwitter();
        $session = $this->getSession();
        
        if($twitter->isAuthorised()) {
            $this->_helper->redirector->gotoRouteAndExit(array(), 'index-index');
        } else {
            $session->requestToken = $twitter->getRequestToken();
            $twitter->redirect();
        }
    }
    
    public function logoutAction()
    {
        $this->getSession()->unsetAll();
        Zend_Session::forgetMe();
        $this->_helper->redirector->gotoRouteAndExit(array(), 'oauth-index');
    }
    
    public function callbackAction()
    {
        $twitter = $this->getTwitter();
        $session = $this->getSession();
        
        $query = $this->getRequest()->getQuery();
        $requestToken = $session->requestToken;
        
        if(! empty($query) || null !== $requestToken) {
            if(isset($query['denied'])) {
                $this->_helper->redirector->gotoRouteAndExit(array(), 'oauth-logout');
            } else {
                $accessToken = $twitter->getAccessToken($query, $requestToken);
                $session->accessToken = $accessToken;
                unset($session->requestToken);
                $this->_helper->redirector->gotoRouteAndExit(array(), 'index-index');
            }
        }
    }
}
