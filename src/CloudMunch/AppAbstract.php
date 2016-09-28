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


require_once ("CloudmunchConstants.php");
require_once ("loghandling/AppErrorLogHandler.php");
use CloudMunch\integrations\IntegrationDataHelper;
use CloudMunch\helper\AssetHelper;
use CloudMunch\helper\EnvironmentHelper;
use CloudMunch\helper\InsightHelper;
use CloudMunch\helper\IntegrationHelper;
use CloudMunch\helper\NotificationHandler;
use CloudMunch\helper\RoleHelper;
use CloudMunch\helper\ServerHelper;
use CloudMunch\loghandling\LogHandler;
use DateTime;

/**
 * Class AppAbstract
 * 
 * @package CloudMunch
 * @author Rosmi <rosmi@cloudmunch.com>
 *         An abstract base class for Cloudmunch App Object, providing methods to read parameters,
 *         create app context object and retreive service objects
 */
abstract class AppAbstract {
    /**
     * AppContext
     */
    private $appContext = null;
    
    /**
     * String containing input parameters.
     */
    private $parameterObject = null;
    
    /**
     * Strat time of the plugin execution.
     */
    private $stime = null;
    
    
    
    /**
     * 
     *  Cloudmunch Service object
     */
    private $cloudmunchService = null;
    
    /**
     * 
     * @var LogHandler object
     */
    private $logHandler =null;
    
    /**
     * This is an abstract method to be implemented by every plugin.
     * 
     * @param array $processparameters
     *          This array contains the two entries , appInput and integrationdetails
     *          
     */
    abstract function process($processparameters);
    
    /**
     * This method read and process the input parameters.
     */
    function getInput() {
        $argArray = $_SERVER ['argv'];
        
        for($i = 0; $i < sizeof ( $argArray ); $i ++) {
            
            switch ($argArray [$i]) {
                
                case "-jsoninput" :
                    {
                        
                        $jsonParameters = $argArray [$i + 1];
                        
                        continue;
                    }
                case "-variables" :
                    {
                        $variableParams = $argArray [$i + 1];
                        
                        
                    }
                
                case "-integrations" :
                    {
                        $integrations = $argArray [$i + 1];
                        
                        
                    }
                    default:
                        continue;
            }
        }
        
            $jsonParams = json_decode ( $jsonParameters );
            $varParams = json_decode ( $variableParams );
            $integrations = json_decode ( $integrations );
            $appContext = new AppContext ();
            
            $arg10 = '{master_url}';
            $masterurl = $varParams->$arg10;
            $appContext->setMasterURL ( $masterurl );
            
           
            $arg2 = '{domain}';
            $domainName = $varParams->$arg2;
            $appContext->setDomainName ( $domainName );
            
            $arg6 = '{application}';
            $projectId = $varParams->$arg6;
            $appContext->setProject ( $projectId );
            
            $arg6 = '{environment_id}';
            $envId = $varParams->$arg6;
            $appContext->setEnvironment ( $envId );
            
            
            $arg6 = '{ci_job_name}';
            $jobname = $varParams->$arg6;
            $appContext->setJob ( $jobname );
            
            $arg = "{workspace}";
            $workspace = $varParams->$arg;
            $appContext->setWorkSpaceLocation ( $workspace );
            
            $arg = "stepdetails";
            $stepDetails = $varParams->$arg;
            $stepDetails = json_decode ( $stepDetails );
            $appContext->setStepID ( $stepDetails->id );
            $appContext->setStepName($stepDetails->name);
            $appContext->setReportsLocation ( $stepDetails->reports_location );

            if($stepDetails->log_level){
                $appContext->setLogLevel($stepDetails->log_level);  
            } else {
                $appContext->setLogLevel("INFO");   
            }
            
            
                
            $apptier=$stepDetails->tier;
            $appContext->setTier($apptier);
            $arg = "{archive_location}";
            $archiveloc = $varParams->$arg;
            $appContext->setArchiveLocation ( $archiveloc );
            
            $arg = "{server}";
            $targetServer = $varParams->$arg;
            $appContext->setTargetServer ( $targetServer );
            
            $arg = "{run}";
            $run = $varParams->$arg;
            $appContext->setRunNumber ( $run );
            
            $arg = "{api_key}";
            $apikey = $varParams->$arg;
            $appContext->setAPIKey ( $apikey );
            
            $arg="target";
            if(empty($varParams->$arg)){
                $buildno = $run;
            }else{
            $buildno = $varParams->$arg->run_id;
            }
            $appContext->setMainbuildnumber($buildno);
            
            $this->setAppContext ( $appContext );
        
        $this->createLogHandler();
         $this->setParameterObject ( $jsonParams );
         return true;
    }
    
    /**
     * This function initializes log handler
     */
    function createLogHandler(){
        $this->logHandler=new LogHandler($this->appContext);
    }
    
    /**
     * This function returns the reference to log handler
     */
    function getLogHandler(){
        return $this->logHandler;
    }
    
    /**
     * This method sets the plugin context object that contains all environment variables.
     * 
     * @param
     *          AppContext appContext
     *          
     */
    function setAppContext($appContext) {
        $this->appContext = $appContext;
    }
    
    /**
     * This method returns the plugin context object that contains all environment context data of plugin execution.
     * 
     * @return AppContext appContext
     *
     */
    function getAppContext() {
        return $this->appContext;
    }
    
    /**
     * This method gives reference to ServerHelper,this helper class has all the methods to get/set data on
     * servers registered with cloudmunch.
     * 
     * @return ServerHelper serverhelper
     */
    function getCloudmunchServerHelper() {
        return new ServerHelper ( $this->appContext ,$this->logHandler);
        
    }

    /**
     * This method gives reference to EnvironmentHelper,this helper class has all the methods to get/set data on
     * assets registered with cloudmunch.
     * 
     * @return EnvironmentHelper environment helper
     */
    function getCloudmunchEnvironmentHelper() {
        return  new EnvironmentHelper ( $this->appContext,$this->logHandler );
        
    }


    /**
     * This method gives reference to EnvironmentHelper,this helper class has all the methods to get/set data on
     * assets registered with cloudmunch.
     * 
     * @return InsightHelper insight helper
     */
    function getCloudmunchInsightHelper() {
        return new InsightHelper ( $this->appContext,$this->logHandler );
        
    }

    /**
     * This method gives reference to RoleHelper,this helper class has all the methods to get/set data on
     * assets registered with cloudmunch.
     * 
     * @return RoleHelper environment helper
     */
    function getCloudmunchRoleHelper() {
        return new RoleHelper ( $this->appContext,$this->logHandler );
        
    }

    /**
     * This method gives reference to AssetHelper,this helper class has all the methods to get/set data on
     * assets registered with cloudmunch.
     * 
     * @return AssetHelper assethelper
     */
    function getCloudmunchAssetHelper() {
        return new AssetHelper ( $this->appContext,$this->logHandler );
        
    }
    
    
    /**
     * This method gives reference to IntegrationHelper,this helper class has all the methods to get/set data on
     * integrations registered with cloudmunch.
     *
     * @return IntegrationHelper integrationhelper
     */
    function getCloudmunchIntegrationHelper() {
        return new IntegrationHelper ( $this->appContext,$this->logHandler );
        
    }
    /**
     * This method returns reference to CloudmunchService,this helper class has all the methods to get/set data to cloudmunch service.
     * 
     * @return CloudmunchService
     */
    function getCloudmunchService() {
        if (is_null ( $this->cloudmunchService )) {
            $this->cloudmunchService = new CloudmunchService ( $this->appContext ,$this->logHandler);
        }
        
        return $this->cloudmunchService;
    }
    
    /**
     * This method returns reference to NotificationHandler,this helper class has methods to notify external communication tools
     * 
     * @return NotificationHandler
     */
    function getNotificationHandler() {
        return new NotificationHandler ( $this->appContext ,$this->logHandler);
        
    }

    /**
     * Set parameter object.
     * 
     * @param
     *          string params : String in json format ,containing plugin input.
     */
    function setParameterObject($params) {
        $this->parameterObject = $params;
    }
    
    /**
     * Get parameter object.
     * 
     * @return string parameterObject : String in json format ,containing plugin input.
     */
    function getParameterObject() {
        return $this->parameterObject;
    }
    
    /**
     * This is a lifecycle method that is invoked on the plugin to initialize itself with the incoming
     * data.
     */
    public function initialize() {
        date_default_timezone_set('UTC');
        $date_a = new DateTime ();
        $this->stime = $date_a;
        $this->getInput ();
    }
    
    /**
     * This is a lifecycle method to process input.
     * 
     * @return array processparameters : Array containing pluginiput parameters and integration details if any.
     */
    public function getProcessInput() {
        $cloudservice = null;
        
        $integrationHelper = new IntegrationDataHelper ($this->logHandler);
        
            if($this->getParameterObject()->providername){
                
                $this->logHandler->log ( INFO, "Getting integration" );
                $integrationService = $integrationHelper->getIntegrationData ($this->getCloudmunchService(), $this->getParameterObject ());
                if(is_null($integrationService)){
                    $this->logHandler->log ( INFO, "Retrieving integration failed" );
                }
            }       
        
        return array (
                "appInput" => $this->getParameterObject (),
                "integrationdetails" => $integrationService 
        );
        
    }
    
    /**
     * This is a lifecycle method invoked at the completion of the plugin to capture some data.
     */
    public function performAppcompletion() {
        $this->logHandler->log ( INFO, "Performing cleanup" );
        if (!(is_null ( $this->cloudmunchService ))) {
            $this->cloudmunchService->deleteKeys ();
        }
        $this->logHandler->log ( INFO, "App execution completed!" );
        $date_b = new DateTime ();
        $interval = date_diff ( $this->stime, $date_b );
        $this->logHandler->log( INFO, "Total time taken: " . $interval->format ( '%h:%i:%s' ) );
    }
    
    /**
     * This method outputs variables from the plugin
     * 
     * @param
     *          string variablename : Name of the variable to be output.
     * @param
     *          string variable : Value of the variable.
     */
    public function outputPipelineVariables($variablename, $variable) {
        // check if variable key is surrounded by {} and add if not present
        if (!preg_match('/^{.*}$/', $variablename)) {
            $variablename = "{".$variablename."}";
        }

        
            $fileloc = $this->appContext->getReportsLocation () . "/" . $this->appContext->getStepID () . ".out";
            $varlist = null;
            if(file_exists($fileloc)){
            $varlist = file_get_contents ( $fileloc );
            }
            if (($varlist == null) || (strlen ( $varlist ) == 0)) {
                $varlist = array (
                        $variablename => $variable 
                );
                $varlist = json_encode ( $varlist );
                file_put_contents ( $fileloc, $varlist );
            } else {
                $varlist = json_decode ( $varlist );
                $varlist->$variablename = $variable;
                $varlist = json_encode ( $varlist );
                file_put_contents ( $fileloc, $varlist );
            }
            
            $environment_id   = $this->getAppContext()->getEnvironment();

            // if current context is set with environment id, update the envirnonment as well
            if (isset($environment_id) && strlen($environment_id) > 0 && !preg_match('/^{environment_id}$/', $environment_id)) {
                $this->envHelper = $this->getCloudmunchEnvironmentHelper();
                $variablesArray  = array ( $variablename => $variable );
                $this->envHelper->updateVariables($environment_id, $variablesArray);
            }
        
        
    }

    /**
     * This method outputs variables from the plugin
     * 
     * @param
     *          array variablesArray : Array of key value pair for variables to be output
     *
     */
    public function outputPipelineVariablesArray($variablesArray) {
        // check if variable key is surrounded by {} and add if not present
        $tmp = array();
        foreach ($variablesArray as $key => $value) {
            if (!preg_match('/^{.+}$/', $key)) {
                $key = "{".$key."}";
            }
            $tmp[$key] = $value;                        
        }
        $variablesArray = $tmp;

        
            $fileloc = $this->appContext->getReportsLocation () . "/" . $this->appContext->getStepID () . ".out";
            $varlist = null;
            if(file_exists($fileloc)){
            $varlist = file_get_contents ( $fileloc );
            }
            if (($varlist == null) || (strlen ( $varlist ) == 0)) {
                $varlist = $variablesArray;
                $varlist = json_encode ( $varlist );
                file_put_contents ( $fileloc, $varlist );
            } else {
                $varlist = json_decode ( $varlist );
                foreach ($variablesArray as $key => $value) {
                    $varlist->$key = $value;                
                }
                $varlist = json_encode ( $varlist );
                file_put_contents ( $fileloc, $varlist );
            }

            $environment_id   = $this->getAppContext()->getEnvironment();

            // if current context is set with environment id, update the envirnonment as well
            if (isset($environment_id) && strlen($environment_id) > 0 && !preg_match('/^{environment_id}$/', $environment_id)) {
                $this->envHelper = $this->getCloudmunchEnvironmentHelper();
                $this->envHelper->updateVariables($environment_id, $variablesArray);
            }
        
        
    }
    /**
     * This is a lifecycle method invoked at the completion of the plugin.
     */
    public function __destruct(){
        $this->performAppcompletion();
    }
        
}
?>
