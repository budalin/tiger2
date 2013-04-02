<?php 
ob_start();
include 'header.php'; 

if ($_POST){
$brandType = $_POST['brandtype'];
$VIN = $_POST['VIN'];
$produceYear = $_POST['produceyear'];
$price = $_POST['price'];
$currency_unit = $_POST['curunit'];
$numberofDoor =$_POST['door'];
$numberSeat = $_POST['seat'];
$features = $_POST['features'];
$extColor = $_POST['extcolor'];
$interColor = $_POST['intercolor'];
$usageStatus = $_POST['usage'];
$sellingStatus = $_POST['selling'];
$fuelType = $_POST['fueltype'];
$fuelTank = $_POST['fueltank'];
$usedMile = $_POST['usedmile'];
$steering = $_POST['streeting'];
$enginepower = $_POST['enginepower'];
$transmission = $_POST['transmission'];
$vehicletype = $_POST['vehicletype'];
$description = $_POST['description'];
$regDate=explode("-",$_POST['testdate']);
$datefull=$regDate[2].'-'.$regDate[1].'-'.$regDate[0];	
//echo $regDate;

$query = mysql_query("Insert into tbl_car_info (idCarsBrand,VIN,produceYear,price,currency_unit,numberofdoor,numberSeat,
			  features,exteriorColor,interiorColor,usagesStatus,sellingStatus,fuelType,fuelTank,usedMile,steering,enginepower,transmission,vehicletype,description,regdate) values ('$brandType','$VIN',
			  '$produceYear','$price','$currency_unit','$numberofDoor','$numberSeat','$features','$extColor','$interColor','$usageStatus','$sellingStatus','$fuelType','$fuelTank','$usedMile','$steering','$enginepower','$transmission','$vehicletype','$description','$datefull')"
			  ) ;
			  
              if($query){
			  ob_end_clean();
                    header("Location: list_info_car.php?savmsg=Your information is successfully added.");
				   
               }
			   else
			   {
                   echo mysql_error()."query error";
                    	
               }

}

?>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">

<?php 
/*if($msg!='' || $msg!=null){
	echo "<h3>".$msg."<h3>";
}*/
?>
<div id="page-heading"><h1 class="infocar" style="text-align:center;">Add Car Information</h1></div>

<form name="carForm" id="carForm" action="add_info_car.php" method="POST">

		<div id="wholeform" >
			<?php	
/*** Start Brand Type ***/	
				$label = $xml->brandType[0]["label"];
				$name = $xml->brandType[0]["name"];	
				$require = $xml->brandType[0]["require"];			
				$option = $xml->brandType->option[0];	
				//$value =$id_cars_brand;		
				create_brandType($label,$name,$require,$option,$value);
			
//End Brand Type	

/*** Start VIN ***/	
				$label = $xml->VIN[0]["label"];	
				$name = $xml->VIN[0]["name"];
				//$value=	$VIN;
				$require = $xml->VIN[0]["require"];	
				$numberonly ="";					
				create_textbox($label,$name,$require,$value,$numberonly);
//End VIN
	
/*** Start Produce Year ***/	
				$label = $xml->produceYear[0]["label"];	
				$name = $xml->produceYear[0]["name"];	
				$require = $xml->produceYear[0]["require"];	
				//$value =$produceYear;
				$numberonly = "onchange='return produceyear_numbersonly(event);' onkeypress='return produceyear_numbersonly(event);' onkeyup='return produceyear_numbersonly(event);'";					
				create_textbox($label,$name,$require,$value,$numberonly);
				
//End Produce Year		


/*** Start Price ***/			
				$label = $xml->price[0]["label"];
				$p_name = $xml->price[0]["name"];				
				$c_name = $xml->currency[0]["name"];
				$p_require = $xml->price[0]["require"];
				$c_require = $xml->currency[0]["require"];
				$c_option= $xml->currency;
				//$p_value=$price;
				//$c_value=$currency_unit;
				
				$numberonly = "onchange='return price_numbersonly(event);' onkeypress='return price_numbersonly(event);' onkeyup='return price_numbersonly(event);'";
				create_pricetextbox($label,$p_name,$c_name,$p_require,$c_require,$c_option,$p_value,$c_value,$numberonly);

//End Price

/*** No. of Door ***/
				$label = $xml->door[0]["label"];
				$name = $xml->door[0]["name"];	
				$require = $xml->door[0]["require"];
				$numberonly ="";
				//$value=$door;
				create_textbox($label,$name,$require,$value,$numberonly);

// End No. of Door

/*** No. of Seat **/
				$label = $xml->seat[0]["label"];
				$name = $xml->seat[0]["name"];					
				$require = $xml->seat[0]["require"];
				$numberonly ="";		
				//$value=$seat;				
				create_textbox($label,$name,$require,$value,$numberonly);

//End No. of Seat

/*** Interior Color ***/
				$label = $xml->intercolor[0]["label"];	
				$name = $xml->intercolor[0]["name"];
				$require = $xml->intercolor[0]["require"];
				$numberonly ="";
				//$value=$interColor;									
				create_textbox($label,$name,$require,$value,$numberonly);
				
//End Interior Color

/*** Exterior Color ***/
				$label = $xml->extcolor[0]["label"];
				$name = $xml->extcolor[0]["name"];	
				$require = $xml->extcolor[0]["require"];
				$numberonly ="";							
				//$value= $extColor;
				create_textbox($label,$name,$require,$value,$numberonly);
				
//End Exterior Color

/*** Fuel Type ***/
				$label = $xml->fuelType[0]["label"];
				$name = $xml->fuelType[0]["name"];	
				$require = $xml->fuelType[0]["require"];
				$f_option = "<option value='0'>Select Fuel Type</option>";
				$option = $xml->fuelType;	
				//$value=$fuelType;			
				create_selectbox($label,$name,$require,$f_option,$option,$value);
				
//End Fuel Type

/*** Fuel Tank ***/
				$label = $xml->fuelTank[0]["label"];	
				$name = $xml->fuelTank[0]["name"];	
				$require = $xml->fuelTank[0]["require"];
				//$value=$fuelTank;						
				create_textbox($label,$name,$require,$value,$numberonly);
				
//End Fuel Tank

/*** Transmission ***/
				$label = $xml->transimission[0]["label"];
				$name = $xml->transimission[0]["name"];	
				$require = $xml->transimission[0]["require"];
				$f_option="<option value='0'>Select Transmission</option>";
				$option = $xml->transimission;			
				//$value=$transmission;	
				create_selectbox($label,$name,$require,$f_option,$option,$value);
				
//End Transmission

/*** Used Mile ***/
				$label = $xml->usedMile[0]["label"];	
				$name = $xml->usedMile[0]["name"];
				$require = $xml->usedMile[0]["require"];	
				$numberonly ="";		
				//$value=$usedMile;				
				create_textbox($label,$name,$require,$value,$numberonly);
				
//End Used Mile

/*** Engine Power ***/
				$label = $xml->enginepower[0]["label"];	
				$name = $xml->enginepower[0]["name"];
				$require = $xml->enginepower[0]["require"];	
				$numberonly ="";			
				//$value=$enginepower;			
				create_textbox($label,$name,$require,$value,$numberonly);
				
//End Engine Power

/*** selling status ***/
				$label = $xml->selling[0]["label"];
				$name = $xml->selling[0]["name"];
				$require = $xml->selling[0]["require"];
				$f_option = "<option value='0'>Select Selling Status</option>";				
				$option = $xml->selling;		
				//$value=$sellingStatus;		
				create_selectbox($label,$name,$require,$f_option,$option,$value);
				
//End selling status

/*** Usage status ***/
				$label = $xml->usage[0]["label"];
				$name = $xml->usage[0]["name"];	
				$require = $xml->usage[0]["require"];	
				$f_option="<option value='0'>Select Usage Status</option>";
				$option = $xml->usage;		
				//$value=$usageStatus;		
				create_selectbox($label,$name,$require,$f_option,$option,$value);
				
//End Usage status

/*** Vehicle Type ***/
				$label = $xml->vehicleType[0]["label"];
				$name = $xml->vehicleType[0]["name"];
				$require = $xml->vehicleType[0]["require"];	
				$f_option="<option value='0'>Select Vehicle Type</option>";			
				$option = $xml->vehicleType;
				//$value=$vehicletype;				
				create_selectbox($label,$name,$require,$f_option,$option,$value);
				
//End Vehicle Type

/*** Streeting ***/
		$label = $xml->steering[0]["label"];
		$name = $xml->steering[0]["name"];	
		$require = $xml->steering[0]["require"];	
		$f_option="<option value='0'>Select Streeting</option>";		
		$option = $xml->steering;		
		//$value= $steering;		
		create_selectbox($label,$name,$require,$f_option,$option,$value);
				
//End Streeting

/*** Registration Date ***/
  		$label = $xml->regDate[0]["label"];
		$name = $xml->regDate[0]["name"];
		$id =$xml->regDate[0]["id"];
		$require = $xml->regDate[0]["require"];	
		//$value=$regDate;					
		create_regDate($label,$name,$id,$require,$value);

//End Registration Date


/*** Featuers ***/
		$label = $xml->features[0]["label"];
		$name = $xml->features[0]["name"];
		$require = $xml->features[0]["require"];		
		//$value=$features;				
		create_textbox($label,$name,$require,$value,$numberonly);
//End Features

/*** Description ***/
		$label = $xml->description[0]["label"];
		$name = $xml->description[0]["name"];
		$require = $xml->description[0]["require"];	
		//$value=$description;					
		create_description($label,$name,$require,$value);
//Description

?>	
<div class="clear"></div><br/><br/><br/><br/><br/><br/>
	<div class="field">
	
		 <div>
				<input type="submit" name="save" class="form-submit" onclick="return validate_info_car();" />
				<input type="reset" value="" class="form-reset"  />
		</div>
	
	</div>			
<div class="clear"></div>
</div>	
</form>
		
	
<!--  end content-outer -->
<?php

include 'footer.php';

?>
 

