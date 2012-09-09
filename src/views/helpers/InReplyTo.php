<?php
/**
 * Description of InReplyTo
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class View_Helper_InReplyTo extends Zend_View_Helper_Abstract
{
    protected $_ul = "<ul class=\"tweet_menu\">%s</ul>";
    
    public function inReplyTo($in_reply_to_status_id, $in_reply_to_screen_name)
    {
        $tweet_url = $this->view->url(array('id' => $in_reply_to_status_id), 'tweet-show');
        $detail = sprintf("<li><a href=\"%s\"><i class=\"icon-share\"></i> In Reply-To: @%s</a></li>", $tweet_url, $in_reply_to_screen_name);
        
        $inReplyTo = sprintf($this->_ul, $detail);
        
        return $inReplyTo;
    }
}
