<?php
/**
 * Description of TwitterOption
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class View_Helper_TwitterOption extends Zend_View_Helper_Abstract
{
    public function twitterOption($key)
    {
        $fc         = Zend_Controller_Front::getInstance();
        $options    = $fc->getParam('bootstrap')->getOption('twitter');
        
        if(isset($options[$key])) {
            return $options[$key];
        }
    }
}
