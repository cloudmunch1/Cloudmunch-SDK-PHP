<?php

/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Rosmi Chandy rosmi@cloudmunch.com
 */
namespace CloudMunch;

/**
 * Class AppContext
 * This class is the Applictaion Context object that has all the environment variables needed
 *         for plugin runtime.
 * 
 * @package CloudMunch
 * @author Rosmi
 */
class AppContext {
	/**
	 * URL to cloudmunch service
	 * @var string 
	 *
	 */
    private $masterurl = "";
   
    
    /**
     * 
     * Domain of the current runtime.
     * @var string
     */
    private $domainName = "";
    
    /**
     * 
     * Current application name.
     *  @var string
     */
    private $project = "";
    
    /**
     * 
     * current task name.
     *  @var string
     */
    private $job = "";
    
    /**
     * 
     * Workspace location.
     *  @var string
     */
    private $workspaceLocation = "";
    
    /**
     * 
     * Archive location.
     *  @var string
     */
    private $archiveLocation = "";
    
    /**
     * 
     * Current step id.
     *  @var string
     */
    private $stepid = "";
    
    /**
     * 
     * Target server if selected to execute the job.
     *  @var string
     */
    private $targetServer="";
   
    /**
     * 
     * Report location.
     *  @var string
     */
    private $reportsLocation="";
    
    /**
     * 
     * Current job run number.
     *  @var string
     */
    private $runnumber="";
    
    /**
     * 
     * API key to connect to cloudmunch service.
     *  @var string
     */
    private $apikey="";
    
    /**
     * 
     * Current step name.
     *  @var string
     */
    private $stepname="";
    
    /**
     * 
     * ID of the environment in which job is executed.
     *  @var string
     */
    private $environmentId="";
    
    /**
     * 
     * Number of main build.
     *  @var string
     */
    private $mainbuildnumber="";
    
    /**
     * 
     * role/tier id
     *  @var string
     */
    private $tierid="";
    
    /**
     * 
     * Log level
     *  @var string
     */
    private $logLevel="INFO";
    
    
    /**
     * Get log level of the plugin runtime. Log level that can be either INFO,ERROR,DEBUG
     * @return string Log level
     */
    function getLogLevel(){
        return $this->logLevel;
    }
    
    
    /**
     * Set log level of plugin runtime.
     * @param string $logLevel Log level
     */
    function setLogLevel($logLevel = "INFO"){
         $this->logLevel = $logLevel;
    }
    
    
    /**
     * Get the main build number of the application.
     * @return string main build number
     */
    function getMainbuildnumber(){
        return $this->mainbuildnumber;
    }
    
    
    /**
     * Set the main build number of the application.
     * @param string $number main build number
     */
    function setMainbuildnumber($number){
         $this->mainbuildnumber=$number;
    }
    
    
    /**
     * Get the ID of the environment in which the plugin is getting executed.
     * @return string environment Id
     * 
     */
    function getEnvironment(){
        return $this->environmentId;
    }
    
    /**
     * Set the ID of the environment in which the plugin is getting executed.
     * @param string $env Environment ID
     */
    function setEnvironment($env){
         $this->environmentId=$env;
    }
    
    
    /**
     * Get the role/applictaion tier.
     * @return string tier/role id
     * 
     */
    function getTier(){
        return $this->tierid;
    }
    
    
   /**
    * Set role/applictaion tier.
    * @param string $tier tier/role id
    */
    function setTier($tier){
        $this->tierid=$tier;
    }
    
    
    /**
     * Get the step name.
     * @return string step name
     */
    function getStepName(){
        return $this->stepname;
    }
    
    /**
     * Set step name
     * @param string  $step Step name
     */
    function setStepName($step){
        $this->stepname=$step;
    }
    
    /**
     * Get workspace location of the job.
     * @return string workspace location
     */
    function getWorkSpaceLocation() {
        
        return $this->workspaceLocation;
    }
    
    /**
     * Set workspace location.
     * @param string $workspaceloc workspace location
     */
    function setWorkSpaceLocation($workspaceloc) {
        $this->workspaceLocation=$workspaceloc;
    }
    
    /**
     * Archive Location of the build.
     * @return string archive location
     */
    function getArchiveLocation() {
        return $this->archiveLocation;
    }
    
    /**
     * Set archive location of build.
     * @param string $archiveLoc archive location
     */
    function setArchiveLocation($archiveLoc) {
        $this->archiveLocation=$archiveLoc;
    }
    
    /**
     * Get ID of current step.
     * @return  string step id
     */
    function getStepID() {
        return $this->stepid;
    }
    
    /**
     * Set ID of current step.
     * @param string $stepid step id
     */
    function setStepID($stepid) {
        $this->stepid=$stepid;
    }
     /**
      * Set target server ,if selected for the job.
      * @param string $targetServer  target server
      */
    function setTargetServer($targetServer){
        $this->targetServer=$targetServer;
        
    }
    
    /**
     * Retrieve target server.
     * @return string target server
     */
    function getTargetServer(){
        return $this->targetServer;
    
    }
    /**
     * Get Cloudmunch service URL.
     * @return string Cloudmunch service URL
     */
    function getMasterURL() {
        return $this->masterurl;
    }
    
    
    /**
     * Set Cloudmunch service URL.
     * @param string $mURL  Cloudmunch service URL
     *          
     */
    function setMasterURL($mURL) {
        $this->masterurl = $mURL;
    }
    
   
    /**
     * Get domain name of current application.
     * @return string domain name
     */
    function getDomainName() {
        return $this->domainName;
    }
    
    /**
     * Set domain name of current application. 
     * @param string $dname  domain name
     *          
     */
    function setDomainName($dname) {
        $this->domainName = $dname;
    }
    
    /**
     * Get name of current application.
     * @return string project
     */
    function getProject() {
        return $this->project;
    }
    
    /**
     * Set name of current application.
     * @param string $proj project         
     */
    function setProject($proj) {
        $this->project = $proj;
    }
    
    /**
     * Get job name 
     * @return string job name
     */
    function getJob() {
        return $this->job;
    }
    
    /**
     * Set job name.
     * @param string $job job name          
     */
    function setJob($job) {
        $this->job = $job;
    }
    
    /**
     * Get report location.
     * @return string reports location
     */
    function getReportsLocation(){
        return $this->reportsLocation;
    }
    
    /**
     * Set report location.
     * @param string $reportLoc reports location
     */
    function setReportsLocation($reportLoc){
        $this->reportsLocation=$reportLoc;
    }
    
    /**
     * Get rum number of job.
     * @return string run number
     */
    function getRunNumber(){
        return $this->runnumber;
    }
    
    /**
     * Set rum number of job.
     * @param  string $runno run number
     */
    function setRunNumber($runno){
        $this->runnumber=$runno;
    }
    /**
     * Get API key to connect to cloudmunch.
     * @return string api key
     */
    function getAPIKey(){
        return $this->apikey;
    }
    
    /**
     * Set API key to connect to cloudmunch.
     * @param  string $ak api key
     */
    function setAPIKey($ak){
        $this->apikey=$ak;
    }
    
}
?>
