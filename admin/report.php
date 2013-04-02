<?php
$toroot = '../';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/report.css">
<title>Report</title>
</head>

<body>
<?php include('header.php'); ?>

<div id="error_message" class="error"></div>
<div id="firstFilter">
    <div class="filter">
        Company Name	<?php
                $sql = "SELECT idCompanyName, companyName FROM tbl_company_name";
                $result = mysql_query($sql);
                        
                if( mysql_num_rows($result) > 0 ){
                ?>
                    <select name="cboCompanyName" id="cboCompanyName" class="" onchange="getBrand()">
                        <option value="">Select Brand</option>
                    <?php
                    while($rows = mysql_fetch_assoc($result)){
                        extract($rows);					
                    ?>
                        <option value="<?=$idCompanyName?>" <?php if($cboBrand == $idCompanyName){echo 'selected= "selected"';} ?>><?=$companyName?></option>
                    <?php
                    }
                    ?>
                    </select>
                <?php
                }
                ?>
    </div>            
    <div class="filter" id="brand">
        Brand  
        <select name="cboBrand" id="cboBrand" disabled="disabled" >
            <option value="">Select Brand</option>
        </select>
    </div>
    <div class="filter">
       Status	
            <select name="cboStatus" id="cboStatus" class="">
                <option value="">Select Status</option>				
                <option value="1" <?php if($cboStatus == 1){echo 'selected= "selected"';} ?>>Active</option>
                <option value="0" <?php if($cboStatus == 0){echo 'selected= "selected"';} ?>>Deactive</option>
            </select>
    </div>
</div>
<div class="clear"></div>
<div id="price">
	<div class="filter">
        Min. Price <input type="text" name="txtMinPrice" id="txtMinPrice" value="" onchange='return price_numbersonly(event);' onkeypress='return price_numbersonly(event);' onkeyup='return price_numbersonly(event);' />
    </div> 
    <div class="filter">  
        Max. Price <input type="text" name="txtMaxPrice" id="txtMaxPrice" value="" onchange='return price_numbersonly(event);' onkeypress='return price_numbersonly(event);' onkeyup='return price_numbersonly(event);' />
    </div>
</di>
<div class="clear"></div>
<div id="year">
	<div class="filter">
	Min. Year <input type="text" name="txtMinYear" id="txtMinYear" value="" onchange='return produceyear_numbersonly(event);' onkeypress='return produceyear_numbersonly(event);' onkeyup='return produceyear_numbersonly(event);' maxlength="4"/>
    </div>
    <div class="filter">
    Max. Year <input type="text" name="txtMaxYear" id="txtMaxYear" value="" onchange='return produceyear_numbersonly(event);' onkeypress='return produceyear_numbersonly(event);' onkeyup='return produceyear_numbersonly(event);' maxlength="4"/>
    </div>
</div>
<div class="clear"></div>
<div id="regDate">
	<div class="filter">
	<?php create_regDate('From','txtFromDate','txtFromDate','',''); ?>
    </div>
    <div class="filter">
	<?php create_regDate('To','txtToDate','txtToDate','','');?>
    </div>
</div>
<div class="clear">
<div class="buttonDiv">
<input type="button" name="btnReport" value="Report" onclick="getReport()" />
</div>
<div id="list">
</div>

</body>
</html>
<script type="text/javascript" language="javascript">
		
	function getBrand(){
		id = $("#cboCompanyName option:selected").val();		
		 if(id){
               $.ajax({
               type: 'get',
               url:'getBrand.php',
               data: { "id": id},
               success:brandList
               });
       }
	}
		
	function brandList(xhr) {		
		if( xhr != '' ) {
			$('#brand').html(xhr);
		}
	}
		
	function getReport() {		
		var error;
		var brand 		= $('#cboBrand').val(); 
		var cpnName		= $('#cboCompanyName').val();
		var status 		= $('#cboStatus').val();
		var minPrice 	= $('#txtMinPrice').val();
		var maxPrice 	= $('#txtMaxPrice').val();
		var minYear 	= $('#txtMinYear').val();
		var maxYear 	= $('#txtMaxYear').val();
		var fromDate	= $('#txtFromDate').val();
		var toDate		= $('#txtToDate').val();
									
		if( minPrice!='' && maxPrice != '' && minPrice > maxPrice ) { 
			$('#error_message').html('Min.Price cannot be greater than Max.Price');
			return 0;
		}
		
		if( minYear != '' && maxYear!='' && minYear > maxYear ) { 
			$('#error_message').html('Min.Year cannot be greater than Max.Year');
			return 0;
		}
			
		$.ajax({
		  type: "GET",
		  url: "getReports.php",
		  data: { 
		  		brand: brand, cpnName: cpnName, status: status, minPrice: !isNaN(minPrice)? minPrice:'', maxPrice:!isNaN(maxPrice)? maxPrice:'', minYear: !isNaN(minYear)? minYear:'', maxYear: !isNaN(maxYear)? maxYear:'', fromDate:fromDate, toDate:toDate, q:Math.random() },
		  success:displayList
		});
	}
	
	function displayList(xhr) {
		$('#list').html(xhr);
	}
	
	function isValidYear(year) {
		var intRegex = /^\d+$/;
		if( intRegex.test(year) && year.length ==4 ) {
		   return true;
		}else{
			return false;
		}		
	}
	
	function isValidPrice(value) {
		var priceRegex = /^(?!0\d)\d*(\.\d+)?$/;		
		if( priceRegex.test(value)) {
		   return true;
		}else{
			return false;
		}	
	}
	
</script>
