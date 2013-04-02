<?php
ob_start();
error_reporting(E_ALL);
require('header.php');
$xml=simplexml_load_file("xml/tiger.xml");

if ($_POST){
	//echo'<pre>';print_r($_POST);echo '</pre>';exit;
	$hidName = $_POST['hidName'];
	$companyname = $_POST['companyname'];
	$brandtype = mysql_real_escape_string($_POST['brandtype']);
		
	if(empty($brandtype)){
			$error = 'Brand Type cannot be left blank.';
			echo '$error';
	}elseif(empty($companyname)){
			$error = 'Please select Company Name';
	}

	if (empty($error)) {
		if(!empty($hidName)){
			$sql = "UPDATE tbl_cars_brand SET 
					idCompanyName = '$companyname',
					brandType = '$brandtype' 
					WHERE idCarsBrand = '".$hidName."' ";
			///echo $sql;exit;
			$qry = mysql_query($sql);
			$param = 'edit';
			ob_end_clean();
			header('location:'.'list_brand_info.php?'.$param);
		}else{
			$sql = "INSERT INTO tbl_cars_brand(idCompanyName,brandType) VALUES ('$companyname',
				'$brandtype')";
			$qry = mysql_query($sql);
			$param = 'new';
			ob_end_clean();
			header('location:'.'list_brand_info.php?'.$param);
		}
	}	
}


?>
<div id="content-outer">
<!-- start content -->
<div id="content">

<?php 
/*if($msg!='' || $msg!=null){
	echo "<h3>".$msg."<h3>";
}*/
?>
<div id="page-heading"><h1 class="infocar" style="text-align:center;">Add Car Brand Information</h1></div>
<form name="brandForm" id="brandForm" action="add_brand_info.php" method="POST">
	<input type="hidden" id="hidName" name="hidName" value="<?php if(isset($_GET['status'])) echo $_GET['id']; ?>"/>
<div id="wholeform">
<?php
$companyName = '';
$countryName = '';
$brandName = '';
if($_GET){
	if ($_GET['status'] == "edit") {
		
		$id = mysql_real_escape_string($_GET['id']);
		$sql = "SELECT * FROM `tbl_cars_brand` WHERE `idCarsBrand` = '".$id."' ";
		$qry = mysql_query($sql);
		$row = mysql_fetch_array($qry);
		$companyId = $row['idCompanyName'];
		$brandName = $row['brandType'];
		$companyNameQry = mysql_query("SELECT * FROM tbl_company_name WHERE idCompanyName = $companyId");
		$companyNameResult = mysql_fetch_array($companyNameQry);
		$companyName = $companyNameResult['companyName'];
		
	}
}	
?>
<label>Company Name </label>
<select name="companyname">
	<option value="0">Select Company Name</option>
	<?php
	$companySql = "SELECT idCompanyName,companyName FROM tbl_company_name";
	$companyQry = mysql_query($companySql);
	while ($result = mysql_fetch_array($companyQry)) {

	?>
	<option value="<?php echo $companyId; ?>" <?php echo ($result['companyName'] == $companyName)?'selected="selected"' : ''; ?>><?php echo $result['companyName']; ?></option>
<?php
}
?>
</select>
<?php
	//Brand Text Field
	$label = $xml->brand[0]["label"];	
	$name = $xml->brand[0]["name"];	
	$require = $xml->brand[0]["require"];
							
	create_textbox($label,$name,$require,$brandName,$numberonly='');
?>
<div class="clear"></div><br/><br/><br/><br/><br/><br/>
	<div class="field">				
		<div>
				<input type="submit" name="save" class="form-submit" onclick="return validate_brand_name();" />
				<input type="reset" value="" class="form-reset"/>
		</div>
	</div>			
<div class="clear"></div>
</div>	
</form>
