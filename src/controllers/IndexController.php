<?php
/**
 * Description of IndexController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class IndexController extends Twitter_UserController
{
    public function indexAction()
    {
        $this->view->navigation()->findById('timeline')->setActive();
        
        $page = $this->_getParam('page');

        try {
            $timeline = $this->getTwitter()
                             ->statusFriendsTimeline(array(
                                    'page'        => $page,
                                    'include_rts' => $this->_getParam(
                                                        'rt', $this->view->twitterOption('display_retweet')
                                                     )
                               ));
        } catch (Exception $e) {
            $this->render('error');
        }
        
        $this->view->headTitle(sprintf("My Timeline (Page: %s)", $page));
        $this->view->timeline = $timeline;
    }
    
    public function repliesAction()
    {
        $this->view->navigation()->findById('replies')->setActive();
        
        $page = $this->_getParam('page');
        
        try {
            $timeline = $this->getTwitter()->statusReplies(array('page' => $page));
            $this->view->headTitle(sprintf("Replies To Me (Page: %s)", $page));
            $this->view->timeline = $timeline;
            
            $this->render('index');
        } catch (Exception $e) {
            $this->render('error');
        }
    }
    
    /**
     * Json response 
     */
    public function hashtagAction()
    {
        $tag  = $this->_getParam('tag');
        
        $id_cache = 'tag_search_' . $tag;
        
        $cached = $this->getCache()->load($id_cache);
        
        if(! $cached) {
            try {
                $timeline = $this->getTwitter()->setUri('https://search.twitter.com')
                                 ->restGet('/search.json', array(
                                    'q'    => '#' . $tag, // only search hashtag (no whitespace)
                                    'rpp'  => 40
                                 ));
                $json_response = Zend_Json::decode($timeline->getBody());
            } catch (Exception $e) {
                $this->render('error');
            }
            
            if($json_response['results']) {
                $this->getCache()->save($json_response, $id_cache);
            }
            $cached = $json_response;
        }
        
        $this->view->json_response = $cached;
        $this->view->tag = $tag;
        $this->view->headTitle(sprintf("Hashtag Search Result: #%s", $tag));
    }
    
    public function showUserAction()
    {
        $screen_name = $this->_getParam('screen_name');
        
        try {
            $user = $this->getTwitter()->userShow($screen_name);
            if($user->isSuccess()) {
                $this->view->user = $user;
                $form = Service_Twitter::getInstance()->getForm();
                if($screen_name !== $this->getTwitter()->getUsername()) {
                    $form->mention($screen_name);
                }
                $this->view->form = $form;
                $this->view->headTitle(sprintf("%s (@%s)", $user->name, $user->screen_name));
            } else {
                $this->render('locked-profile');
            }
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
    
    public function showUserTweetsAction()
    {
        $screen_name = $this->_getParam('screen_name');
        
        try {
            $user = $this->getTwitter()->userShow($screen_name);
            if($user->isSuccess()) {
                $this->view->headTitle(sprintf("%s (@%s) Tweets", $user->name, $user->screen_name));
                $tweets = $this->getTwitter()
                               ->statusUserTimeline(array(
                                    'screen_name' => $screen_name, 
                                    'count' => $this->view->twitterOption('fetch_per_request'), 
                                    'include_rts' => $this->view->twitterOption('display_retweet')
                                ));
                $this->view->user = $user;
                $this->view->tweets = $tweets;
            } else {
                $this->render('locked-profile');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
    
    public function showUserFollowingAction()
    {
        $screen_name = $this->_getParam('screen_name');
        
        try {
            $user = $this->getTwitter()->userShow($screen_name);
            if($user->isSuccess()) {
                $friends = $this->getTwitter()->userFriends(array('id' => $user->id));
                
                $this->view->headTitle(sprintf("%s (@%s) Friends", $user->name, $user->screen_name));
                $this->view->user = $user;
                $this->view->friends = $friends;
            } else {
                $this->render('locked-profile');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
    
    public function showUserFavesAction()
    {
        $screen_name = $this->_getParam('screen_name');
        
        try {
            $user = $this->getTwitter()->userShow($screen_name);
            if($user->isSuccess()) {
                $this->view->headTitle(sprintf("%s (@%s) Favourites", $user->name, $user->screen_name));
                $tweets = $this->getTwitter()->favoriteFavorites(array('id' => $user->id));
                $this->view->user = $user;
                $this->view->tweets = $tweets;
            } else {
                $this->render('locked-profile');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
    
    public function followUserAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $id_user = $this->_getParam('id_user');
        $token   = $this->_getParam('token');
        
        if($token !== md5($this->view->twitterOption('consumer_key') . $id_user)) {
            throw new Zend_Controller_Action_Exception('Invalid Token');
        }
        
        try {
            $create = $this->getTwitter()->friendshipCreate($id_user);
            if($create->isSuccess()) {
                $this->_redirect($this->getRequest()->getHeader('referer'));
            } else {
                $this->render('error');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
    
    public function unfollowUserAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $id_user = $this->_getParam('id_user');
        $token   = $this->_getParam('token');
        
        if($token !== md5($this->view->twitterOption('consumer_key') . $id_user)) {
            throw new Zend_Controller_Action_Exception('Invalid Token');
        }
        
        try {
            $destroy = $this->getTwitter()->friendshipDestroy($id_user);
            if($destroy->isSuccess()) {
                $this->_redirect($this->getRequest()->getHeader('referer'));
            } else {
                $this->render('error');
            }
        } catch (Exception $e) {
            $this->render('error');
        }
    }
}
