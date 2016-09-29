<?php
/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch\helper;


use CloudMunch\datamanager\CMDataManager;
use CloudMunch\AppContext;
use CloudMunch\loghandling\LogHandler;
use CloudMunch\datamanager\Server;
use Cloudmunch\CloudmunchConstants;



 
 /**
  * Class ServerHelper
  * This is a helper class to perform actions on server like providing methods to add ,read and update 
  * servers.
  * @package CloudMunch\helper
  * @author Rosmi
  */
 class ServerHelper{
 const APPLICATIONS="/applications/";
 
 /**
  *
  * @var CloudMunch\AppContext Reference to AppContext object.
  */
 private $appContext    = null;
 
 /**
  *
  * @var CloudMunch\datamanager\CMDataManager Reference to CMDataManager object.
  */
 private $cmDataManager = null;
 
 /**
  *
  * @var CloudMunch\loghandling\LogHandler Reference to LogHandler object.
  */
 private $logHelper     = null;

 /**
  * 
  * @param CloudMunch\AppContext $appContext
  * @param CloudMunch\loghandling\LogHandler $logHandler
  */
  public function __construct($appContext,$logHandler){
    $this->appContext = $appContext;
    $this->logHelper  = $logHandler;
    $this->cmDataManager = new CMDataManager($this->logHelper, $this->appContext);
    
 }
 
 /**
  * This method retreives the details of server from cloudmunch.
  * @param  string $servername Name of the server as registered in cloudmunch.
  * @return \CloudMunch\Server
  */
 function getServer($servername){
    $serverurl=$this->appContext->getMasterURL().static::APPLICATIONS.$this->appContext->getProject()."/assets/".$servername;

    $deployArray = $this->cmDataManager->getDataForContext($serverurl, $this->appContext->getAPIKey(),null);
    if($deployArray === false){
        return false;
    }
   
    $detailArray=$deployArray->data;
    
    
    
            
            
            $server=new Server();
           
           
            
            $server->setDNS($detailArray->dnsName);
           
            $server->setInstanceId($detailArray->instanceId);
            $server->setImageID($detailArray->amiID);
            $server->setLauncheduser($detailArray->username);
           
            $server->setAppName($detailArray->appName);
            $server->setDeployTempLoc($detailArray->deployTempLoc);
            
            $server->setPrivateKeyLoc($detailArray->privateKeyLoc);
            $server->setPublicKeyLoc($detailArray->publicKeyLoc);
            $server->setLoginUser($detailArray->loginUser);
            $server->setServerType($detailArray->serverType);
            $server->setAssettype($detailArray->assettype);
            $server->setStatus($detailArray->status);
            $server->setStarttime($detailArray->starttime);
            $server->setProvider($detailArray->provider);
            $server->setRegion($detailArray->region);
            $server->setCmserver($detailArray->cmserver);
            $server->setAssetname($detailArray->assetname);
            $server->setInstancesize($detailArray->instancesize);
            $server->setPassword($detailArray->password);
            $server->setSSHPort($detailArray->sshport);
            
           
            return $server;
        

    
 }
 
 
  /**
   * This method can be used to add or register a server to cloudmunch data .
   * @param \CloudMunch\Server $server
   * @param string $docker
   */
 function addServer($server,$serverstatus,$docker = false){
    
    if(empty($serverstatus)){
    	
        $this->logHelper->log (ERROR, "Server status need to be provided");
        return false;
    }
    $statusconArray=array(STATUS_RUNNING,STATUS_STOPPED,STATUS_NIL);
    if(!in_array ( $serverstatus ,$statusconArray )){
        $this->logHelper->log (ERROR, "Invalid status");
        return false;
    }
    
    
    
    $dataArray = array (
    
        
        "dnsName" => $server->getDNS(),
         "emailID" => $server->getEmailId(),
        "instanceId" => $server->getInstanceId(),
        "amiID" => $server->getImageID(),
        "username" => $server->getLauncheduser(),
         "appName" =>$server->getAppName(),
        "deployTempLoc" => $server->getDeployTempLoc(), 
         "privateKeyLoc" => $server->getPrivateKeyLoc(),
        "publicKeyLoc" => $server->getPublicKeyLoc(),
        "loginUser" => $server->getLoginUser(),
        "serverType" => $server->getServerType(),
        "type" => "server",
        "status" => $server->getStatus(),
        "starttime" => $server->getStarttime(),
        "provider" => $server->getProvider(),
        "region" => $server->getRegion(),
        "cmserver" => $server->getCmserver(),
        "instancesize" => $server->getInstancesize(),
        "password" => $server->getPassword(),
        "sshport" => $server->getSSHPort()
    );
   
    $dataArray[status]=$serverstatus;
    if($docker){
        $dataArray[projects] = array ($server->getAppName() => array ("buildNo" => $server->getBuild()));
    }


    $serverurl=$this->appContext->getMasterURL().static::APPLICATIONS.$this->appContext->getProject()."/assets/";
    $this->cmDataManager->putDataForContext($serverurl,$this->appContext->getAPIKey(),$dataArray);
 }
 
 /**
  * This method is used to update server data.
  * @param \CloudMunch\Server $server
  */
 function updateServer($server,$serverid){
    
    $dataArray = array (
    
            
        "dnsName" => $server->getDNS(),
        "emailID" => $server->getEmailId(),
         "instanceId" => $server->getInstanceId(),
        "amiID" => $server->getImageID(),
        "username" => $server->getLauncheduser(),
        "build" => $server->getBuild(),
        "appName" =>$server->getAppName(),
        "deployTempLoc" => $server->getDeployTempLoc(), 
    "buildLoc" => $server->getBuildLocation(),
        "privateKeyLoc" => $server->getPrivateKeyLoc(),
        "publicKeyLoc" => $server->getPublicKeyLoc(),
        "loginUser" => $server->getLoginUser(),
        "serverType" => $server->getServerType(),
        "type" => "server",
        "status" => $server->getStatus(),
        "starttime" => $server->getStarttime(),
        "provider" => $server->getProvider(),
        "region" => $server->getRegion(),
        "cmserver" => $server->getCmserver(),
        "instancesize" => $server->getInstancesize(),
        "password"=>$server->getPassword(),
        "sshport"=>$server->getSSHPort()
    );
    
    

    $serverurl=$this->appContext->getMasterURL().static::APPLICATIONS.$this->appContext->getProject()."/assets/".$serverid;
    
    return $this->cmDataManager->updateDataForContext($serverurl,$this->appContext->getAPIKey(),$dataArray);
    
 }
 
 /**
  * This method is to delete server from cloudmunch.
  * @param  $assetID Asset ID.
  */
 function deleteServer($assetID){
    $serverurl=$this->appContext->getMasterURL().static::APPLICATIONS.$this->appContext->getProject()."/assets/".$assetID;
    
    return $this->cmDataManager->deleteDataForContext($serverurl,$this->appContext->getAPIKey());
    
 }
 
 /**
  * This method checks if server exists or is registered in cloudmunch data.
  * @param  $servername Name of server.
  * @return boolean
  */
 function checkServerExists($servername){
    $serverurl=$this->appContext->getMasterURL().static::APPLICATIONS.$this->appContext->getProject()."/assets/".$servername;
    $deployArray = $this->cmDataManager->getDataForContext($serverurl, $this->appContext->getAPIKey(),"");
    if($deployArray === false){
        return false;
    }
    
    $detailArray=$deployArray->data;

    if ($detailArray == null) {
        return false;
    }else{
        return true;
    }

    
 }
 
/**
* Checks if server is up and running
*
* @param    string $dns      :   dns of target server 
* @param    number $sshport  :   ssh port to be used to check for connection
* @return   string Success  :   displays an appropriate message
*                  Failure  :   exits with a failure status with an appropriate message
*/
function checkConnect($dns,$sshport = 22) {
    $connectionTimeout = time();
    $connectionTimeout = $connectionTimeout + (10 * 10);

    do {
        if (($dns == null) || ($dns == '')) {
            $this->logHelper->log(ERROR, "Invalid dns" . $dns);
            return false;
        }

        $this->logHelper->log(INFO, "Checking connectivity to: " . $dns);

        $connection = ssh2_connect($dns, $sshport);
        if (!$connection) {
            sleep(10);
        }

    } while ((!$connection) && (time() < $connectionTimeout));

    if (!$connection) {
        $this->logHelper->log(ERROR, "Failed to connect to " . $dns);
        return false;
    }
}
 

 
 }
?>
