<?php
/**
 * Description of TweetController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class TweetController extends Twitter_BaseController
{
    public function init()
    {
        if(! $this->getTwitter()->isAuthorised()) {
            $this->_helper->redirector->gotoRouteAndExit(array(), 'oauth-index');
        }
    }
    
    public function writeAction()
    {
        try {
            $screen_name = $this->getTwitter()->getUsername();
            $me          = $this->getTwitter()->userShow($screen_name);
            $form        = Service_Twitter::getInstance()->getForm();
            
            $this->view->me = $me;
            $this->view->form = $form;
            $this->view->headTitle(sprintf("(@%s) Write New", $screen_name));
            
        } catch (Exception $e) {
            $this->render('error');
        }
        
        $request = $this->getRequest();
        
        if($request->isPost() && $form->isValid($request->getPost())) {
            try {
                $update = $this->getTwitter()
                               ->statusUpdate($form->getValue('tweet'), null, $form->getValue('location'));
                if($update->isSuccess()) {
                    $this->_helper->redirector->gotoRouteAndExit();
                }
            } catch (Exception $e) {
                $this->render('error');
            }
        }
    }
    
    public function replyAction()
    {
        $id = $this->_getParam('id');
        try {
            $tweet  = $this->getTwitter()->statusShow($id);
            if($tweet->isSuccess()) {
                $form   = Service_Twitter::getInstance()->getForm();
                $form->inject($tweet->user->screen_name);

                $this->view->tweet = $tweet;
                $this->view->form = $form;
                $this->view->headTitle(sprintf("Reply to: @%s, %s", $tweet->user->screen_name, $tweet->text));
            }
            
        } catch (Exception $e) {
            $this->render('error');
        }
        
        $request = $this->getRequest();
        
        if($request->isPost() && $form->isValid($request->getPost())) {
            try {
                $reply = $this->getTwitter()
                              ->statusUpdate($form->getValue('tweet'), $id, $form->getValue('location'));
                if($reply->isSuccess()) {
                    $this->_helper->redirector->gotoRouteAndExit();
                }
            } catch (Exception $e) {
                $this->render('error');
            }
        }
    }
    
    public function showAction()
    {
        $id = $this->_getParam('id');
        try {
            $tweet = $this->getTwitter()->statusShow($id);
            if($tweet->isSuccess()) {
                $this->view->tweet = $tweet;
                $this->view->headTitle(sprintf("TweetID %s by @%s", $tweet->id, $tweet->screen_name));
            } else {
                $this->render('locked-profile');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
    
    public function deleteAction()
    {
        $id    = $this->_getParam('id');
        $token = $this->_getParam('token');
        
        if($token !== md5($this->view->twitterOption('consumer_key') . $id)) {
            throw new Zend_Controller_Action_Exception('Invalid Token');
        }
        
        try {
            $tweet = $this->getTwitter()->statusDestroy($id);
            if($tweet->isSuccess()) {
                $this->_redirect($this->getRequest()->getHeader('referer'));
            } else {
                $this->render('error');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
}
