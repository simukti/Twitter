<?php
/**
 * Description of UserController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Twitter_UserController extends Twitter_BaseController
{
    public function init()
    {
        parent::init();
        if(! $this->getTwitter()->isAuthorised()) {
            $this->_helper->redirector->gotoRouteAndExit(array(), 'oauth-index');
        }
    }
}
