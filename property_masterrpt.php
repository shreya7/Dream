<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start();
?>
<?php include_once "phprptinc/ewrcfg7.php" ?>
<?php include_once "phprptinc/ewmysql.php" ?>
<?php include_once "phprptinc/ewrfn7.php" ?>
<?php include_once "phprptinc/ewrusrfn.php" ?>
<?php include_once "property_masterrptinfo.php" ?>
<?php

//
// Page class
//

$property_master_rpt = NULL; // Initialize page object first

class crproperty_master_rpt extends crproperty_master {

	// Page ID
	var $PageID = 'rpt';

	// Project ID
	var $ProjectID = "{7DCFC25A-A9F5-4915-B588-B09AA42AD1A8}";

	// Page object name
	var $PageObjName = 'property_master_rpt';

	// Page name
	function PageName() {
		return ewr_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewr_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportPdfUrl;
	var $ReportTableClass;
	var $ReportTableStyle = "";

	// Custom export
	var $ExportPrintCustom = FALSE;
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EWR_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EWR_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EWR_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EWR_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ewr_AddMessage($_SESSION[EWR_SESSION_WARNING_MESSAGE], $v);
	}

		// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sMessage . "</div>";
			$_SESSION[EWR_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EWR_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EWR_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-error ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EWR_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog ewDisplayTable\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") // Header exists, display
			echo $sHeader;
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") // Fotoer exists, display
			echo $sFooter;
	}

	// Validate page request
	function IsPageRequest() {
		if ($this->UseTokenInUrl) {
			if (ewr_IsHttpPost())
				return ($this->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (property_master)
		if (!isset($GLOBALS["property_master"])) {
			$GLOBALS["property_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["property_master"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";

		// Page ID
		if (!defined("EWR_PAGE_ID"))
			define("EWR_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWR_TABLE_NAME"))
			define("EWR_TABLE_NAME", 'property_master', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		$conn = ewr_Connect();

		// Export options
		$this->ExportOptions = new crListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions = new crListOptions();
		$this->OtherOptions->Tag = "div";
		$this->OtherOptions->TagClassName = "ewOtherOption";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $giFcfChartCnt, $gsEmailContentType, $ReportLanguage, $Security;
		global $gsCustomExport;

		// Get export parameters
		if (@$_GET["export"] <> "")
			$this->Export = strtolower($_GET["export"]);
		elseif (@$_POST["export"] <> "")
			$this->Export = strtolower($_POST["export"]);
		$gsExport = $this->Export; // Get export parameter, used in header
		$gsExportFile = $this->TableVar; // Get export file, used in header
		$giFcfChartCnt = 0; // Get chart count, used in header
		$gsEmailContentType = @$_POST["contenttype"]; // Get email content type

		// Setup placeholder
		// Global Page Loading event (in userfn*.php)

		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Setup export options
		$this->SetupExportOptions();
	}

	// Set up export options
	function SetupExportOptions() {
		global $ReportLanguage;
		$exportid = session_id();

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("PrinterFriendlyText")) . "\" href=\"" . $this->ExportPrintUrl . "\">" . $ReportLanguage->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToExcelText")) . "\" href=\"" . $this->ExportExcelUrl . "\">" . $ReportLanguage->Phrase("ExportToExcel") . "</a>";
		$item->Visible = FALSE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToWordText")) . "\" href=\"" . $this->ExportWordUrl . "\">" . $ReportLanguage->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToPDFText")) . "\" href=\"" . $this->ExportPdfUrl . "\">" . $ReportLanguage->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Uncomment codes below to show export to Pdf link
//		$item->Visible = FALSE;
		// Export to Email

		$item = &$this->ExportOptions->Add("email");
		$url = $this->PageUrl() . "export=email";
		$item->Body = "<a data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ExportToEmailText")) . "\" id=\"emf_property_master\" href=\"javascript:void(0);\" onclick=\"ewr_EmailDialogShow({lnk:'emf_property_master',hdr:ewLanguage.Phrase('ExportToEmail'),url:'$url',exportid:'$exportid',el:this});\">" . $ReportLanguage->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseDropDownButton = FALSE;
		$this->ExportOptions->DropDownButtonPhrase = $ReportLanguage->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Reset filter
		$item = &$this->OtherOptions->Add("resetfilter");
		$item->Body = "<a title=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilterText")) . "\" data-caption=\"" . ewr_HtmlEncode($ReportLanguage->Phrase("ResetAllFilterText")) . "\" href=\"" . ewr_CurrentPage() . "?cmd=reset\">" . $ReportLanguage->Phrase("ResetAllFilter") . "</a>";
		$item->Visible = FALSE;

		// Button group for reset filter
		$this->OtherOptions->UseButtonGroup = FALSE;

		// Add group option item
		$item = &$this->OtherOptions->Add($this->OtherOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
		$this->SetupExportOptionsExt();

		// Hide options for export
		if ($this->Export <> "") {
			$this->ExportOptions->HideAllOptions();
			$this->OtherOptions->HideAllOptions();
		}

		// Set up table class
		if ($this->Export == "word" || $this->Export == "excel" || $this->Export == "pdf")
			$this->ReportTableClass = "ewTable";
		else
			$this->ReportTableClass = "ewTable ewTableSeparate";
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn, $ReportLanguage, $EWR_EXPORT, $gsExportFile;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		if ($this->Export <> "" && array_key_exists($this->Export, $EWR_EXPORT)) {
			$sContent = ob_get_contents();
			$fn = $EWR_EXPORT[$this->Export];
			if ($this->Export == "email") { // Email
				ob_end_clean();
				echo $this->$fn($sContent);
				$conn->Close(); // Close connection
				exit();
			} else {
				$this->$fn($sContent);
			}
		}

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWR_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	var $ExportOptions; // Export options
	var $OtherOptions; // Other options

	// Paging variables
	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $GrpCounter = array(); // Group counter
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $PageFirstGroupFilter = "";
	var $UserIDFilter = "";
	var $DrillDown = FALSE;
	var $DrillDownInPanel = FALSE;
	var $DrillDownList = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $PopupName = "";
	var $PopupValue = "";
	var $FilterApplied;
	var $SearchCommand = FALSE;
	var $ShowHeader;
	var $GrpFldCount = 0;
	var $SubGrpFldCount = 0;
	var $DtlFldCount = 0;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandCnt, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;
	var $GrandSummarySetup = FALSE;
	var $GrpIdx;

	//
	// Page main
	//
	function Page_Main() {
		global $rs;
		global $rsgrp;
		global $gsFormError;
		global $gbDrillDownInPanel;
		global $ReportBreadcrumb;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 13;
		$nGrps = 1;
		$this->Val = &ewr_InitArray($nDtls, 0);
		$this->Cnt = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = &ewr_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = &ewr_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandCnt = &ewr_InitArray($nDtls, 0);
		$this->GrandSmry = &ewr_InitArray($nDtls, 0);
		$this->GrandMn = &ewr_InitArray($nDtls, NULL);
		$this->GrandMx = &ewr_InitArray($nDtls, NULL);

		// Set up array if accumulation required: array(Accum, SkipNullOrZero)
		$this->Col = array(array(FALSE, FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE), array(FALSE,FALSE));

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Load custom filters
		$this->Page_FilterLoad();

		// Set up popup filter
		$this->SetupPopup();

		// Load group db values if necessary
		$this->LoadGroupDbValues();

		// Handle Ajax popup
		$this->ProcessAjaxPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewr_SetDebugMsg("popup filter: " . $sPopupFilter);
		ewr_AddFilter($this->Filter, $sPopupFilter);

		// No filter
		$this->FilterApplied = FALSE;

		// Call Page Selecting event
		$this->Page_Selecting($this->Filter);
		$this->OtherOptions->GetItem("resetfilter")->Visible = $this->FilterApplied;

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total count
		$sSql = ewr_BuildReportSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0 || $this->DrillDown) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGrps > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Hide all options if export
		if ($this->Export <> "") {
			$this->ExportOptions->HideAllOptions();
			$this->OtherOptions->HideAllOptions();
		}

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
		$this->SetupFieldCount();
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				if ($this->Col[$iy][0]) { // Accumulate required
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk)) {
						if (!$this->Col[$iy][1])
							$this->Cnt[$ix][$iy]++;
					} else {
						$accum = (!$this->Col[$iy][1] || !is_numeric($valwrk) || $valwrk <> 0);
						if ($accum) {
							$this->Cnt[$ix][$iy]++;
							if (is_numeric($valwrk)) {
								$this->Smry[$ix][$iy] += $valwrk;
								if (is_null($this->Mn[$ix][$iy])) {
									$this->Mn[$ix][$iy] = $valwrk;
									$this->Mx[$ix][$iy] = $valwrk;
								} else {
									if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
									if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
								}
							}
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy][0]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->TotCount++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy][0]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {
					if (!$this->Col[$iy][1])
						$this->GrandCnt[$iy]++;
				} else {
					if (!$this->Col[$iy][1] || $valwrk <> 0) {
						$this->GrandCnt[$iy]++;
						$this->GrandSmry[$iy] += $valwrk;
						if (is_null($this->GrandMn[$iy])) {
							$this->GrandMn[$iy] = $valwrk;
							$this->GrandMx[$iy] = $valwrk;
						} else {
							if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
							if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
						}
					}
				}
			}
		}
	}

	// Get count
	function GetCnt($sql) {
		global $conn;
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get rs
	function GetRs($sql, $start, $grps) {
		global $conn;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
			if ($this->GrpCount == 1) {
				$this->FirstRowData = array();
				$this->FirstRowData['PropertyId'] = ewr_Conv($rs->fields('PropertyId'),3);
				$this->FirstRowData['CategoryId'] = ewr_Conv($rs->fields('CategoryId'),3);
				$this->FirstRowData['CityName'] = ewr_Conv($rs->fields('CityName'),200);
				$this->FirstRowData['BrandName'] = ewr_Conv($rs->fields('BrandName'),200);
				$this->FirstRowData['ModelName'] = ewr_Conv($rs->fields('ModelName'),200);
				$this->FirstRowData['PropertyName'] = ewr_Conv($rs->fields('PropertyName'),200);
				$this->FirstRowData['PropertyImage'] = ewr_Conv($rs->fields('PropertyImage'),200);
				$this->FirstRowData['PropertyDesc'] = ewr_Conv($rs->fields('PropertyDesc'),200);
				$this->FirstRowData['PropertyAge'] = ewr_Conv($rs->fields('PropertyAge'),200);
				$this->FirstRowData['PropertyCost'] = ewr_Conv($rs->fields('PropertyCost'),4);
				$this->FirstRowData['Status'] = ewr_Conv($rs->fields('Status'),200);
				$this->FirstRowData['CustomerId'] = ewr_Conv($rs->fields('CustomerId'),3);
			}
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$this->PropertyId->setDbValue($rs->fields('PropertyId'));
			$this->CategoryId->setDbValue($rs->fields('CategoryId'));
			$this->CityName->setDbValue($rs->fields('CityName'));
			$this->BrandName->setDbValue($rs->fields('BrandName'));
			$this->ModelName->setDbValue($rs->fields('ModelName'));
			$this->PropertyName->setDbValue($rs->fields('PropertyName'));
			$this->PropertyImage->setDbValue($rs->fields('PropertyImage'));
			$this->PropertyDesc->setDbValue($rs->fields('PropertyDesc'));
			$this->PropertyAge->setDbValue($rs->fields('PropertyAge'));
			$this->PropertyCost->setDbValue($rs->fields('PropertyCost'));
			$this->Status->setDbValue($rs->fields('Status'));
			$this->CustomerId->setDbValue($rs->fields('CustomerId'));
			$this->Val[1] = $this->PropertyId->CurrentValue;
			$this->Val[2] = $this->CategoryId->CurrentValue;
			$this->Val[3] = $this->CityName->CurrentValue;
			$this->Val[4] = $this->BrandName->CurrentValue;
			$this->Val[5] = $this->ModelName->CurrentValue;
			$this->Val[6] = $this->PropertyName->CurrentValue;
			$this->Val[7] = $this->PropertyImage->CurrentValue;
			$this->Val[8] = $this->PropertyDesc->CurrentValue;
			$this->Val[9] = $this->PropertyAge->CurrentValue;
			$this->Val[10] = $this->PropertyCost->CurrentValue;
			$this->Val[11] = $this->Status->CurrentValue;
			$this->Val[12] = $this->CustomerId->CurrentValue;
		} else {
			$this->PropertyId->setDbValue("");
			$this->CategoryId->setDbValue("");
			$this->CityName->setDbValue("");
			$this->BrandName->setDbValue("");
			$this->ModelName->setDbValue("");
			$this->PropertyName->setDbValue("");
			$this->PropertyImage->setDbValue("");
			$this->PropertyDesc->setDbValue("");
			$this->PropertyAge->setDbValue("");
			$this->PropertyCost->setDbValue("");
			$this->Status->setDbValue("");
			$this->CustomerId->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWR_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWR_TABLE_START_GROUP];
			$this->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$this->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $this->getStartGroup();
			}
		} else {
			$this->StartGrp = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$this->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$this->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$this->setStartGroup($this->StartGrp);
		}
	}

	// Load group db values if necessary
	function LoadGroupDbValues() {
		global $conn;
	}

	// Process Ajax popup
	function ProcessAjaxPopup() {
		global $conn, $ReportLanguage;
		$fld = NULL;
		if (@$_GET["popup"] <> "") {
			$popupname = $_GET["popup"];

			// Check popup name
			// Output data as Json

			if (!is_null($fld)) {
				$jsdb = ewr_GetJsDb($fld, $fld->FldType);
				ob_end_clean();
				echo $jsdb;
				exit();
			}
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		if ($this->DrillDown)
			return;

		// Process post back form
		if (ewr_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewr_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWR_INIT_VALUE;
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewr_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewr_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$this->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		$sWrk = @$_GET[EWR_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // Display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$this->setStartGroup($this->StartGrp);
		} else {
			if ($this->getGroupPerPage() <> "") {
				$this->DisplayGrps = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	// Render row
	function RenderRow() {
		global $conn, $rs, $Security;
		if ($this->RowTotalType == EWR_ROWTOTAL_GRAND && !$this->GrandSummarySetup) { // Grand total
			$bGotCount = FALSE;
			$bGotSummary = FALSE;

			// Get total count from sql directly
			$sSql = ewr_BuildReportSql($this->SqlSelectCount(), $this->SqlWhere(), $this->SqlGroupBy(), $this->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
				$bGotCount = TRUE;
			} else {
				$this->TotCount = 0;
			}
		$bGotSummary = TRUE;

			// Accumulate grand summary from detail records
			if (!$bGotCount || !$bGotSummary) {
				$sSql = ewr_BuildReportSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(), $this->SqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
			$this->GrandSummarySetup = TRUE; // No need to set up again
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		//
		// Render view codes
		//

		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row

			// PropertyId
			$this->PropertyId->HrefValue = "";

			// CategoryId
			$this->CategoryId->HrefValue = "";

			// CityName
			$this->CityName->HrefValue = "";

			// BrandName
			$this->BrandName->HrefValue = "";

			// ModelName
			$this->ModelName->HrefValue = "";

			// PropertyName
			$this->PropertyName->HrefValue = "";

			// PropertyImage
			$this->PropertyImage->HrefValue = "";

			// PropertyDesc
			$this->PropertyDesc->HrefValue = "";

			// PropertyAge
			$this->PropertyAge->HrefValue = "";

			// PropertyCost
			$this->PropertyCost->HrefValue = "";

			// Status
			$this->Status->HrefValue = "";

			// CustomerId
			$this->CustomerId->HrefValue = "";
		} else {

			// PropertyId
			$this->PropertyId->ViewValue = $this->PropertyId->CurrentValue;
			$this->PropertyId->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CategoryId
			$this->CategoryId->ViewValue = $this->CategoryId->CurrentValue;
			$this->CategoryId->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CityName
			$this->CityName->ViewValue = $this->CityName->CurrentValue;
			$this->CityName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// BrandName
			$this->BrandName->ViewValue = $this->BrandName->CurrentValue;
			$this->BrandName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ModelName
			$this->ModelName->ViewValue = $this->ModelName->CurrentValue;
			$this->ModelName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PropertyName
			$this->PropertyName->ViewValue = $this->PropertyName->CurrentValue;
			$this->PropertyName->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PropertyImage
			$this->PropertyImage->ViewValue = $this->PropertyImage->CurrentValue;
			$this->PropertyImage->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PropertyDesc
			$this->PropertyDesc->ViewValue = $this->PropertyDesc->CurrentValue;
			$this->PropertyDesc->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PropertyAge
			$this->PropertyAge->ViewValue = $this->PropertyAge->CurrentValue;
			$this->PropertyAge->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PropertyCost
			$this->PropertyCost->ViewValue = $this->PropertyCost->CurrentValue;
			$this->PropertyCost->ViewValue = ewr_FormatNumber($this->PropertyCost->ViewValue, $this->PropertyCost->DefaultDecimalPrecision, -1, 0, 0);
			$this->PropertyCost->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// Status
			$this->Status->ViewValue = $this->Status->CurrentValue;
			$this->Status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CustomerId
			$this->CustomerId->ViewValue = $this->CustomerId->CurrentValue;
			$this->CustomerId->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PropertyId
			$this->PropertyId->HrefValue = "";

			// CategoryId
			$this->CategoryId->HrefValue = "";

			// CityName
			$this->CityName->HrefValue = "";

			// BrandName
			$this->BrandName->HrefValue = "";

			// ModelName
			$this->ModelName->HrefValue = "";

			// PropertyName
			$this->PropertyName->HrefValue = "";

			// PropertyImage
			$this->PropertyImage->HrefValue = "";

			// PropertyDesc
			$this->PropertyDesc->HrefValue = "";

			// PropertyAge
			$this->PropertyAge->HrefValue = "";

			// PropertyCost
			$this->PropertyCost->HrefValue = "";

			// Status
			$this->Status->HrefValue = "";

			// CustomerId
			$this->CustomerId->HrefValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == EWR_ROWTYPE_TOTAL) { // Summary row
		} else {

			// PropertyId
			$CurrentValue = $this->PropertyId->CurrentValue;
			$ViewValue = &$this->PropertyId->ViewValue;
			$ViewAttrs = &$this->PropertyId->ViewAttrs;
			$CellAttrs = &$this->PropertyId->CellAttrs;
			$HrefValue = &$this->PropertyId->HrefValue;
			$LinkAttrs = &$this->PropertyId->LinkAttrs;
			$this->Cell_Rendered($this->PropertyId, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CategoryId
			$CurrentValue = $this->CategoryId->CurrentValue;
			$ViewValue = &$this->CategoryId->ViewValue;
			$ViewAttrs = &$this->CategoryId->ViewAttrs;
			$CellAttrs = &$this->CategoryId->CellAttrs;
			$HrefValue = &$this->CategoryId->HrefValue;
			$LinkAttrs = &$this->CategoryId->LinkAttrs;
			$this->Cell_Rendered($this->CategoryId, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CityName
			$CurrentValue = $this->CityName->CurrentValue;
			$ViewValue = &$this->CityName->ViewValue;
			$ViewAttrs = &$this->CityName->ViewAttrs;
			$CellAttrs = &$this->CityName->CellAttrs;
			$HrefValue = &$this->CityName->HrefValue;
			$LinkAttrs = &$this->CityName->LinkAttrs;
			$this->Cell_Rendered($this->CityName, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// BrandName
			$CurrentValue = $this->BrandName->CurrentValue;
			$ViewValue = &$this->BrandName->ViewValue;
			$ViewAttrs = &$this->BrandName->ViewAttrs;
			$CellAttrs = &$this->BrandName->CellAttrs;
			$HrefValue = &$this->BrandName->HrefValue;
			$LinkAttrs = &$this->BrandName->LinkAttrs;
			$this->Cell_Rendered($this->BrandName, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// ModelName
			$CurrentValue = $this->ModelName->CurrentValue;
			$ViewValue = &$this->ModelName->ViewValue;
			$ViewAttrs = &$this->ModelName->ViewAttrs;
			$CellAttrs = &$this->ModelName->CellAttrs;
			$HrefValue = &$this->ModelName->HrefValue;
			$LinkAttrs = &$this->ModelName->LinkAttrs;
			$this->Cell_Rendered($this->ModelName, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// PropertyName
			$CurrentValue = $this->PropertyName->CurrentValue;
			$ViewValue = &$this->PropertyName->ViewValue;
			$ViewAttrs = &$this->PropertyName->ViewAttrs;
			$CellAttrs = &$this->PropertyName->CellAttrs;
			$HrefValue = &$this->PropertyName->HrefValue;
			$LinkAttrs = &$this->PropertyName->LinkAttrs;
			$this->Cell_Rendered($this->PropertyName, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// PropertyImage
			$CurrentValue = $this->PropertyImage->CurrentValue;
			$ViewValue = &$this->PropertyImage->ViewValue;
			$ViewAttrs = &$this->PropertyImage->ViewAttrs;
			$CellAttrs = &$this->PropertyImage->CellAttrs;
			$HrefValue = &$this->PropertyImage->HrefValue;
			$LinkAttrs = &$this->PropertyImage->LinkAttrs;
			$this->Cell_Rendered($this->PropertyImage, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// PropertyDesc
			$CurrentValue = $this->PropertyDesc->CurrentValue;
			$ViewValue = &$this->PropertyDesc->ViewValue;
			$ViewAttrs = &$this->PropertyDesc->ViewAttrs;
			$CellAttrs = &$this->PropertyDesc->CellAttrs;
			$HrefValue = &$this->PropertyDesc->HrefValue;
			$LinkAttrs = &$this->PropertyDesc->LinkAttrs;
			$this->Cell_Rendered($this->PropertyDesc, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// PropertyAge
			$CurrentValue = $this->PropertyAge->CurrentValue;
			$ViewValue = &$this->PropertyAge->ViewValue;
			$ViewAttrs = &$this->PropertyAge->ViewAttrs;
			$CellAttrs = &$this->PropertyAge->CellAttrs;
			$HrefValue = &$this->PropertyAge->HrefValue;
			$LinkAttrs = &$this->PropertyAge->LinkAttrs;
			$this->Cell_Rendered($this->PropertyAge, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// PropertyCost
			$CurrentValue = $this->PropertyCost->CurrentValue;
			$ViewValue = &$this->PropertyCost->ViewValue;
			$ViewAttrs = &$this->PropertyCost->ViewAttrs;
			$CellAttrs = &$this->PropertyCost->CellAttrs;
			$HrefValue = &$this->PropertyCost->HrefValue;
			$LinkAttrs = &$this->PropertyCost->LinkAttrs;
			$this->Cell_Rendered($this->PropertyCost, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// Status
			$CurrentValue = $this->Status->CurrentValue;
			$ViewValue = &$this->Status->ViewValue;
			$ViewAttrs = &$this->Status->ViewAttrs;
			$CellAttrs = &$this->Status->CellAttrs;
			$HrefValue = &$this->Status->HrefValue;
			$LinkAttrs = &$this->Status->LinkAttrs;
			$this->Cell_Rendered($this->Status, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);

			// CustomerId
			$CurrentValue = $this->CustomerId->CurrentValue;
			$ViewValue = &$this->CustomerId->ViewValue;
			$ViewAttrs = &$this->CustomerId->ViewAttrs;
			$CellAttrs = &$this->CustomerId->CellAttrs;
			$HrefValue = &$this->CustomerId->HrefValue;
			$LinkAttrs = &$this->CustomerId->LinkAttrs;
			$this->Cell_Rendered($this->CustomerId, $CurrentValue, $ViewValue, $ViewAttrs, $CellAttrs, $HrefValue, $LinkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->SetupFieldCount();
	}

	// Setup field count
	function SetupFieldCount() {
		$this->GrpFldCount = 0;
		$this->SubGrpFldCount = 0;
		$this->DtlFldCount = 0;
		if ($this->PropertyId->Visible) $this->DtlFldCount += 1;
		if ($this->CategoryId->Visible) $this->DtlFldCount += 1;
		if ($this->CityName->Visible) $this->DtlFldCount += 1;
		if ($this->BrandName->Visible) $this->DtlFldCount += 1;
		if ($this->ModelName->Visible) $this->DtlFldCount += 1;
		if ($this->PropertyName->Visible) $this->DtlFldCount += 1;
		if ($this->PropertyImage->Visible) $this->DtlFldCount += 1;
		if ($this->PropertyDesc->Visible) $this->DtlFldCount += 1;
		if ($this->PropertyAge->Visible) $this->DtlFldCount += 1;
		if ($this->PropertyCost->Visible) $this->DtlFldCount += 1;
		if ($this->Status->Visible) $this->DtlFldCount += 1;
		if ($this->CustomerId->Visible) $this->DtlFldCount += 1;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $ReportBreadcrumb;
		$ReportBreadcrumb = new crBreadcrumb();
		$url = ewr_CurrentUrl();
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$ReportBreadcrumb->Add("rpt", $this->TableVar, $url, $this->TableVar, TRUE);
	}

	function SetupExportOptionsExt() {
		global $ReportLanguage;
	}

	// Return popup filter
	function GetPopupFilter() {
		$sWrk = "";
		if ($this->DrillDown)
			return "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWR_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		if ($this->DrillDown)
			return "";

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$this->setOrderBy("");
				$this->setStartGroup(1);
				$this->PropertyId->setSort("");
				$this->CategoryId->setSort("");
				$this->CityName->setSort("");
				$this->BrandName->setSort("");
				$this->ModelName->setSort("");
				$this->PropertyName->setSort("");
				$this->PropertyImage->setSort("");
				$this->PropertyDesc->setSort("");
				$this->PropertyAge->setSort("");
				$this->PropertyCost->setSort("");
				$this->Status->setSort("");
				$this->CustomerId->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$this->CurrentOrder = ewr_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $this->SortSql();
			$this->setOrderBy($sSortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
	}

	// Export to WORD
	function ExportWord($html) {
		global $gsExportFile;
		header('Content-Type: application/vnd.ms-word' . (EWR_CHARSET <> '' ? ';charset=' . EWR_CHARSET : ''));
		header('Content-Disposition: attachment; filename=' . $gsExportFile . '.doc');
		echo $html;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ewr_Header(FALSE) ?>
<?php

// Create page object
if (!isset($property_master_rpt)) $property_master_rpt = new crproperty_master_rpt();
if (isset($Page)) $OldPage = $Page;
$Page = &$property_master_rpt;

// Page init
$Page->Page_Init();

// Page main
$Page->Page_Main();

// Global Page Rendering event (in ewrusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php include_once "phprptinc/header.php" ?>
<?php if ($Page->Export == "") { ?>
<script type="text/javascript">

// Create page object
var property_master_rpt = new ewr_Page("property_master_rpt");

// Page properties
property_master_rpt.PageID = "rpt"; // Page ID
var EWR_PAGE_ID = property_master_rpt.PageID;

// Extend page with Chart_Rendering function
property_master_rpt.Chart_Rendering = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }

// Extend page with Chart_Rendered function
property_master_rpt.Chart_Rendered = 
 function(chart, chartid) { // DO NOT CHANGE THIS LINE!

 	//alert(chartid);
 }
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($Page->Export == "") { ?>
<!-- container (begin) -->
<div id="ewContainer">
<!-- top container (begin) -->
<div id="ewTop">
<a id="top"></a>
<?php } ?>
<!-- top slot -->
<?php if ($Page->Export == "" && (!$Page->DrillDown || !$Page->DrillDownInPanel)) { ?>
<?php if ($ReportBreadcrumb) $ReportBreadcrumb->Render(); ?>
<?php } ?>
<div class="ewReportOptions">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->Render("body");
	$Page->OtherOptions->Render("body");
}
?>
</div>
<?php $Page->ShowPageHeader(); ?>
<?php $Page->ShowMessage(); ?>
<?php if ($Page->Export == "") { ?>
</div>
<!-- top container (end) -->
	<!-- left container (begin) -->
	<div id="ewLeft" class="pull-left">
<?php } ?>
	<!-- Left slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- left container (end) -->
	<!-- center container - report (begin) -->
	<div id="ewCenter" class="pull-left">
<?php } ?>
	<!-- center slot -->
<!-- summary report starts -->
<div id="report_summary">
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGrp = $Page->TotalGrps;
} else {
	$Page->StopGrp = $Page->StartGrp + $Page->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGrp) > intval($Page->TotalGrps))
	$Page->StopGrp = $Page->TotalGrps;
$Page->RecCount = 0;

// Get first row
if ($Page->TotalGrps > 0) {
	$Page->GetRow(1);
	$Page->GrpCount = 1;
}
$Page->GrpIdx = ewr_InitArray(2, -1);
$Page->GrpIdx[0] = -1;
$Page->GrpIdx[1] = $Page->StopGrp - $Page->StartGrp + 1;
while ($rs && !$rs->EOF && $Page->GrpCount <= $Page->DisplayGrps || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<table class="ewGrid"<?php echo $Page->ReportTableStyle ?>><tr>
	<td class="ewGridContent">
<!-- Report grid (begin) -->
<div class="ewGridMiddlePanel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($Page->PropertyId->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PropertyId"><div class="property_master_PropertyId"><span class="ewTableHeaderCaption"><?php echo $Page->PropertyId->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PropertyId">
<?php if ($Page->SortUrl($Page->PropertyId) == "") { ?>
		<div class="ewTableHeaderBtn property_master_PropertyId">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyId->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_PropertyId" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->PropertyId) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyId->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->PropertyId->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->PropertyId->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CategoryId->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CategoryId"><div class="property_master_CategoryId"><span class="ewTableHeaderCaption"><?php echo $Page->CategoryId->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CategoryId">
<?php if ($Page->SortUrl($Page->CategoryId) == "") { ?>
		<div class="ewTableHeaderBtn property_master_CategoryId">
			<span class="ewTableHeaderCaption"><?php echo $Page->CategoryId->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_CategoryId" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CategoryId) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CategoryId->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CategoryId->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CategoryId->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CityName->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CityName"><div class="property_master_CityName"><span class="ewTableHeaderCaption"><?php echo $Page->CityName->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CityName">
<?php if ($Page->SortUrl($Page->CityName) == "") { ?>
		<div class="ewTableHeaderBtn property_master_CityName">
			<span class="ewTableHeaderCaption"><?php echo $Page->CityName->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_CityName" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CityName) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CityName->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CityName->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CityName->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->BrandName->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="BrandName"><div class="property_master_BrandName"><span class="ewTableHeaderCaption"><?php echo $Page->BrandName->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="BrandName">
<?php if ($Page->SortUrl($Page->BrandName) == "") { ?>
		<div class="ewTableHeaderBtn property_master_BrandName">
			<span class="ewTableHeaderCaption"><?php echo $Page->BrandName->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_BrandName" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->BrandName) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->BrandName->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->BrandName->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->BrandName->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->ModelName->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="ModelName"><div class="property_master_ModelName"><span class="ewTableHeaderCaption"><?php echo $Page->ModelName->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="ModelName">
<?php if ($Page->SortUrl($Page->ModelName) == "") { ?>
		<div class="ewTableHeaderBtn property_master_ModelName">
			<span class="ewTableHeaderCaption"><?php echo $Page->ModelName->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_ModelName" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->ModelName) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->ModelName->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->ModelName->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->ModelName->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PropertyName->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PropertyName"><div class="property_master_PropertyName"><span class="ewTableHeaderCaption"><?php echo $Page->PropertyName->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PropertyName">
<?php if ($Page->SortUrl($Page->PropertyName) == "") { ?>
		<div class="ewTableHeaderBtn property_master_PropertyName">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyName->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_PropertyName" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->PropertyName) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyName->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->PropertyName->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->PropertyName->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PropertyImage->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PropertyImage"><div class="property_master_PropertyImage"><span class="ewTableHeaderCaption"><?php echo $Page->PropertyImage->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PropertyImage">
<?php if ($Page->SortUrl($Page->PropertyImage) == "") { ?>
		<div class="ewTableHeaderBtn property_master_PropertyImage">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyImage->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_PropertyImage" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->PropertyImage) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyImage->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->PropertyImage->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->PropertyImage->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PropertyDesc->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PropertyDesc"><div class="property_master_PropertyDesc"><span class="ewTableHeaderCaption"><?php echo $Page->PropertyDesc->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PropertyDesc">
<?php if ($Page->SortUrl($Page->PropertyDesc) == "") { ?>
		<div class="ewTableHeaderBtn property_master_PropertyDesc">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyDesc->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_PropertyDesc" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->PropertyDesc) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyDesc->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->PropertyDesc->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->PropertyDesc->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PropertyAge->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PropertyAge"><div class="property_master_PropertyAge"><span class="ewTableHeaderCaption"><?php echo $Page->PropertyAge->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PropertyAge">
<?php if ($Page->SortUrl($Page->PropertyAge) == "") { ?>
		<div class="ewTableHeaderBtn property_master_PropertyAge">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyAge->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_PropertyAge" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->PropertyAge) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyAge->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->PropertyAge->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->PropertyAge->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->PropertyCost->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="PropertyCost"><div class="property_master_PropertyCost"><span class="ewTableHeaderCaption"><?php echo $Page->PropertyCost->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="PropertyCost">
<?php if ($Page->SortUrl($Page->PropertyCost) == "") { ?>
		<div class="ewTableHeaderBtn property_master_PropertyCost">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyCost->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_PropertyCost" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->PropertyCost) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->PropertyCost->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->PropertyCost->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->PropertyCost->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Status->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Status"><div class="property_master_Status"><span class="ewTableHeaderCaption"><?php echo $Page->Status->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Status">
<?php if ($Page->SortUrl($Page->Status) == "") { ?>
		<div class="ewTableHeaderBtn property_master_Status">
			<span class="ewTableHeaderCaption"><?php echo $Page->Status->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_Status" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->Status) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->Status->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->Status->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->Status->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->CustomerId->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="CustomerId"><div class="property_master_CustomerId"><span class="ewTableHeaderCaption"><?php echo $Page->CustomerId->FldCaption() ?></span></div></td>
<?php } else { ?>
	<td data-field="CustomerId">
<?php if ($Page->SortUrl($Page->CustomerId) == "") { ?>
		<div class="ewTableHeaderBtn property_master_CustomerId">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerId->FldCaption() ?></span>
		</div>
<?php } else { ?>
		<div class="ewTableHeaderBtn ewPointer property_master_CustomerId" onclick="ewr_Sort(event,'<?php echo $Page->SortUrl($Page->CustomerId) ?>',0);">
			<span class="ewTableHeaderCaption"><?php echo $Page->CustomerId->FldCaption() ?></span>
			<span class="ewTableHeaderSort"><?php if ($Page->CustomerId->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Page->CustomerId->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGrps == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecCount++;

		// Render detail row
		$Page->ResetAttrs();
		$Page->RowType = EWR_ROWTYPE_DETAIL;
		$Page->RenderRow();
?>
	<tr<?php echo $Page->RowAttributes(); ?>>
<?php if ($Page->PropertyId->Visible) { ?>
		<td data-field="PropertyId"<?php echo $Page->PropertyId->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_PropertyId"<?php echo $Page->PropertyId->ViewAttributes() ?>><?php echo $Page->PropertyId->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->CategoryId->Visible) { ?>
		<td data-field="CategoryId"<?php echo $Page->CategoryId->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_CategoryId"<?php echo $Page->CategoryId->ViewAttributes() ?>><?php echo $Page->CategoryId->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->CityName->Visible) { ?>
		<td data-field="CityName"<?php echo $Page->CityName->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_CityName"<?php echo $Page->CityName->ViewAttributes() ?>><?php echo $Page->CityName->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->BrandName->Visible) { ?>
		<td data-field="BrandName"<?php echo $Page->BrandName->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_BrandName"<?php echo $Page->BrandName->ViewAttributes() ?>><?php echo $Page->BrandName->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->ModelName->Visible) { ?>
		<td data-field="ModelName"<?php echo $Page->ModelName->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_ModelName"<?php echo $Page->ModelName->ViewAttributes() ?>><?php echo $Page->ModelName->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PropertyName->Visible) { ?>
		<td data-field="PropertyName"<?php echo $Page->PropertyName->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_PropertyName"<?php echo $Page->PropertyName->ViewAttributes() ?>><?php echo $Page->PropertyName->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PropertyImage->Visible) { ?>
		<td data-field="PropertyImage"<?php echo $Page->PropertyImage->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_PropertyImage"<?php echo $Page->PropertyImage->ViewAttributes() ?>><?php echo $Page->PropertyImage->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PropertyDesc->Visible) { ?>
		<td data-field="PropertyDesc"<?php echo $Page->PropertyDesc->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_PropertyDesc"<?php echo $Page->PropertyDesc->ViewAttributes() ?>><?php echo $Page->PropertyDesc->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PropertyAge->Visible) { ?>
		<td data-field="PropertyAge"<?php echo $Page->PropertyAge->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_PropertyAge"<?php echo $Page->PropertyAge->ViewAttributes() ?>><?php echo $Page->PropertyAge->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->PropertyCost->Visible) { ?>
		<td data-field="PropertyCost"<?php echo $Page->PropertyCost->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_PropertyCost"<?php echo $Page->PropertyCost->ViewAttributes() ?>><?php echo $Page->PropertyCost->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Status->Visible) { ?>
		<td data-field="Status"<?php echo $Page->Status->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_Status"<?php echo $Page->Status->ViewAttributes() ?>><?php echo $Page->Status->ListViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->CustomerId->Visible) { ?>
		<td data-field="CustomerId"<?php echo $Page->CustomerId->CellAttributes() ?>>
<span data-class="tpx1_<?php echo $Page->RecCount ?>_property_master_CustomerId"<?php echo $Page->CustomerId->ViewAttributes() ?>><?php echo $Page->CustomerId->ListViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->AccumulateSummary();

		// Get next record
		$Page->GetRow(2);
	$Page->GrpCount++;
} // End while
?>
<?php if ($Page->TotalGrps > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader) { // No header displayed ?>
<table class="ewGrid"<?php echo $Page->ReportTableStyle ?>><tr>
	<td class="ewGridContent">
<!-- Report grid (begin) -->
<div class="ewGridMiddlePanel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGrps > 0)) { ?>
<div class="ewGridLowerPanel">
<?php include "property_masterrptpager.php" ?>
</div>
<?php } ?>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- center container - report (end) -->
	<!-- right container (begin) -->
	<div id="ewRight" class="pull-left">
<?php } ?>
	<!-- Right slot -->
<?php if ($Page->Export == "") { ?>
	</div>
	<!-- right container (end) -->
<div class="clearfix"></div>
<!-- bottom container (begin) -->
<div id="ewBottom">
<?php } ?>
	<!-- Bottom slot -->
<?php if ($Page->Export == "") { ?>
	</div>
<!-- Bottom Container (End) -->
</div>
<!-- Table Container (End) -->
<?php } ?>
<?php $Page->ShowPageFooter(); ?>
<?php if (EWR_DEBUG_ENABLED) echo ewr_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown) { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "phprptinc/footer.php" ?>
<?php
$Page->Page_Terminate();
if (isset($OldPage)) $Page = $OldPage;
?>
