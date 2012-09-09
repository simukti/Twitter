<?php
/**
 * Description of DmController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class DmController extends Twitter_BaseController
{
    public function init()
    {
        if(! $this->getTwitter()->isAuthorised()) {
            $this->_helper->redirector->gotoRouteAndExit(array(), 'oauth-index');
        }
    }
    
    public function indexAction()
    {
        $page = $this->_getParam('page');
        try {
            $dm = $this->getTwitter()->directMessageMessages(array('page' => $page));
            $this->view->dm = $dm;
        } catch (Exception $e) {
            $this->render('error');
        }
        $this->view->headTitle(sprintf("Direct Message (Page: %s)", $page));
    }
    
    public function sentAction()
    {
        $this->view->navigation()->findById('dm')->setActive();
        $page = $this->_getParam('page');
        try {
            $dm = $this->getTwitter()->directMessageSent(array('page' => $page));
            $this->view->dm = $dm;
            $this->render('index');
        } catch (Exception $e) {
            $this->render('error');
        }
        $this->view->headTitle(sprintf("Direct Message (Sent Items, Page: %s)", $page));
    }
    
    public function writeAction()
    {
        $this->view->navigation()->findById('dm')->setActive();
        $id_user = $this->_getParam('id_user');
        try {
            $user = $this->getTwitter()->userShow($id_user);
            $form = Service_Twitter::getInstance()->getForm()->asDirectMessage($user->screen_name);
            
            $this->view->form = $form;
            $this->view->me = $user;
        } catch (Exception $e) {
            $this->render('error');
        }
        
        $request = $this->getRequest();
        
        if($request->isPost() && $form->isValid($request->getPost())) {
            try {
                $dmSend = $this->getTwitter()->directMessageNew($id_user, $form->getValue('tweet'));
                $this->_helper->redirector->gotoRouteAndExit();
            } catch (Exception $e) {
                $this->render('error');
            }
        }
        $this->view->headTitle(sprintf("Direct Message to @%s", $user->screen_name));
    }
    
    public function deleteAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->_getParam('id');
        try {
            $delete = $this->getTwitter()->directMessageDestroy($id);
        } catch (Exception $e) {
            $this->render('error');
        }
        
        $this->_helper->redirector->gotoRouteAndExit(array(),'dm-index');
    }
}
