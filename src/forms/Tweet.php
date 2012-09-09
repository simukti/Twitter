<?php
/**
 * Description of Tweet
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Form_Tweet extends Zend_Form
{
    public function init()
    {
        $this->setOptions(array(
            'elements' => array(
                'tweet' => array('textarea', array(
                    'label'     => '{{i class=||icon-edit||}}{{/i}} New Tweet',
                    'required'  => true,
                    'attribs'   => array(
                        'rows'  => 3
                    ),
                    'validators' => array(
                        array('stringLength', false, array('max' => 140))
                    )
                )),
                'location' => array('select', array(
                    'label'         => 'Set My Location :)',
                    'required'      => true,
                    'multiOptions'  => $this->_getGeolocation()
                )),
                'send' => array('submit', array(
                    'label' => 'Send'
                ))
            ),
        ));
    }
    
    /**
     * @return  array
     */
    protected function _getGeolocation()
    {
        $location = Twitter_Service::getGeolist();
        $data     = array();
        foreach($location as $id => $values) {
            $data[$id] = $values['name'];
        }
        return $data;
    }


    /**
     * Replying a tweet
     * 
     * @param   string $screen_name
     * @return  \Form_Tweet 
     */
    public function inject($screen_name)
    {
        $name = sprintf("@%s ", $screen_name);
        
        $this->getElement('tweet')
             ->setLabel('{{i class=||icon-share||}}{{/i}} Reply to ' . $name);
        $this->getElement('send')
             ->setLabel('Send Reply To ' . $name);
        
        $this->setDefaults(array(
            'tweet' => $name
        ));
        
        return $this;
    }
    
    /**
     * Mention a user
     * 
     * @param   string $screen_name
     * @return  \Form_Tweet 
     */
    public function mention($screen_name)
    {
        $name = sprintf("@%s ", $screen_name);
        
        $this->getElement('tweet')
             ->setLabel('{{i class=||icon-edit||}}{{/i}} Mention ' . $name);
        
        $this->setDefaults(array(
            'tweet' => $name
        ));
        
        return $this;
    }
    
    /**
     * Set form as Direct Message form
     * 
     * @param   string $screen_name
     * @return  \Form_Tweet 
     */
    public function asDirectMessage($screen_name)
    {
        $name = sprintf("@%s ", $screen_name);
        
        $this->removeElement('location');
        $this->getElement('tweet')
             ->setLabel('{{i class=||icon-envelope||}}{{/i}} DirectMessage to ' . $name);
        
        return $this;
    }
}
