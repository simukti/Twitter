<?php
/**
 * Description of ProfPict
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class View_Helper_ProfPict extends Zend_View_Helper_Abstract
{
    public function profPict($profile_image_url, $screen_name)
    {
        $url = str_replace(array('_normal.jpg', '_normal.JPG', '_normal.png', '_normal.PNG', '_normal.gif', '_normal.GIF', '_normal.jpeg', '_normal.JPEG'), 
                           array(       '.jpg',        '.JPG',        '.png',        '.PNG',        '.gif',        '.GIF',        '.jpeg',        '.JPEG'), 
                          $profile_image_url);
        
        $profPict = sprintf("<a href=\"%s\" target=\"_blank\"><img class=\"tweet_avt\" alt=\"%s\" src=\"%s\"></a>", $url, $screen_name, $profile_image_url);
        
        return $profPict;
    }
}
