<?php
/**
 * Description of TweetMenu
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class View_Helper_TweetMenu extends Zend_View_Helper_Abstract
{
    protected $_ul = "<ul class=\"tweet_menu\">%s</ul>";
    
    public function tweetMenu($id_tweet, $id_user, $screen_name, $show_single_menu = true)
    {
        if($screen_name == Service_Twitter::getInstance()->getTwitter()->getUsername()) {
            $dm_url = $this->view->url(array('id' => $id_tweet, 'token' => md5($this->view->twitterOption('consumer_key') . $id_tweet)), 'tweet-delete');
            $dm = sprintf("<li><a href=\"%s\" style=\"color:#d00;\"><i class=\"icon-remove\"></i> Delete This Tweet</a></li>", $dm_url); 
            $reply = '';
        } else {
            $reply_url = $this->view->url(array('id' => $id_tweet), 'tweet-reply');
            $reply = sprintf("<li><a href=\"%s\"><i class=\"icon-edit\"></i> Reply This</a></li>", $reply_url);
            
            $dm_url = $this->view->url(array('id_user' => $id_user), 'dm-write');
            $dm = sprintf("<li><a href=\"%s\"><i class=\"icon-envelope\"></i> Send DM</a></li>", $dm_url); 
        }
        
        $tweet_show_url = $this->view->url(array('id' => $id_tweet), 'tweet-show');
        $tweet_show = sprintf("<li><a href=\"%s\"><i class=\"icon-zoom-in\"></i> Show Tweet</a></li>", $tweet_show_url);
        
        if(! $show_single_menu) {
            $tweet_menu = sprintf($this->_ul, $reply . $dm);
        } else {
            $tweet_menu = sprintf($this->_ul, $reply . $dm . $tweet_show);
        }
        
        return $tweet_menu;
    }
}
