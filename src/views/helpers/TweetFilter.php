<?php
/**
 * Description of TweetFilter
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class View_Helper_TweetFilter extends Zend_View_Helper_Abstract
{
    public function tweetFilter($tweet_string)
    {
        $tweet_content = $this->_searchUrl($tweet_string);
        $tweet_content = $this->_searchShowUserUrl($tweet_content);
        $tweet_content = $this->_searchHashTagUrl($tweet_content);
        
        return $tweet_content;
    }
    
    /**
     * Find URL and replace with clickable link
     * 
     * @param   string $string
     * @return  string filtered string 
     */
    protected function _searchUrl($string)
    {
        $m = preg_match_all('/(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', $string, $match);
        if ($m) { 
            $url  = $match[0];
            for ($i=0; $i < $m; ++$i) { 
                $string = str_replace($url[$i],'<a href="'.$url[$i].'" target="_blank">'.$url[$i].'</a>', $string);
            } 
        }
        
        return $string;
    }
    
    /**
     * Find username and replace with clickable link
     * 
     * @param   string $string
     * @return  string filtered string 
     */
    protected function _searchShowUserUrl($string)
    {
        $m = preg_match_all('/@([A-Z0-9a-z_]{1,15})/i', $string, $match);
        if ($m) { 
            $user  = $match[0];
            $param = $match[1];
            for ($i=0; $i < $m; ++$i) { 
                $string = str_replace($user[$i],'<a href="'.$this->view->url(array('screen_name' => $param[$i]), 'index-show_user').'">'.$user[$i].'</a>', $string);
            } 
        }
        
        return $string;
    }
    
    /**
     * Find hashtag and replace with clickable link
     * 
     * @param   string $string
     * @return  string filtered string
     */
    protected function _searchHashTagUrl($string)
    {
        $m = preg_match_all('/#([A-Za-z]+[A-Z0-9a-z]+)/i', $string, $match);
        if ($m) { 
            $tag   = $match[0];
            $param = $match[1];
            for ($i=0; $i < $m; ++$i) { 
                $string = str_replace($tag[$i],'<a href="'.$this->view->url(array('tag' => $param[$i]), 'index-hashtag').'">'.$tag[$i].'</a>', $string);
            } 
        }
        
        return $string;
    }
}
