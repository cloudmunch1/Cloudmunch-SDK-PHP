<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Amith Kumar amith@cloudmunch.com
 */
namespace CloudMunch\helper;

use CloudMunch\datamanager\CMDataManager;
use CloudMunch\AppContext;
use CloudMunch\loghandling\LogHandler;
use Cloudmunch\CloudmunchConstants;
/**
 * Class NotificationHandler
 * This class provides the service methods for the apps to send notifications  on cloudmunch
 * @package CloudMunch
 * @author Rosmi
 *         
 */
class NotificationHandler {
	/**
	 *
	 * @var CloudMunch\AppContext Reference to AppContext object.
	 */
    private $appContext = null;
    
    /**
     *
     * @var CloudMunch\datamanager\CMDataManager Reference to CMDataManager object.
     */
    private $cmDataManager;
    
    /**
     *
     * @var CloudMunch\loghandling\LogHandler Reference to LogHandler object.
     */
    private $logHelper=null;
    
    
    
    public function __construct($logHandler, $appContext, $cmDataManager = null) {
        $this->appContext = $appContext;
        $this->logHelper  = $logHandler;
        if (is_null($cmDataManager)) {
            $cmDataManager = new cmDataManager ($this->logHelper, $this->appContext, $this);
        }
        $this->cmDataManager = $cmDataManager;
    }

    /**
     * Send notification to a selected channel on slack
     * 
     * @param string $message
     *          : Notification message.
     * @param string $status
     *          : Status level of message : ERROR/WARNING/INFO
     * @param string $channel
     *          : Channel to send notification
     * @param string $to
     *          : To address to be notified
     * @param string $from
     *          : From user
     */
    public function sendSlackNotification($message, $status = "ERROR", $channel = "support", $from = null, $to = null) {
        if(is_null($message) || empty($message)){
            $this->logHelper->log ( ERROR, "Message is mandatory to send a notification!" );
            return false;
        }
        $dataArray = array (
            "message" => $message,
            "channel" => $channel,
            "status" => $status 
        );

        if (!is_null($from)){
            $dataArray["from"] = $from;
        }

        if (!is_null($to)) {
            $dataArray["to"] = $to;
        }

        return $this->cmDataManager->sendNotification ( $this->appContext->getMasterURL (), $this->appContext->getAPIKey(), $dataArray );
    }
}
?>
