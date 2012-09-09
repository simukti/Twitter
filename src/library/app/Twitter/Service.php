<?php
/**
 * Description of Service
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Twitter_Service extends Zend_Service_Twitter
{
    /**
     * Predefined geolocation to spoof Twitter tweet's entity
     * 
     * @var array
     */
    static protected $_geoList = array(
        'fbd6d2f5a4e4a15e' => array(
            'lat'       => '37.422083',
            'long'      => '-122.084033',
            'place_id'  => 'fbd6d2f5a4e4a15e',
            'name'      => '---[DEFAULT]--- MountainView, CA - US'
        ),
        'cd450c94084cbf9b' => array(
            'lat'       => '42.361915',
            'long'      => '-71.090526',
            'place_id'  => 'cd450c94084cbf9b',
            'name'      => 'Massachusetts (W3C Center) - US'
        ),
        '5d838f7a011f4a2d' => array(
            'lat'       => '51.513657',
            'long'      => '-0.087249',
            'place_id'  => '5d838f7a011f4a2d',
            'name'      => 'City Of London - UK'
        ),
        '548c2b8e3921a85a' => array(
            'lat'       => '51.505965',
            'long'      => '-0.12775',
            'place_id'  => '548c2b8e3921a85a',
            'name'      => 'Westminster, London - UK'
        ),
        '378a442883b05c3c' => array(
            'lat'       => '45.398467',
            'long'      => '-73.998652',
            'place_id'  => '378a442883b05c3c',
            'name'      => 'Montreal - Canada'
        ),
        '22f084ff09bd68a1' => array(
            'lat'       => '53.34471',
            'long'      => '-6.270454',
            'place_id'  => '22f084ff09bd68a1',
            'name'      => 'Dublin - Ireland'
        ),
        '25ef8c689c302fa6' => array(
            'lat'       => '51.753682',
            'long'      => '-1.259873',
            'place_id'  => '25ef8c689c302fa6',
            'name'      => 'Oxford, Oxfordshire - UK'
        ),
        '83989e2decc1e863' => array(
            'lat'       => '59.91515',
            'long'      => '10.739901',
            'place_id'  => '83989e2decc1e863',
            'name'      => 'Oslo - Norway'
        ),
        'f6d6541b668771a7' => array(
            'lat'       => '45.463351',
            'long'      => '9.191519',
            'place_id'  => 'f6d6541b668771a7',
            'name'      => 'Milan - Italy'
        ),
        '30effa6edde47f6d' => array(
            'lat'       => '50.850743', 
            'long'      => '4.349831',
            'place_id'  => '30effa6edde47f6d',
            'name'      => 'Brussel - Belgium'
        ),
        'a56612250c754f23' => array(
            'lat'       => '35.689649', 
            'long'      => '139.693193',
            'place_id'  => 'a56612250c754f23',
            'name'      => 'Tokyo - Japan'
        )
    );
    
    /**
     * @see     \Zend_Http_Client::setConfig()
     * @var     array
     */
    protected $config = array(
        'maxredirects'    => 3,
        'strictredirects' => false,
        'useragent'       => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/15.0',
        'timeout'         => 30,
        'adapter'         => 'Zend_Http_Client_Adapter_Socket',
        'httpversion'     => Zend_Http_Client::HTTP_1,
        'keepalive'       => true,
        'storeresponse'   => true,
        'strict'          => true,
        'output_stream'   => false,
        'encodecookies'   => true,
        'rfc3986_strict'  => false
    );
    
    public function __construct($options = null, Zend_Oauth_Consumer $consumer = null)
    {
        parent::__construct($options, $consumer);
        /**
         * @see \Zend_Http_Client::setConfig() 
         */
        $this->getLocalHttpClient()->setConfig($this->config);
    }
    
    /**
     * @return   array
     */
    static public function getGeolist()
    {
        return self::$_geoList;
    }
    
    /**
     * Fully geo based tweet location ;) You can fake it :D
     * 
     * @param   string $status
     * @param   string $inReplyToStatusId
     * @param   string $placeId
     * @param   boolean $displayCoordinates
     * @return  \Zend_Rest_Client_Result
     * @throws  \Zend_Service_Twitter_Exception 
     */
    public function statusUpdate($status, $inReplyToStatusId = null, $placeId, $displayCoordinates = true)
    {
        $this->_init();
        $path = '/1/statuses/update.xml';
        $len = iconv_strlen(htmlspecialchars($status, ENT_QUOTES, 'UTF-8'), 'UTF-8');
        if ($len > self::STATUS_MAX_CHARACTERS) {
            throw new Zend_Service_Twitter_Exception(
                'Status must be no more than '
                . self::STATUS_MAX_CHARACTERS
                . ' characters in length'
            );
        } elseif (0 == $len) {
            throw new Zend_Service_Twitter_Exception(
                'Status must contain at least one character'
            );
        }
        $data = array('status' => $status);
        
        $location = self::$_geoList[$placeId];
        $data['lat']        = $location['lat'];
        $data['long']       = $location['long'];
        $data['place_id']   = $location['place_id'];
        
        $data['display_coordinates'] = $displayCoordinates ? '1' : '0';
        
        if (is_numeric($inReplyToStatusId) && !empty($inReplyToStatusId)) {
            $data['in_reply_to_status_id'] = $inReplyToStatusId;
        }
        
        $response = $this->_post($path, $data);
        return new Zend_Rest_Client_Result($response->getBody());
    }
    
}
