<?php
/**
 * Description of TwitterBootstrap
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class TwitterBootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initNamespace()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH
        ));
        return $moduleLoader;
    }
    
    protected function _initSession()
    {
        $twitterOptions  = $this->getOption('api_key');
        $options         = $this->getPluginResource('Session')->getOptions();
        $options['name'] = $options['name'] . md5($twitterOptions['consumer_key']);
        Zend_Session::start($options);
    }
    
    protected function _initRoute()
    {
        $router = $this->getPluginResource('Router')->getRouter();
        $router->removeDefaultRoutes();
        return $router;
    }
}
