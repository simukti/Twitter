<?php
/**
 * Description of ErrorController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class ErrorController extends Twitter_BaseController
{
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (! $errors) {
            $this->view->message = 'Error Page';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Request parameter is not found';
                $this->view->requestUri = $errors['request']->getRequestUri();
                break;
            default:
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';

                break;
        }
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request   = $errors->request;
    }
}
