<?php
/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch\datamanager;


/**
 * Class Server
 * This class is to create server object ,that holds the data about a server.
 * @author rosmi
 * @package CloudMunch\datamanager
 *
 */
class Server{
    
    
    /**
     * 
     * @var string DNS name
     */
    private $dns="";
    
   
    
    /**
     * 
     * @var string email id
     */
    private $emailID="";
    
   
    private $deploymentStatus="";
    private $instanceId="";
    private $imageID="";
    private $launcheduser="";
    
    private $appName="";
    private $deployTempLoc="";
    private $buildLocation="";
    private $privateKeyLoc="";
    private $publicKeyLoc="";
    private $loginUser="";
    private $serverType="";
    private $assettype="";
    private $status="";
    private $starttime="";
    private $provider="";
    private $region="";
    private $cmserver="";
    private $assetname="";
    private $instancesize="";
   
    private $password=null;
    private $sshport=22;
   
    
   
    
    function getSSHPort(){
        return $this->sshport;
    }

    function setSSHPort($port){
        $this->sshport=$port;
    }

    
    
    /**
     * Get public DNS of the server
     */
    function getDNS(){
        return $this->dns;
    }
    /**
     * @param string public DNS of server
     */
    function setDNS($dns){
        $this->dns=$dns;
        
    }
   
   
    
    function getInstanceId(){
        return $this->instanceId;
    }
    function setInstanceId($instid){
        $this->instanceId=$instid;
    }
    function getImageID(){
    return $this->imageID;  
    }
    function setImageID($imageid){
        $this->imageID=$imageid;
    }
    function getLauncheduser(){
        return $this->launcheduser;
    }
    function setLauncheduser($luser){
        $this->launcheduser=$luser;
    }
   
    function getAppName(){
        return $this->appName;
    }
    function setAppName($appn){
        $this->appName=$appn;
    }
    function getDeployTempLoc(){
        return $this->deployTempLoc;
    }
    function setDeployTempLoc($deptemp){
        $this->deployTempLoc=$deptemp;
    }
    function getBuildLocation(){
        return $this->buildLocation;
        
    }
    function setBuildLocation($bloc){
        $this->buildLocation=$bloc;
        
    }
    function getPrivateKeyLoc(){
        return $this->privateKeyLoc;
    }
    function setPrivateKeyLoc($pkey){
        $this->privateKeyLoc=$pkey;
    }
    function getPublicKeyLoc(){
        return $this->publicKeyLoc;
    }
    function setPublicKeyLoc($ploc){
        $this->publicKeyLoc=$ploc;
        
    }
    function getLoginUser(){
        return $this->loginUser;
    }
    function setLoginUser($luser){
        $this->loginUser=$luser;
    }
    function getServerType(){
        return $this->serverType;
    }
    function setServerType($stype){
         $this->serverType=$stype;
        
    }
    function getAssettype(){
        return $this->assettype;
    }
    function setAssettype($atype){
        $this->assettype=$atype;
    }
    function getStatus(){
        return $this->status;
    }
    function setStatus($status){
         $this->status=$status;
    }
    function getStarttime(){
        return $this->starttime;
    }
    function setStarttime($stime){
        $this->starttime=$stime;
    }
    function getProvider(){
        return $this->provider;
    }
    function setProvider($provider){
        $this->provider=$provider;
    }
    function getRegion(){
        return $this->region;
    }
    function setRegion($region){
        $this->region=$region;
    }
    function getCmserver(){
        return $this->cmserver;
    }
    function setCmserver($cmserver){
        $this->cmserver=$cmserver;
    }
    function getAssetname(){
        return $this->assetname;
    }
    function setAssetname($aname){
        $this->assetname=$aname;
    }
    function getInstancesize(){
        return $this->instancesize;
    }
    function setInstancesize($isize){
        $this->instancesize=$isize;
    }
    function getEmailID(){
        return $this->emailID;
    }
    function setEmailID($eid){
        $this->emailID=$eid;
    }
    function getPassword(){
        return $this->password;
    }
    function setPassword($eid){
        $this->password=$eid;
    }
    
}
    
?>
