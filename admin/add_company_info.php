<?php
ob_start();
error_reporting(E_ALL);
require('header.php');
$xml=simplexml_load_file("xml/tiger.xml");

if ($_POST){
	//print_r($_POST);exit;
	$hidName = $_POST['hidName'];
	$companyname = mysql_real_escape_string($_POST['companyname']);
	$countryname = $_POST['country_name'];
	
	if(empty($companyname)){
			$error = 'Company Name cannot be left blank.';
			echo $error;
	}elseif(empty($countryname)){
			$error = 'Please select Country Name';
			echo $error;
	}

	if (empty($error)) {
		if(!empty($hidName)){
			$sql = "UPDATE tbl_company_name SET 
					companyName = '$companyname',
					companyCountry = '$countryname' 
					WHERE idCompanyName = '".$hidName."' ";

			$qry = mysql_query($sql);
			$param = 'edit';
			ob_end_clean();
			header('location:'.'list_company_name.php?'.$param);
		}else{
			$sql = "INSERT INTO tbl_company_name(companyName,companyCountry) VALUES ('$companyname',
				'$countryname')";
			$qry = mysql_query($sql);
			$param = 'new';
			ob_end_clean();
			header('location:'.'list_company_name.php?'.$param);
		}	
	}

}
?>
<div id="content-outer">
<!-- start content -->
<div id="content">

<div id="page-heading"><h1 class="infocar" style="text-align:center;">Add Company Information</h1></div>
<form name="companyForm" id="companyForm" action="add_company_name.php" method="POST">
	<input type="hidden" id="hidName" name="hidName" value="<?php if(isset($_GET['status'])) echo $_GET['id']; ?>"/>
<div id="wholeform">
<?php
$companyName = '';
$countryName = '';
if($_GET){
	if ($_GET['status'] == "edit") {
		
		$id = mysql_real_escape_string($_GET['id']);
		$sql = "SELECT * FROM `tbl_company_name` WHERE `idCompanyName` = '".$id."' ";
		$qry = mysql_query($sql);
		$row = mysql_fetch_array($qry);
		$companyName = $row['companyName'];
		$countryName = $row['companyCountry'];
	}
}	

	//Country Name Text Field
	$label = $xml->company[0]["label"];	
	$name = $xml->company[0]["name"];	
	$require = $xml->company[0]["require"];						
	create_textbox($label,$name,$require,$companyName,$numberonly='');
		
	//Country Select Field
	$label = $xml->country[0]["label"];
	$name = $xml->country[0]["name"];	
	$require = $xml->country[0]["require"];	
	$f_option="<option value='0'>Select Country Name</option>";		
	$option = $xml->country;
	$value = '';				
	create_selectbox($label,$name,$require,$f_option,$option,$countryName);
?>
<div class="clear"></div><br/><br/><br/><br/><br/><br/>
	<div class="field">				
		<div>
				<input type="submit" name="save" class="form-submit" value="<?php echo (isset($_GET))? 'Update':'Submit'; ?>" onclick="return validate_company_name();" />
				<input type="reset" value="" class="form-reset"  />
			</div>
	</div>
	
<div class="clear"></div>
</div>
</form>