<?php
include ('helper/dbconnection.php');
$con = dbconnection();

if($_GET['id']) {
	$id = $_GET['id'];
	
	//$id = 1;
	
	$sql = "SELECT idCarsBrand,brandType FROM tbl_cars_brand WHERE idCompanyName = $id";
	$result = mysql_query($sql);
	if( mysql_num_rows($result) > 0 ){
	?>	
        Brand <select name="cboBrand" id="cboBrand" class="">
            <option value="">Select Brand</option>
        <?php
        while($rows = mysql_fetch_assoc($result)){
            extract($rows);
        ?>
            <option value="<?=$idCarsBrand?>" <?php if($cboBrand == $idCarsBrand){echo 'selected= "selected"';} ?>><?=$brandType?></option>
        <?php
        }
        ?>
        </select>
<?php	
	}else {
?>
	Brand  <select name="cboBrand" id="cboBrand" disabled="disabled" >
    			<option value="">Select Brand</option>
    	   </select>
<?php
	}
			
}
?>