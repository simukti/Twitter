<?php
/**
 * Description of TweetDetail
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class View_Helper_TweetDetail extends Zend_View_Helper_Abstract
{
    protected $_ul = "<ul class=\"tweet_detail\">%s</ul>";
    
    public function tweetDetail($user_name, $user_screen_name, $tweet_created_at, $tweet_source)
    {
        $user_url = $this->view->url(array('screen_name' => $user_screen_name), 'index-show_user');
        $user = sprintf("<li><a href=\"%s\"><i class=\"icon-user\"></i> %s</a></li>", $user_url, sprintf("%s (@%s)", $user_name, $user_screen_name));
        
        $created_at = sprintf("<li><i class=\"icon-calendar\"></i> %s</li>", date("j/M/Y g:i A", strtotime($tweet_created_at)));
        
        $source = sprintf("<li><i class=\"icon-flag\"></i> via <strong> %s</strong></li>", $tweet_source);
        
        $detail = sprintf($this->_ul, $user . $created_at . $source);
        
        return $detail;
    }
}
