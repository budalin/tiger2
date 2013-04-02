<?php
include ('helper/dbconnection.php');
$con = dbconnection();

# root
$toroot = '';

$brand 			= $_GET['brand'];
$cpnName		= $_GET['cpnName'];
$minPrice 		= $_GET['minPrice'];
$maxPrice 		= $_GET['maxPrice'];
$minYear 		= $_GET['minYear'];
$maxYear 		= $_GET['maxYear'];
$status 		= $_GET['status'];
$fromDate		= $_GET['fromDate'];
$toDate 		= $_GET['toDate'];

# Query
$sql = "SELECT ci.*,cb.brandType FROM tbl_car_info AS ci
		LEFT JOIN tbl_cars_brand AS cb USING (idCarsBrand)
		LEFT JOIN tbl_company_name AS cn USING (idCompanyName)
		WHERE 1 ";
		
if($cpnName) {
	$sql .= "AND idCompanyName = $cpnName";
}
		
if($brand){
	$sql .= " AND idCarsBrand = $brand";
}
if($minPrice){
	$sql .= " AND price >= $minPrice";
}
if($maxPrice){
	$sql .= " AND price <= $maxPrice";
}

if($minYear){
	$sql .= " AND produceYear >= $minYear ";
}

if($maxYear){
	$sql .= " AND produceYear <= $maxYear ";
}

if(isset($status)){
	$sql .= " AND ci.status = $status ";
}

if(!empty($fromDate)){
	$sql .= " AND regDate >= \"$fromDate\"";
}

if(!empty($toDate)) {
	$sql .= " AND regDate <= \"$toDate\"";
}

//echo $sql; 
//$sql = "SELECT * FROM tbl_car_info";

$result = mysql_query($sql);

if( $result && mysql_num_rows($result) > 0 ) {
?>
	<table id="report" class="tablesorter" width="100%" cellspacing="0" cellpadding="0" border="0">
    
    	<thead>
            <th class="table-header-check">#</th>
            <th class="table-header-repeat line-left minwidth-1">BrandType</th>
            <th class="table-header-repeat line-left minwidth-1">VIN</th>
            <th class="table-header-repeat line-left minwidth-1">Produce Year</th>
            <th class="table-header-repeat line-left minwidth-1">Price</th>
            <th class="table-header-repeat line-left minwidth-1">Selling Status</th>
            <th class="table-header-repeat line-left minwidth-1">Usage Status</th>
            <th class="table-header-repeat line-left minwidth-1">Registration Date</th>
        </thead>
        <tbody>
<?php
	$i = 0;
	
	while($rows = mysql_fetch_assoc($result)) {
		extract($rows);
		//echo "<pre>"; print_r($rows); echo "</pre>";
		$i++;
?>
	<tr>
    	<td><?php echo $i; ?></td>
        <td><?php echo $brandType; ?></td>
        <td><?php echo $VIN; ?></td>
        <td><?php echo $produceYear; ?></td>
        <td><?php echo $price; ?></td>
        <td><?php echo $sellingStatus; ?></td>
        <td><?php echo $usagesStatus; ?></td>
        <td><?php echo date('d/m/Y',strtotime($regdate)); ?></td>
    </tr>
<?php
	}
?>
	</tbody>
	</table>
<?php
}else {
?>
	<div id="noReport">
    	There is no report.
    </div>
<?php
}	
?>