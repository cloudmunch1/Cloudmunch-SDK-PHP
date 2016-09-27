<?php
/**
 *  (c) CloudMunch Inc.
 *  All Rights Reserved
 *  Un-authorized copying of this file, via any medium is strictly prohibited
 *  Proprietary and confidential
 *
 *  Amith amith@cloudmunch.com, Sept-27-2016
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/AppContext.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/AppErrorLogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/loghandling/LogHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/ServerHelper.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/CMDataManager.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/datamanager/Server.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/NotificationHandler.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/CloudmunchService.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../src/CloudMunch/helper/InsightHelper.php';

use CloudMunch\helper\InsightHelper;
class InsightHelperTest extends PHPUnit_Framework_TestCase
{

	function __construct()
	{
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::__construct
	 */
	public function test_construct(){
		$insightHelper=new InsightHelper($this,$this);
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getResources
	 */
	public function test_getResources(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getResources("type");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getResources
	 */
	public function test_failure_getResources(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getResources(false);
		$this->expectOutputRegex("*Resource type is not provided*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStoreExtracts
	 */
	public function test_getInsightDataStoreExtracts(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStoreExtracts("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStoreExtracts
	 */
	public function test_failure_getInsightDataStoreExtracts(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStoreExtracts(null, "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStores
	 */
	public function test_getInsightDataStores(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStores("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStores
	 */
	public function test_failure_getInsightDataStores(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStores(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReportCards
	 */
	public function test_getInsightReportCards(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportCards("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReportCards
	 */
	public function test_failure_getInsightReportCards(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportCards(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReports
	 */
	public function test_getInsightReports(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReports("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReports
	 */
	public function test_failure_getInsightReports(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReports(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStoreExtractID
	 */
	public function test_getInsightDataStoreExtractID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStoreExtractID("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStoreExtractID
	 */
	public function test_failure_getInsightDataStoreExtractID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStoreExtractID(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStoreID
	 */
	public function test_getInsightDataStoreID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportCardID("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightDataStoreID
	 */
	public function test_failure_getInsightDataStoreID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightDataStoreID(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReportCardID
	 */
	public function test_getInsightReportCardID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportCardID("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReportCardID
	 */
	public function test_failure_getInsightReportCardID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportCardID(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReportID
	 */
	public function test_getInsightReportID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportID("insightID", "dataStoreID", "queryOptions");
		$this->expectOutputRegex("*getCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::getInsightReportID
	 */
	public function test_failure_getInsightReportID(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->getInsightReportID(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightDataStoreExtract
	 */
	public function test_updateInsightDataStoreExtract(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightDataStoreExtract("insightID", "dataStoreID", "queryOptions", "data");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightDataStoreExtract
	 */
	public function test_failure_updateInsightDataStoreExtract(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightDataStoreExtract(null);
		$this->expectOutputRegex("*is needed*");
	}


	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightDataStore
	 */
	public function test_updateInsightDataStore(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightDataStore("insightID", "dataStoreID", "queryOptions", "data");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightDataStore
	 */
	public function test_failure_updateInsightDataStore(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightDataStore(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightReport
	 */
	public function test_failure_updateInsightReport(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightReport(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightReport
	 */
	public function test_updateInsightReport(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightReport("insightID", "dataStoreID", "queryOptions", "data");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::updateInsightReportCard
	 */
	public function test_failure_updateInsightReportCard(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->updateInsightReportCard(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightDataStoreExtract
	 */
	public function test_createInsightDataStoreExtract(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightDataStoreExtract("insightID", "dataStoreID", "extractName");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightDataStoreExtract
	 */
	public function test_failure_createInsightDataStoreExtract(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightDataStoreExtract(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightDataStore
	 */
	public function test_createInsightDataStore(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightDataStore("insightID", "dataStoreID", "extractName");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightDataStore
	 */
	public function test_failure_createInsightDataStore(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightDataStore(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightReportCard
	 */
	public function test_createInsightReportCard(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightReportCard("insightID", "dataStoreID", "extractName");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightReportCard
	 */
	public function test_failure_createInsightReportCard(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightReportCard(null);
		$this->expectOutputRegex("*is needed*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::createInsightReport
	 */
	public function test_createInsightReport(){
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$insightHelper->createInsightReport("insightID", "dataStoreID", "extractName");
		$this->expectOutputRegex("*updateCustomContextData called*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::sprint_getDateRangeForAllSprints
	 */
	public function test_sprint_getDateRangeForAllSprints(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$this->returnData['jiraResource'] = array(0 => (object) array( 'key_fields' => (object) array( 'jiraProject' => 'jiraProject', 'rapidBoardId' => 'rapidBoardId', 'mvpVersion' => 'mvpVersion' ), 'id' => 'jiraid' ) );
		$this->returnData['jiraDatastore'] = array(0 => (object) array( 'id' => 'jiraid' ) );
		$this->returnData['jiraExtracts'] = array(0 => (object) array('id' => 'EXT2016071906015317590', 'name' => 42, 'data' => (object) array('sprints' => (object) array('type' => 'sprint', 'sprint_id' => '42', 'sprint_name' => 'Sprint 2', 'sequence' => '42', 'sprint_status' => 'ACTIVE', 'startDate' => '21/Apr/16 2:32 AM', 'endDate' => '25/Sep/16 2:32 AM', 'completeDate' => 'None') ) ) );
		$actual = $insightHelper->sprint_getDateRangeForAllSprints();
		$this->expectOutputRegex("*getCustomContextData*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::sprint_getSprintsWithDates
	 */
	public function test_sprint_getSprintsWithDates(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$data = array(0 => (object) array('id' => 'EXT2016071906015317590', 'name' => 42, 'data' => (object) array('sprints' => (object) array('type' => 'sprint', 'sprint_id' => '42', 'sprint_name' => 'Sprint 2', 'sequence' => '42', 'sprint_status' => 'ACTIVE', 'startDate' => '21/Apr/16 2:32 AM', 'endDate' => '25/Apr/16 2:32 AM', 'completeDate' => 'None') ) ) );
		$actual = $insightHelper->sprint_getSprintsWithDates($data);
		$expected = array ( 42 => array( 'id' => "42", 'name' => "Sprint 2", 'status' => 'ACTIVE', 'startDate' => '2016-04-21', 'endDate' => '2016-04-25', 'completeDate' => 'None'));
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::sprint_getSprintDetailsFromJiraCMDB
	 */
	public function test_sprint_getSprintDetailsFromJiraCMDB(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$this->returnData['jiraResource'] = array(0 => (object) array( 'key_fields' => (object) array( 'jiraProject' => 'jiraProject', 'rapidBoardId' => 'rapidBoardId', 'mvpVersion' => 'mvpVersion' ), 'id' => 'jiraid' ) );

		$insightHelper->sprint_getSprintDetailsFromJiraCMDB($data, 42);
		$this->expectOutputRegex("*getCustomContextData*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::sprint_getJiraProjectNameFromResource
	 */
	public function test_sprint_getJiraProjectNameFromResource(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$this->returnData['jiraResource'] = array(0 => (object) array( 'key_fields' => (object) array( 'jiraProject' => 'jiraProject', 'rapidBoardId' => 'rapidBoardId', 'mvpVersion' => 'mvpVersion' ), 'id' => 'jiraid' ) );

		$insightHelper->sprint_getJiraProjectNameFromResource("jira");
		$this->expectOutputRegex("*getCustomContextData*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::sprint_getJiraSprintsData
	 */
	public function test_sprint_getJiraSprintsData(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$this->returnData['jiraDatastore'] = array(0 => (object) array( 'id' => 'jiraid' ) );

		$insightHelper->sprint_getJiraSprintsData("insightOrResourceID", "dataStoreName", "extractName");
		$this->expectOutputRegex("*getCustomContextData*");
	}

	/**
	 * @covers CloudMunch\helper\InsightHelper::sprint_giveAFilterStringForASprint
	 * @covers CloudMunch\helper\InsightHelper::sprint_giveADateRangeOfASprint
	 */
	public function test_sprint_giveAFilterStringForASprint(){
		$insightHelper = new InsightHelper($this, $this);

		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

		$data = array ( 42 => array( 'id' => "42", 'name' => "Sprint 2", 'status' => 'ACTIVE', 'startDate' => '2016-04-21', 'endDate' => '2016-04-25', 'completeDate' => 'None'));
		$actual = $insightHelper->sprint_giveAFilterStringForASprint($data, 42);
		$expected = "IN (2016-04-22,2016-04-23,2016-04-24,2016-04-25)";
		$this->assertEquals($expected, $actual);
	}

    /**
	 * @covers CloudMunch\helper\InsightHelper::identifyDatesForDurationUnit
    */
    public function test_day_identifyDatesForDurationUnit()
    {
		$insightHelper = new InsightHelper($this, $this);
        $actual = $insightHelper->identifyDatesForDurationUnit("day", 1);
        $expected = "20";
        $this->assertContains($expected, $actual[0]);
    }
 
    /**
	 * @covers CloudMunch\helper\InsightHelper::identifyDatesForDurationUnit
    */
    public function test_week_identifyDatesForDurationUnit()
    {
		$insightHelper = new InsightHelper($this, $this);

        $actual = $insightHelper->identifyDatesForDurationUnit("week", 1);
        $expected = "20";
        $this->assertContains($expected, $actual[0]);
    }

    /**
	 * @covers CloudMunch\helper\InsightHelper::identifyDatesForDurationUnit
    */
    public function test_month_identifyDatesForDurationUnit()
    {
		$insightHelper = new InsightHelper($this, $this);

        $actual = $insightHelper->identifyDatesForDurationUnit("month", 1);
        $expected = "20";
        $this->assertContains($expected, $actual[0]);
    }

    /**
	 * @covers CloudMunch\helper\InsightHelper::getExtractData
    */
    public function test_day_getExtractData()
    {
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

        $insightHelper->getExtractData("resourceID", "dataStoreName", "name,result", "day", array("1"));
        $this->expectOutputRegex("*getCustomContextData*");
    }

   /**
	 * @covers CloudMunch\helper\InsightHelper::getExtractData
    */
    public function test_sprint_getExtractData()
    {
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);

        $insightHelper->getExtractData("resourceID", "dataStoreName", "name,result", "sprint", array("1"));
        $this->expectOutputRegex("*getCustomContextData*");
    }

   /**
	 * @covers CloudMunch\helper\InsightHelper::createLineGraph
	 * @covers CloudMunch\helper\InsightHelper::linegraph_constructViewcardVisualizationMeta
	 * @covers CloudMunch\helper\InsightHelper::linegraph_constructViewcardMeta
    */
    public function test_sprint_createLineGraph()
    {
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);
		$this->returnData = array(0 => (object) array( "id" => "id"));
        $insightHelper->createLineGraph("resourceID", array("dataFromCMDB"), "reportName", "cardTitle", "source", "description", "group", array("graphLegendsList"), "Date", "%", array("tolerance"), "#");
        $this->expectOutputRegex("*getCustomContextData*");
        $this->expectOutputRegex("*updateCustomContextData*");
    }

   /**
	 * @covers CloudMunch\helper\InsightHelper::createKanbanGraph
	 * @covers CloudMunch\helper\InsightHelper::kanban_constructViewcardVisualizationMeta
	 * @covers CloudMunch\helper\InsightHelper::kanban_constructViewcardMeta
    */
    public function test_createKanbanGraph()
    {
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);
		$this->returnData = array(0 => (object) array( "id" => "id"));
        $insightHelper->createKanbanGraph("resourceID", array("dataFromCMDB"), "reportName", "cardTitle", "source", "description", "group", array("tolerance"), "#");
        $this->expectOutputRegex("*getCustomContextData*");
        $this->expectOutputRegex("*updateCustomContextData*");
    }

   /**
	 * @covers CloudMunch\helper\InsightHelper::updateExtract
    */
    public function test_updateExtract()
    {
		$insightHelper = new InsightHelper($this, $this);
		$reflection = new ReflectionClass($insightHelper);
		$reflection_property = $reflection->getProperty(cmService);
		$reflection_property->setAccessible(true);
		$reflection_property->setValue($insightHelper, $this);
		$this->returnData = array(0 => (object) array( "id" => "id"));
        $insightHelper->updateExtract("resourceID", array("data"), "dataStoreName", "extractName", array("additionInfo"));
        $this->expectOutputRegex("*updateCustomContextData*");
    }

    /**
	 * @covers CloudMunch\helper\InsightHelper::checkToleranceForTrend
    */
    public function test_success_checkToleranceForTrend()
    {
		$insightHelper = new InsightHelper($this, $this);

		$data = array(0 => array( "label" => "firstelement", "day" => "1", "month" => "2"), 1 => array( "label" => "secondelement", "day" => "1", "month" => "2"));
        $actual = $insightHelper->checkToleranceForTrend($data, "90", "60", "resourceName", "cardLabel", "source");
        $expected = array("toleranceState" => "success");
        $this->assertArraySubset($expected, $actual);
    }

    /**
	 * @covers CloudMunch\helper\InsightHelper::checkToleranceForTrend
    */
    public function test_failure_checkToleranceForTrend()
    {
		$insightHelper = new InsightHelper($this, $this);

		$data = array(0 => array( "label" => "firstelement", "day" => "1", "month" => "2"), 1 => array( "label" => "secondelement", "day" => "3", "month" => "2"));
        $actual = $insightHelper->checkToleranceForTrend($data, "90", "60", "resourceName", "cardLabel", "source");
        $expected = array("toleranceState" => "critical");
        $this->assertArraySubset($expected, $actual);
    }

    /**
	 * @covers CloudMunch\helper\InsightHelper::checkToleranceForTrend
    */
    public function test_warning_checkToleranceForTrend()
    {
		$insightHelper = new InsightHelper($this, $this);

		$data = array(0 => array( "label" => "firstelement", "day" => "10", "month" => "2"), 1 => array( "label" => "secondelement", "day" => "17", "month" => "2"));
        $actual = $insightHelper->checkToleranceForTrend($data, "90", "60", "resourceName", "cardLabel", "source");
        $expected = array("toleranceState" => "warning");
        $this->assertArraySubset($expected, $actual);
    }

    /**
	 * @covers CloudMunch\helper\InsightHelper::checkToleranceForTrend
    */
    public function test_invalid_state_checkToleranceForTrend()
    {
		$insightHelper = new InsightHelper($this, $this);

		$data = array(0 => array( "label" => "firstelement"), 1 => array( "label" => "secondelement"));
        $insightHelper->checkToleranceForTrend($data, "90", "60", "resourceName", "cardLabel", "source");
        $actual = $insightHelper->checkToleranceForTrend("data", "90", "60", "resourceName", "cardLabel", "source");
        $expected = array("toleranceDescription" => "Tolerance was not configured or previous value is either 0 or non-existent.");
        $this->assertArraySubset($expected, $actual);
    }

	public function getCustomContextData($params, $queryOptions){
		echo "\n getCustomContextData called \n";
		if ($paramas && is_array($params) && $params['resources'] === "jiraid") {
			return  $this->returnData["jiraExtracts"];
		} elseif($queryOptions['filter']['type'] === 'jira' ){
			return $this->returnData['jiraResource'];
		}
		return $this->returnData;
	}

	public function updateCustomContextData(){
		echo "\n updateCustomContextData called \n";
		return $this->returnData;
	}

	public function getAPIKey(){
		echo "\n getAPIKey called \n";
	}

	public function getProject(){
		echo "\n getProject called \n";
	}

	public function getMasterURL(){
		echo "\n getMasterURL called \n";
	}

	public function log($msgType, $msg){
		echo $msg;
	}
}